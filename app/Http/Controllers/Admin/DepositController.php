<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DepositController extends Controller
{
    

     public function usersDeposit(){

        $user_deposits = Deposit::where('user_id', auth()->id())
                                  ->orderBy('created_at', 'desc')
                                  ->paginate(10); // or whatever number you prefer
        return view('admin.manage_deposit', compact('user_deposits'));
    }


    
    public function approveDeposit(Request $request, $id)
{
    $deposit = Deposit::findOrFail($id);

    if ($deposit->status === 1) {
        return redirect()->back()->with('success', 'Deposit already approved.');
    }

    $deposit->status = 1;
    $deposit->save();

    // If a matching transaction exists, approve it; otherwise create one
    $existing = Transaction::where('transaction_id', $deposit->transaction_id)->first();
    if ($existing) {
        $existing->update(['status' => 1]);
    } else {
        $txnId = $deposit->transaction_id ?: ('DEP-' . strtoupper(uniqid()));
        Transaction::create([
            'user_id'          => $deposit->user_id,
            'transaction_id'   => $txnId,
            'transaction_type' => 'deposit',
            'transaction'      => 'Deposit (' . ($deposit->method ?? 'Manual') . ')',
            'credit'           => $deposit->amount,
            'debit'            => '0',
            'status'           => 1,
        ]);
    }

    return redirect()->back()->with('success', 'Deposit approved successfully.');
}




public function DeclineDeposit(Request $request, $id)
{
    $deposit = Deposit::findOrFail($id);
    $deposit->status = 2;
    $deposit->save();

    // Remove or zero out the corresponding transaction so balance is not affected
    Transaction::where('transaction_id', $deposit->transaction_id)->update(['status' => 2, 'credit' => '0']);

    return redirect()->back()->with('success', 'Deposit declined successfully.');
}



 public function addUserDeposit(Request $request)
    {
        $transactionId = 'DEP-' . strtoupper(uniqid());

        $topUp = new Deposit;
        $topUp->user_id       = $request['id'];
        $topUp->amount        = $request['amount'];
        $topUp->method        = $request['method'];
        $topUp->transaction_id = $transactionId;
        $topUp->status        = 1;
        $topUp->save();

        // Create an approved credit transaction so the balance reflects this deposit
        Transaction::create([
            'user_id'          => $request['id'],
            'transaction_id'   => $transactionId,
            'transaction_type' => 'deposit',
            'transaction'      => 'Admin Deposit (' . $request['method'] . ')',
            'credit'           => $request['amount'],
            'debit'            => '0',
            'status'           => 1,
        ]);

        return redirect()->back()->with('success', 'User Deposit Added Successfully');
    }



}
