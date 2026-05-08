<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Profit;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WithdrawalController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $withdrawals = Withdrawal::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $totalDeposited  = Deposit::where('user_id', $userId)->where('status', 1)->sum('amount');
        $totalProfit     = Profit::where('user_id', $userId)->sum('amount');
        $totalWithdrawn  = Withdrawal::where('user_id', $userId)->where('status', 1)->sum('amount');
        $availableBalance = $totalDeposited + $totalProfit - $totalWithdrawn;

        return view('user.withdraw', compact('withdrawals', 'availableBalance'));
    }

    public function store(Request $request)
    {
        $method = $request->input('method');

        // Common validation
        $request->validate([
            'method' => 'required|in:btc,eth,usdt,bank',
            'amount' => 'required|numeric|min:50',
            'notes'  => 'nullable|string|max:500',
        ]);

        // Method-specific validation
        if ($method === 'bank') {
            $request->validate([
                'bank_name'      => 'required|string|max:255',
                'account_name'   => 'required|string|max:255',
                'account_number' => 'required|string|max:50',
                'swift_code'     => 'nullable|string|max:50',
            ]);
        } else {
            $request->validate([
                'wallet_address' => 'required|string|max:255',
            ]);
        }

        $txId = strtoupper(Str::random(12));

        Withdrawal::create([
            'user_id'        => Auth::id(),
            'transaction_id' => $txId,
            'amount'         => $request->amount,
            'method'         => $method,
            'wallet_address' => $request->wallet_address ?? null,
            'bank_name'      => $request->bank_name ?? null,
            'account_name'   => $request->account_name ?? null,
            'account_number' => $request->account_number ?? null,
            'swift_code'     => $request->swift_code ?? null,
            'notes'          => $request->notes ?? null,
            'status'         => 0,
        ]);

        Transaction::create([
            'user_id'          => Auth::id(),
            'transaction_id'   => $txId,
            'transaction_type' => 'withdrawal',
            'transaction'      => strtoupper($method) . ' Withdrawal',
            'credit'           => '0',
            'debit'            => $request->amount,
            'status'           => 0,
        ]);

        return redirect()->route('user.withdraw')
            ->with('success', 'Withdrawal request submitted successfully. It will be processed within 15–30 minutes.');
    }
}


