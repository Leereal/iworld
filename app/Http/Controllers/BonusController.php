<?php

namespace App\Http\Controllers;

use App\Http\Resources\BonusResource;
use App\Models\Bonus;
use App\Models\Investment;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BonusController extends Controller
{
    public function all()
    {       
        if (Auth::user()->id == 1) {
            $bonus = Bonus::orderBy('user_id')->get();
            return view('allbonuses', ['bonuses'=>$bonus]);
        }   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Get Bonus
         $bonuses = Auth::user()->bonuses()->where('status','<>',0)->get();

         return view('bonus',['bonuses'=>$bonuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function show(Bonus $bonus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bonus $bonus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bonus $bonus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bonus $bonus)
    {
        //
    }
    public function pay(Request $request)
    {
        if (Auth::user()->id == 1) { 
                    $pay= Bonus::findOrFail($request->bonus);
                    $pay->update(['status' => 0]);
                    return redirect('/user-bonus/'.$pay->user_id);
        }  
    }

    public function payall(Request $request)
    {
        if (Auth::user()->id == 1) { 
                    $pay= Bonus::where('user_id', $request->user)->update(['status' => 0]);
                    return redirect('/user-bonus/'.$request->user);
        }  
    }

    public function userbonus(Request $request)
    {
        if (Auth::user()->id == 1) {
            //Get Bonus
            $bonuses = Bonus::where('user_id', $request->user)->get();
            $total = Bonus::where('user_id', $request->user)->where('status', 1)->sum('amount') + 0;

            return view('userbonus', ['bonuses'=>$bonuses,'total'=>$total, 'user'=>$request->user]);
        }
    }

    public function investbonus(Request $request)
    {
        if (Auth::user()->id == 1) {
                $request->validate([
                'user'                  => 'required|integer',
            ]);
            //Get all pending bonuses total
            $total = Bonus::where('user_id', $request->user)->where('status', 1)->sum('amount');

            //Get package 
            $plan    = Plan::findOrFail(1);

            if($total >= 30)
            {
                $expected_profit = $total + ($plan->interest / 100 * $total);
                $balance = $expected_profit;
                $profit = $expected_profit-$total;         
                try {
                    DB::beginTransaction();
                    //Add Investment
                    $investment                          = new Investment();
                    $investment->amount                  = $total;
                    $investment->description             = 'Bonus ReInvest';
                    $investment->plan_id                 = 1;
                    $investment->user_id                 = $request->user;
                    $investment->due_date                = Carbon::now()->addDays($plan->period);
                    $investment->bank_id                 = 1;
                    $investment->ipaddress               = request()->ip();
                    $investment->expected_profit         = $expected_profit;
                    $investment->profit                  = $profit;
                    $investment->balance                 = $balance;
                    $investment->save();
                   
                    Bonus::where('user_id', $request->user)->update(['status' => 0]);
                    DB::commit();
                    return redirect()->back();
                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }
            }
        }
    }
}
