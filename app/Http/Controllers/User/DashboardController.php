<?php

namespace App\Http\Controllers\User;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Profit;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    
//   //display user dashboard







public function index()
{
    $userId = Auth::id();
    $user   = Auth::user();

    // Stats
    $totalDeposited = Deposit::where('user_id', $userId)->where('status', 1)->sum('amount');
    $totalWithdrawn = Withdrawal::where('user_id', $userId)->where('status', 1)->sum('amount');
    $totalProfit    = Profit::where('user_id', $userId)->sum('amount');
    $totalBalance   = $totalDeposited + $totalProfit - $totalWithdrawn;

    // Recent transactions — last 5, merged from deposits, withdrawals, investments
    $deposits = Deposit::where('user_id', $userId)
        ->orderBy('created_at', 'desc')->take(5)->get()
        ->map(fn($d) => (object)[
            'type'        => 'deposit',
            'description' => strtoupper($d->method) . ' Deposit',
            'amount'      => $d->amount,
            'direction'   => 'in',
            'sign'        => '+',
            'date'        => $d->created_at,
        ]);

    $withdrawals = Withdrawal::where('user_id', $userId)
        ->orderBy('created_at', 'desc')->take(5)->get()
        ->map(fn($w) => (object)[
            'type'        => 'withdrawal',
            'description' => strtoupper($w->method) . ' Withdrawal',
            'amount'      => $w->amount,
            'direction'   => 'out',
            'sign'        => '-',
            'date'        => $w->created_at,
        ]);

    $investments = Investment::where('user_id', $userId)
        ->orderBy('created_at', 'desc')->take(5)->get()
        ->map(fn($i) => (object)[
            'type'        => 'investment',
            'description' => $i->plan,
            'amount'      => $i->amount,
            'direction'   => 'invest',
            'sign'        => '',
            'date'        => $i->created_at,
        ]);

    $recentTransactions = $deposits->concat($withdrawals)->concat($investments)
        ->sortByDesc('date')->take(5)->values();

    // Active investments
    $activeInvestments = Investment::where('user_id', $userId)
        ->where('status', 0)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('user.home', compact(
        'user',
        'totalDeposited',
        'totalWithdrawn',
        'totalProfit',
        'totalBalance',
        'recentTransactions',
        'activeInvestments'
    ));
}




public function TransferPage()
{
    return view('user.transfer');
}

public function ProfilePage()
{
    return view('user.profile');
}

public function invest()
{
    return view('user.invest');
}

public function history()
{
    return view('user.history');
}

public function support()
{
    return view('user.support');
}

/**
 * Get the BTC price in USD (i.e. 1 BTC = X USD).  
 * You can use CoinGecko, CoinAPI, etc.
 */
protected function getBtcRateInUsd()
{
    // Example using CoinGecko simple price API
    $url = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd";

    try {
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        if (isset($data['bitcoin']['usd'])) {
            return (float) $data['bitcoin']['usd'];
        }
    } catch (\Exception $e) {
        // Log error, fallback
    }

    return 0;
}




 public function gasBilling()
    {
      $conversion = session('conversion'); // get the data from session
      
    // Fetch all available wallets set by the admin
    $wallets = Wallet::all(); // returns a collection of wallet objects
    return view('user.gas-billing', compact('conversion', 'wallets'));  
     
    }

    public function PaymentHistory() {
      
    return view('user.payment-history');  
     
    }

    

 

public function PayOption()
{
    // Existing escrow data for the user
    $escrow = Escrow::where('user_id', Auth::id())->first();

    // Fetch all available wallets set by the admin
    $wallets = Wallet::all(); // returns a collection of wallet objects

    return view('user.pay-option', compact('escrow', 'wallets'));
}


public function ApprovePayment(){

  return view('user.approve-payment');
}

public function Cashout(){

  return view('user.cashout');
}






 public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'phone'      => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile information updated successfully.');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password'          => 'required|string',
            'new_password'              => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }


public function UseSupport(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $user = Auth::user(); // logged-in user
        $adminEmail = "info@assurehold.com"; // change to your admin email

        // Send mail directly without mailable template
        Mail::raw("New Support Request\n\nFrom: {$user->name} ({$user->email})\n\nSubject: {$request->subject}\n\nMessage:\n{$request->message}", function ($message) use ($adminEmail, $request) {
            $message->to($adminEmail)
                    ->subject('Support Request: ' . $request->subject);
        });

        return back()->with('success', 'Your support message has been sent successfully!');
    }



  }



