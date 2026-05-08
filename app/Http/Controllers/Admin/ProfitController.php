<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profit;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    public function addUserProfit(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount'  => 'required|numeric|min:0.01',
            'source'  => 'nullable|string|max:255',
        ]);

        $source = $request->source ?? 'Admin Credit';

        $profit = new Profit();
        $profit->user_id = $request->user_id;
        $profit->amount  = $request->amount;
        $profit->source  = $source;
        $profit->status  = 1;
        $profit->save();

        // Create a credit transaction so the balance reflects this profit
        Transaction::create([
            'user_id'          => $request->user_id,
            'transaction_id'   => 'PRF-' . strtoupper(uniqid()),
            'transaction_type' => 'profit',
            'transaction'      => 'Profit: ' . $source,
            'credit'           => $request->amount,
            'debit'            => '0',
            'status'           => 1,
        ]);

        return redirect()->back()->with('success', 'Profit added successfully.');
    }
}
