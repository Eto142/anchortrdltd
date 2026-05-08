<?php

namespace App\Http\Controllers\User;

use App\Models\Investment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

// Plan definitions — single source of truth
const PLANS = [
    'Regular Plan'   => ['min' => 200,    'max' => 1000,  'roi' => 50,  'hours' => 48],
    'Premium Plan'   => ['min' => 1000,   'max' => 5000,  'roi' => 80,  'hours' => 48],
    'Exclusive Plan' => ['min' => 5000,   'max' => 10000, 'roi' => 100, 'hours' => 72],
    'VIP Plan'       => ['min' => 10000,  'max' => null,  'roi' => 200, 'hours' => 168],
];

class InvestController extends Controller
{
    /**
     * Compute the user's available balance from approved transactions.
     * balance = sum(credit) - sum(debit) where status = 1
     */
    private function getBalance(int $userId): float
    {
        $row = Transaction::where('user_id', $userId)
            ->where('status', 1)
            ->selectRaw('SUM(CAST(credit AS DECIMAL(15,2))) - SUM(CAST(debit AS DECIMAL(15,2))) AS balance')
            ->first();

        return max(0, (float) ($row->balance ?? 0));
    }

    public function index()
    {
        $user        = Auth::user();
        $balance     = $this->getBalance($user->id);
        $investments = Investment::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.invest', compact('user', 'balance', 'investments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan'   => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        $planName = $request->plan;
        $plans    = PLANS;

        if (!array_key_exists($planName, $plans)) {
            return redirect()->back()->withErrors(['plan' => 'Invalid plan selected.']);
        }

        $plan   = $plans[$planName];
        $amount = (float) $request->amount;
        $user   = Auth::user();

        // Validate amount range
        if ($amount < $plan['min']) {
            return redirect()->back()->withErrors([
                'amount' => "Minimum investment for {$planName} is $" . number_format($plan['min'], 2),
            ])->withInput();
        }
        if ($plan['max'] !== null && $amount > $plan['max']) {
            return redirect()->back()->withErrors([
                'amount' => "Maximum investment for {$planName} is $" . number_format($plan['max'], 2),
            ])->withInput();
        }

        // Check funded balance (computed from transactions)
        $balance = $this->getBalance($user->id);
        if ($balance < $amount) {
            return redirect()->back()->withErrors([
                'amount' => 'Insufficient balance. Please fund your account before investing. Your current balance is $' . number_format($balance, 2),
            ])->withInput();
        }

        $txId       = strtoupper(Str::random(12));
        $profit     = round($amount * $plan['roi'] / 100, 2);
        $total      = round($amount + $profit, 2);
        $maturity   = now()->addHours($plan['hours']);
        $duration   = $plan['hours'] >= 168
            ? ($plan['hours'] / 24) . ' Days'
            : $plan['hours'] . ' Hours';

        DB::transaction(function () use ($user, $txId, $planName, $amount, $plan, $profit, $total, $duration, $maturity) {
            // Create investment record
            Investment::create([
                'user_id'        => $user->id,
                'transaction_id' => $txId,
                'plan'           => $planName,
                'amount'         => $amount,
                'roi'            => $plan['roi'],
                'profit'         => $profit,
                'total_return'   => $total,
                'duration'       => $duration,
                'maturity_at'    => $maturity,
                'status'         => 0,
            ]);

            // Log debit to transactions (reduces computed balance)
            Transaction::create([
                'user_id'          => $user->id,
                'transaction_id'   => $txId,
                'transaction_type' => 'investment',
                'transaction'      => $planName,
                'credit'           => '0',
                'debit'            => $amount,
                'status'           => 1, // immediately effective
            ]);
        });

        return redirect()->route('user.invest')
            ->with('success', "Investment of $" . number_format($amount, 2) . " in {$planName} placed successfully. Expected return: $" . number_format($total, 2));
    }
}
