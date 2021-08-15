<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Investment;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        //Get Bids
        $investments = Investment::orderBy('status')->orderBy('due_date')->whereIn('status',[1,101])->get();

        return view('allinvestments',['investments'=>$investments]);
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        //Get Investments
        $investments = Auth::user()->investments()->where('status','<>',0)->get();

        return view('investments',['investments'=>$investments]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = $plans = Plan::all();
        $banks = Bank::all();
        return view('invest',['plans'=>$plans, 'banks'=>$banks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function show(Investment $investment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function edit(Investment $investment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investment $investment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investment $investment)
    {
        //
    }

    public function mature_or_reinvest(Request $request)
    {
        if (Auth::user()->id == 1) {
                $request->validate([
                'investment'                  => 'required|integer'
            ]);
            //Take investment
            $investment = Investment::findOrFail($request->investment);

            //Check if it is a reinvest else mature it              
            if($investment->status == 1){
                //Reinvest
                $this->reinvest($investment->id);
                return redirect('/all-investments');
            }
            if($investment->status == 101){                
                //Mature
                $this->mature($investment->id);
                return redirect('/all-investments');
                
            }
        } 
        else{
            dd('You are trying to hack this lol hahaha') ; 
        } 
    }

    protected function mature($id)
    {
        if (Auth::user()->id == 1) {                
                try {
                    DB::beginTransaction();
                    $mature= Investment::findOrFail($id)->update(['status' => 1]);
                    DB::commit();         
                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }
        }  
    }
    protected function reinvest($id)
    {
        if (Auth::user()->id == 1) {          
                //Take the whole invest
                $reinvestment = Investment::findOrFail($id);


                //Create new table with new duedate and plan            
                try {
                    DB::beginTransaction();
                        $investment                          = new Investment;
                        $investment->amount                  = $reinvestment->amount;
                        $investment->description             = 'Reinvest';
                        $investment->plan_id                 = $reinvestment->plan_id;              
                        $investment->user_id                 = $reinvestment->user_id;               
                        $investment->due_date                = Carbon::parse($reinvestment->due_date)->addDays($reinvestment->plan->period);
                        $investment->bank_id                 = $reinvestment->bank_id;         
                        $investment->ipaddress               = request()->ip();
                        $investment->expected_profit         = $reinvestment->expected_profit;
                        $investment->profit                  = $reinvestment->expected_profit-$reinvestment->amount;
                        $investment->balance                 = $reinvestment->expected_profit;
                        $investment->save();
                        Investment::findOrFail($reinvestment->id)->update(['status' => 0,'balance'=>0]);
                    DB::commit();                    
                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }
        }    
    }

    public function user_reinvestment(Request $request){
        if (Auth::user()) {          
            //Take the whole invest
            $reinvestment = Investment::findOrFail($request->investment);
            if($reinvestment->status == 1 && $reinvestment->profit == 0 ){
                //Create new table with new duedate and plan            
                try {
                    DB::beginTransaction();
                        $investment                          = new Investment;
                        $investment->amount                  = $reinvestment->amount;
                        $investment->description             = 'Reinvest';
                        $investment->plan_id                 = $reinvestment->plan_id;              
                        $investment->user_id                 = $reinvestment->user_id;               
                        $investment->due_date                = Carbon::parse($reinvestment->due_date)->addDays($reinvestment->plan->period);
                        $investment->bank_id                 = $reinvestment->bank_id;         
                        $investment->ipaddress               = request()->ip();
                        $investment->expected_profit         = $reinvestment->expected_profit;
                        $investment->profit                  = $reinvestment->expected_profit-$reinvestment->amount;
                        $investment->balance                 = $reinvestment->expected_profit;
                        $investment->save();
                        Investment::findOrFail($reinvestment->id)->update(['status' => 0,'balance'=>0]);
                    DB::commit();                    
                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }
                return redirect('/investments');
            }
            elseif($reinvestment->status == 1 && $reinvestment->profit > 0 && $reinvestment->profit < 20 ){
                //Top up
                try {
                    DB::beginTransaction();
                        $investment                          = new Investment;
                        $investment->amount                  = $reinvestment->amount;
                        $investment->description             = 'Reinvest';
                        $investment->plan_id                 = $reinvestment->plan_id;              
                        $investment->user_id                 = $reinvestment->user_id;               
                        $investment->due_date                = Carbon::parse($reinvestment->due_date)->addDays($reinvestment->plan->period);
                        $investment->bank_id                 = $reinvestment->bank_id;         
                        $investment->ipaddress               = request()->ip();
                        $investment->expected_profit         = $reinvestment->expected_profit;
                        $investment->profit                  = ($reinvestment->expected_profit-$reinvestment->amount) + $reinvestment->profit;// Top up profit
                        $investment->balance                 = $reinvestment->expected_profit + $reinvestment->profit;
                        $investment->save();
                        Investment::findOrFail($reinvestment->id)->update(['status' => 0,'balance'=>0]);
                    DB::commit();                    
                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }
                return redirect('/investments');

            }
            elseif($reinvestment->status == 1 && $reinvestment->profit > 0 && $reinvestment->profit >= 20 ){
                $new_profit = $reinvestment->plan->interest / 100 * $reinvestment->balance;
                $new_balance = $reinvestment->balance + $new_profit; 
                //Reinvest
                try {
                    DB::beginTransaction();
                        $investment                          = new Investment;
                        $investment->amount                  = $reinvestment->amount;
                        $investment->description             = 'Reinvest';
                        $investment->plan_id                 = $reinvestment->plan_id;              
                        $investment->user_id                 = $reinvestment->user_id;               
                        $investment->due_date                = Carbon::parse($reinvestment->due_date)->addDays($reinvestment->plan->period);
                        $investment->bank_id                 = $reinvestment->bank_id;         
                        $investment->ipaddress               = request()->ip();
                        $investment->expected_profit         = $reinvestment->expected_profit;
                        $investment->profit                  = $new_profit;
                        $investment->balance                 = $new_balance;
                        $investment->save();
                        Investment::findOrFail($reinvestment->id)->update(['status' => 0,'balance'=>0]);
                    DB::commit();                    
                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }
                return redirect('/investments');
            }
            else{
                return redirect('/investments');
            }           
        } 
    }
    public function bulk_reinvestment(){
        if (Auth::user()->id == 1) {   
            //Select all invests with status 1 that matured. 
            $mature_investments = Investment::where('status',1)->get(); 
            
            //Loop each and every investment and reinvest it 
            foreach ($mature_investments as $reinvestment){
                if($reinvestment->profit == 0 ){
                    //Create new table with new duedate and plan            
                    try {
                        DB::beginTransaction();
                            $investment                          = new Investment;
                            $investment->amount                  = $reinvestment->amount;
                            $investment->description             = 'Reinvest';
                            $investment->plan_id                 = $reinvestment->plan_id;              
                            $investment->user_id                 = $reinvestment->user_id;               
                            $investment->due_date                = Carbon::parse($reinvestment->due_date)->addDays($reinvestment->plan->period);
                            $investment->bank_id                 = $reinvestment->bank_id;         
                            $investment->ipaddress               = request()->ip();
                            $investment->expected_profit         = $reinvestment->expected_profit;
                            $investment->profit                  = $reinvestment->expected_profit-$reinvestment->amount;
                            $investment->balance                 = $reinvestment->expected_profit;
                            $investment->save();
                            Investment::findOrFail($reinvestment->id)->update(['status' => 0,'balance'=>0]);
                        DB::commit();                    
                    } catch (\Exception $e) {
                        DB::rollback();
                        throw $e;
                    }                  
                }
                if($reinvestment->profit > 0 && $reinvestment->profit < 20 ){
                    //Top up
                    try {
                        DB::beginTransaction();
                            $investment                          = new Investment;
                            $investment->amount                  = $reinvestment->amount;
                            $investment->description             = 'Reinvest';
                            $investment->plan_id                 = $reinvestment->plan_id;              
                            $investment->user_id                 = $reinvestment->user_id;               
                            $investment->due_date                = Carbon::parse($reinvestment->due_date)->addDays($reinvestment->plan->period);
                            $investment->bank_id                 = $reinvestment->bank_id;         
                            $investment->ipaddress               = request()->ip();
                            $investment->expected_profit         = $reinvestment->expected_profit;
                            $investment->profit                  = ($reinvestment->expected_profit-$reinvestment->amount) + $reinvestment->profit;// Top up profit
                            $investment->balance                 = $reinvestment->expected_profit + $reinvestment->profit;
                            $investment->save();
                            Investment::findOrFail($reinvestment->id)->update(['status' => 0,'balance'=>0]);
                        DB::commit();                    
                    } catch (\Exception $e) {
                        DB::rollback();
                        throw $e;
                    }
                }
                if( $reinvestment->profit > 0 && $reinvestment->profit >= 20 ){
                    $new_profit = $reinvestment->plan->interest / 100 * $reinvestment->balance;
                    $new_balance = $reinvestment->balance + $new_profit; 
                    //Reinvest
                    try {
                        DB::beginTransaction();
                            $investment                          = new Investment;
                            $investment->amount                  = $reinvestment->amount;
                            $investment->description             = 'Reinvest';
                            $investment->plan_id                 = $reinvestment->plan_id;              
                            $investment->user_id                 = $reinvestment->user_id;               
                            $investment->due_date                = Carbon::parse($reinvestment->due_date)->addDays($reinvestment->plan->period);
                            $investment->bank_id                 = $reinvestment->bank_id;         
                            $investment->ipaddress               = request()->ip();
                            $investment->expected_profit         = $reinvestment->expected_profit;
                            $investment->profit                  = $new_profit;
                            $investment->balance                 = $new_balance;
                            $investment->save();
                            Investment::findOrFail($reinvestment->id)->update(['status' => 0,'balance'=>0]);
                        DB::commit();                    
                    } catch (\Exception $e) {
                        DB::rollback();
                        throw $e;
                    }
                    
                }
            } 
            dd('Done reinvestments');                  
        } 
    }
    public function bulk_mature()
    {
        if (Auth::user()->id == 1) {    
            //Select all invests with status 101 and due today. 
           Investment::where('status',101)->whereDate('due_date', Carbon::today())->update(['status' => 1]);             
            dd('Done approving maturity');
        }  
    }
}
