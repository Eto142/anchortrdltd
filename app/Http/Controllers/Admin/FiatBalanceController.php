<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FiatBalanceController extends Controller
{
    public function AddFiatBalance(Request $request, $id)
    {
        return redirect()->back()->with('error', 'Feature not implemented.');
    }
}
