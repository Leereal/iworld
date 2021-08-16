<?php

namespace App\Http\Controllers;
use App\Models\Deposit;
use App\Models\Bonus;
use App\Models\Investment;
use App\Models\Bank;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        //Get Deposits
        $deposits = Deposit::orderBy('status','desc')->latest()->get();

        return view('deposits',['deposits'=>$deposits]);
    }

    public function index()
    {
        // //Get Investments
        // $deposits = Auth::user()->investments()->where('status','<>',0)->get();

        // return view('deposits',['deposits'=>$deposits]);  
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $banks = Bank::all();
        $deposits = Auth::user()->deposits()->where('status',2)->get();
        return view('select-deposit',['banks'=>$banks,'deposits'=>$deposits]);
    }

    public function deposit_view(Request $request)
    {
        $plans = Plan::all();
        $bank = Bank::findOrFail($request->bank);
        return view('deposit',['plans'=>$plans, 'bank'=>$bank]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        $request->validate([         
            'pop'               => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'amount'            => 'required|max:10|between:0,99.99|gt:0',
            'payment_method'    => 'required|integer',  
            'plan'              => 'required|integer',
        ]);
       
        $user = auth()->user();      
        $min_amount = 50;
        $max_amount = 50000;

        if ($min_amount <= $request->amount && $max_amount >= $request->amount) { 
            $imageName = time().'.'.$request->pop->extension(); 
            $request->pop->move(public_path('images/pop'), $imageName);    
                try {
                    DB::beginTransaction();
                    $bid                          = new Deposit;
                    $bid->amount                  = $request->amount;   
                    $bid->bank_id                 = $request->payment_method;              
                    $bid->plan_id                 = $request->plan;                    
                    $bid->user_id                 = $user->id;
                    $bid->pop                     = $imageName;
                    $bid->ipaddress               = request()->ip();
                    $bid->save();                   
                    DB::commit();
                    return redirect()->back()->with('message', 'Deposit successful. Contact Support to get approved');

                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }  
        } else {
            return redirect()->back()->withErrors('Amount must be between minimum and maximum limit');
        }
    }
    public function approve(Request $request)
    {
        $request->validate([
            'deposit'                  => 'required|integer',
        ]);

        //Get pending order with posted id
        $deposit = Deposit::where('id', $request->deposit)->first();

        //Get package of the  pending order
        $plan    = Plan::findOrFail($deposit->plan_id);

        //Get receiver details
        $receiver = User::where('id', $deposit->user_id)->with('referrer')->first();

        $amount = $deposit->amount;
        $expected_profit = $amount + ($plan->interest / 100 * $amount);
        $balance = $expected_profit;
        $profit = $expected_profit-$amount;

        //Take investment done today by pending order user(buyer)  and with the same package to join with the current one if any
        $investment  = Investment::where('user_id', $deposit->user_id)->whereDate('created_at', Carbon::today())->where('plan_id', $deposit->plan_id)->where('status', 101)->first();
        //If there was a valid investment done today of the same package from the same user then update it to have one investment
        if ($investment) {
            try {
                DB::beginTransaction();

                $investment->expected_profit += $expected_profit;
                $investment->profit += $profit;
                $investment->amount += $amount;
                $investment->balance += $balance;
                $investment->save();

                if ($receiver->referrer_id > 0) {
                    //Add bonus
                    $referral_bonus                      = new Bonus();
                    $referral_bonus->user_id             = $receiver->referrer->id;
                    $referral_bonus->amount              = $deposit->amount * 0.1;
                    $investment->bonus()->save($referral_bonus);
                }
                $approve_payment= Deposit::findOrFail($request->deposit)->update(['status' => 0]);
                DB::commit();
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } else { // Create new investment
            try {
                DB::beginTransaction();
                //Add Investment
                $investment                          = new Investment;
                $investment->amount                  = $amount;
                $investment->description             = 'Peer to Peer';
                $investment->plan_id                 = $deposit->plan_id;              
                $investment->user_id                 = $deposit->user_id;               
                $investment->due_date                = Carbon::now()->addDays($plan->period);
                $investment->bank_id                 = $deposit->bank_id;         
                $investment->ipaddress               = request()->ip();
                $investment->expected_profit         = $expected_profit;
                $investment->profit                  = $profit;
                $investment->balance                 = $balance;
                $investment->save();

                if ($receiver->referrer_id > 0) {
                    //Add bonus
                    $referral_bonus                      = new Bonus();
                    $referral_bonus->user_id             = $receiver->referrer->id;
                    $referral_bonus->amount              = $deposit->amount * 0.1;
                    $investment->bonus()->save($referral_bonus);
                }
                Deposit::findOrFail($request->deposit)->update(['status' => 0]);
                 DB::commit();           
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
    }

}
