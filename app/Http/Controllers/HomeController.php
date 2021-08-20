<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();          
        $total_balance          = $user->investments()->where('status', '>', 0)->get()->sum('balance');
        $total_mature           = $user->investments()->where('investments.status', '=', 1)->get()->sum('amount');
        $total_referrals        = $user->referrals()->get()->count();
        $total_bonus            = $user->bonuses()->where('bonuses.status', '>', 0)->get()->sum('amount');


        return view('home',[     
            'balance' => number_format($total_balance, 2),
            'mature'  => number_format($total_mature, 2),           
            'referrals'  =>$total_referrals,           
            'bonus'  => number_format($total_bonus, 2)
            ]);  
    }
}
