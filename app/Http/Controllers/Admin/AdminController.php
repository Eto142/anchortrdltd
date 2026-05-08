<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Profit;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // User Statistics
        $newUsersCount   = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $totalUsersCount = User::count();

        // Deposits
        $totalDepositsAmount = Deposit::where('status', 1)->sum('amount');
        $pendingDepositsCount = Deposit::where('status', 0)->count();

        // Profits
        $totalProfitsAmount = Profit::sum('amount');
        $totalProfitsCount  = Profit::count();

        // Withdrawals
        $totalWithdrawalsAmount  = Withdrawal::where('status', 1)->sum('amount');
        $pendingWithdrawalsCount = Withdrawal::where('status', 0)->count();

        // Recent Activity
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'newUsersCount',
            'totalUsersCount',
            'totalDepositsAmount',
            'pendingDepositsCount',
            'totalProfitsAmount',
            'totalProfitsCount',
            'totalWithdrawalsAmount',
            'pendingWithdrawalsCount',
            'recentUsers',
        ));
    }
}
