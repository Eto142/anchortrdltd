<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\BalanceController;
use App\Http\Controllers\Admin\ConversionController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\FiatBalanceController;
use App\Http\Controllers\Admin\ManagePaymentController;
use App\Http\Controllers\Admin\ProfitController;
use App\Http\Controllers\Admin\SendEmailController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\WithdrawalController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Users
        Route::get('/users', [ManageUserController::class, 'ManageUsers'])->name('users');
        Route::get('/users/{id}', [ManageUserController::class, 'userProfile'])->name('profile');
        Route::post('/users/{id}/delete', [ManageUserController::class, 'deleteUser'])->name('delete');
        Route::post('/users/{id}/withdrawal-status', [ManageUserController::class, 'WithdrawalStatus'])->name('withdrawal.status');
        Route::post('/users/{id}/convert-status', [ManageUserController::class, 'ConvertStatus'])->name('convert.status');
        Route::post('/users/{id}/suspend', [ManageUserController::class, 'SuspendUser'])->name('suspend.user');

        // Balance
        Route::post('/balance/add', [BalanceController::class, 'AddUserBalance'])->name('add.balance');
        Route::post('/fiat-balance/{id}/add', [FiatBalanceController::class, 'AddFiatBalance'])->name('add.fiat.balance');

        // Deposit (admin add)
        Route::post('/deposit/add', [DepositController::class, 'addUserDeposit'])->name('deposit.add');
        Route::post('/deposit/{id}/approve', [DepositController::class, 'approveDeposit'])->name('deposit.approve');
        Route::post('/deposit/{id}/decline', [DepositController::class, 'DeclineDeposit'])->name('deposit.decline');

        // Profit
        Route::post('/profit/add', [ProfitController::class, 'addUserProfit'])->name('profit.add');

        // Conversions
        Route::post('/conversion/{id}/approve', [ConversionController::class, 'approve'])->name('conversion.approve');
        Route::post('/conversion/{id}/decline', [ConversionController::class, 'decline'])->name('conversion.decline');

        // Withdrawals
        Route::post('/withdrawal/{id}/approve', [WithdrawalController::class, 'approve'])->name('withdrawal.approve');
        Route::post('/withdrawal/{id}/decline', [WithdrawalController::class, 'decline'])->name('withdrawal.decline');

        // Transactions
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');

        // Payment
        Route::get('/manage-payment', [ManagePaymentController::class, 'ManagePayment'])->name('manage.payment');
        Route::post('/choose-wallet', [WalletController::class, 'chooseWallet'])->name('choose.wallet');

        // Email
        Route::get('/send-email', [SendEmailController::class, 'index'])->name('send.email');
        Route::post('/send-email', [SendEmailController::class, 'send'])->name('send.email.post');
        Route::post('/users/send-mail', [SendEmailController::class, 'send'])->name('users.send-mail');
    });
});
