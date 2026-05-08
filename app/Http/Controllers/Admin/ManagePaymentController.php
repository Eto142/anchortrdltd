<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Illuminate\Http\Request;

class ManagePaymentController extends Controller
{
    public function ManagePayment()
    {
        $wallets = Wallet::all()->keyBy('method');

        return view('admin.manage_payment', compact('wallets'));
    }
}
