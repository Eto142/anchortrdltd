<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\HistoryController;
use App\Http\Controllers\User\InvestController;
use App\Http\Controllers\User\WithdrawalController;
use App\Http\Controllers\User\ProfileController;

Route::get('/', function () {
    return view('home.homepage');
})->name('home');

Route::get('/about', function () {
    return view('home.about');
});

Route::get('/services', function () {
    return view('home.services');
});

Route::get('/contact', function () {
    return view('home.contact');
});

// User Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/register/profile-setup', [RegisterController::class, 'showProfileSetup'])->name('register.profile')->middleware('auth');
Route::post('/register/profile-setup', [RegisterController::class, 'saveProfile'])->name('register.profile.save')->middleware('auth');

// User dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/deposit', [DepositController::class, 'index'])->name('user.deposit');
    Route::post('/user/deposit', [DepositController::class, 'store'])->name('user.deposit.store');
    Route::get('/user/deposit/history', [DepositController::class, 'history'])->name('user.deposit.history');
    Route::get('/user/invest', [InvestController::class, 'index'])->name('user.invest');
    Route::post('/user/invest', [InvestController::class, 'store'])->name('user.invest.store');
    Route::get('/user/withdraw', [WithdrawalController::class, 'index'])->name('user.withdraw');
    Route::post('/user/withdraw', [WithdrawalController::class, 'store'])->name('user.withdraw.store');
    Route::get('/user/history', [HistoryController::class, 'index'])->name('user.history');
    Route::get('/user/profile', [ProfileController::class, 'show'])->name('user.profile');
    Route::post('/user/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/user/settings', [ProfileController::class, 'settings'])->name('user.settings');
    Route::get('/user/support', [DashboardController::class, 'support'])->name('user.support');

    // Transfer routes
    Route::get('/user/transfer', fn() => view('user.transfer-options'))->name('user.transfer');
    Route::get('/user/transfer/domestic', fn() => view('user.domestic-transfer'))->name('user.transfer.domestic');
    Route::get('/user/transfer/international', fn() => view('user.international-transfer'))->name('user.transfer.international');
    Route::get('/user/transfer/info', fn() => view('user.transfer-info'))->name('user.transfer.info');
});


