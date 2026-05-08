<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function AddUserBalance(Request $request)
    {
        $request->validate([
            'id'     => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        Transaction::create([
            'user_id'          => $request->id,
            'transaction_id'   => 'BAL-' . strtoupper(uniqid()),
            'transaction_type' => 'balance_update',
            'transaction'      => 'Admin Balance Update',
            'credit'           => $request->amount,
            'debit'            => '0',
            'status'           => 1,
        ]);

        return redirect()->back()->with('success', 'User Balance Updated Successfully');
    }
}
