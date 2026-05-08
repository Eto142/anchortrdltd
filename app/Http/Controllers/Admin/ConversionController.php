<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConversionController extends Controller
{
    public function approve(Request $request, $id)
    {
        return redirect()->back()->with('error', 'Feature not implemented.');
    }

    public function decline(Request $request, $id)
    {
        return redirect()->back()->with('error', 'Feature not implemented.');
    }
}
