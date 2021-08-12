<?php

use Illuminate\Support\Facades\Route;
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
