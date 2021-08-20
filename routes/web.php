<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Http\Request; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/comingsoon', function () {
    return view('comingsoon');
});

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');


Route::get('/register/{ref?}', [App\Http\Controllers\Auth\RegisterController::class, 'referral']);
Route::get('/referrals', [App\Http\Controllers\UserController::class, 'referrals'])->middleware(['auth'])->name('referrals');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//require __DIR__.'/auth.php';

Route::get('/change-password', function () {
    return view('change-password');
})->middleware(['auth'])->name('change-password');

Route::get('/withdraw/{id?}', [WithdrawalController::class, 'show'])->middleware(['auth']);

Route::post('/changepassword', [UserController::class, 'change_password'])->middleware(['auth']);
Route::put('/update-profile', [UserController::class, 'update'])->middleware(['auth']);

Route::group(['middleware' => 'auth'], function() {
    Route::resources([
    'banks'         => BankController::class,
    'investments'   => InvestmentController::class,
    'bonus'         => BonusController::class,  
    'withdraw'      => WithdrawalController::class,  
]);
});

Route::get('/select-deposit', [DepositController::class, 'create'])->middleware(['auth']);
Route::get('/deposit-view', [DepositController::class, 'deposit_view'])->middleware(['auth']);
Route::post('/deposit', [DepositController::class, 'store'])->middleware(['auth']);
Route::get('/investment-history', [InvestmentController::class, 'history'])->middleware(['auth']);

Route::get('/deposits', [DepositController::class, 'all'])->middleware(['auth']);
Route::get('/withdrawals', [WithdrawalController::class, 'all'])->middleware(['auth']);
Route::get('/all-investments', [InvestmentController::class, 'all'])->middleware(['auth']);
Route::post('/reinvest', [InvestmentController::class, 'mature_or_reinvest'])->middleware(['auth']);
Route::post('/approve', [DepositController::class, 'approve'])->middleware(['auth']);
Route::post('/approve-withdrawal', [WithdrawalController::class, 'approve'])->middleware(['auth']);
Route::get('/investment', [InvestmentController::class, 'create'])->middleware(['auth']);
Route::get('/members', [UserController::class, 'index'])->middleware(['auth']);
Route::get('/all-bonuses', [BonusController::class, 'all'])->middleware(['auth']);
Route::post('/bonus-pay', [BonusController::class, 'pay'])->middleware(['auth']);
Route::post('/bonus-payall', [BonusController::class, 'payall'])->middleware(['auth']);
Route::post('/bonus-invest', [BonusController::class, 'investbonus'])->middleware(['auth']);
Route::get('/user-bonus/{user}', [BonusController::class, 'userbonus'])->middleware(['auth']);
Route::post('/reinvest-user', [InvestmentController::class, 'user_reinvestment'])->middleware(['auth']);
Route::post('/reinvest-all', [InvestmentController::class, 'bulk_reinvestment'])->middleware(['auth']);
Route::post('/mature-all', [InvestmentController::class, 'bulk_mature'])->middleware(['auth']);
Route::get('/settings', function () {
    return view('settings');
})->middleware(['auth'])->name('settings');

