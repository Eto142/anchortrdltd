<?php

namespace App\Http\Controllers\User;

use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Load admin-configured wallet addresses keyed by method
        $wallets = Wallet::all()->keyBy('method');

        return view('user.deposit', compact('deposits', 'wallets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount'        => 'required|numeric|min:50',
            'method'        => 'required|in:btc,eth,usdt,bank',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:5120',
            'notes'         => 'nullable|string|max:500',
        ]);

        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')
                ->store('deposits/proofs', 'public');
        }

        $txId = strtoupper(Str::random(12));

        $deposit = Deposit::create([
            'user_id'        => Auth::id(),
            'email'          => Auth::user()->email,
            'amount'         => $request->amount,
            'method'         => $request->method,
            'transaction_id' => $txId,
            'payment_proof'  => $proofPath,
            'notes'          => $request->notes,
            'status'         => 0,
        ]);

        Transaction::create([
            'user_id'          => Auth::id(),
            'transaction_id'   => $txId,
            'transaction_type' => 'deposit',
            'transaction'      => strtoupper($request->method) . ' Deposit',
            'credit'           => $request->amount,
            'debit'            => '0',
            'status'           => 0,
        ]);

        return redirect()->route('user.deposit')
            ->with('success', 'Deposit request submitted successfully. It will be reviewed within 15–30 minutes.');
    }

    public function history()
    {
        $deposits = Deposit::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('user.deposit-history', compact('deposits'));
    }
}
