<?php

namespace App\Http\Controllers\User;

use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $type   = $request->query('type', 'all');

        // ── Summary stats ──────────────────────────────────────────────
        $totalDeposited = Deposit::where('user_id', $userId)
            ->where('status', 1)
            ->sum('amount');

        $totalWithdrawn = Withdrawal::where('user_id', $userId)
            ->where('status', 1)
            ->sum('amount');

        $totalInvested = Investment::where('user_id', $userId)
            ->sum('amount');

        $totalProfit = Investment::where('user_id', $userId)
            ->where('status', 1) // completed
            ->sum('profit');

        // ── Build unified transaction rows ─────────────────────────────
        $rows = collect();

        if ($type === 'all' || $type === 'deposit') {
            Deposit::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get()
                ->each(function ($d) use (&$rows) {
                    $rows->push((object)[
                        'type'        => 'deposit',
                        'description' => strtoupper($d->method) . ' Deposit',
                        'amount'      => $d->amount,
                        'direction'   => 'positive',
                        'sign'        => '+',
                        'status'      => $d->status,
                        'status_label'=> $d->status === 1 ? 'Approved' : ($d->status === 2 ? 'Rejected' : 'Pending'),
                        'status_class'=> $d->status === 1 ? 'approved' : ($d->status === 2 ? 'rejected' : 'pending'),
                        'date'        => $d->created_at,
                        'tx_id'       => $d->transaction_id,
                    ]);
                });
        }

        if ($type === 'all' || $type === 'withdraw') {
            Withdrawal::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get()
                ->each(function ($w) use (&$rows) {
                    $rows->push((object)[
                        'type'        => 'withdraw',
                        'description' => strtoupper($w->method) . ' Withdrawal',
                        'amount'      => $w->amount,
                        'direction'   => 'negative',
                        'sign'        => '-',
                        'status'      => $w->status,
                        'status_label'=> $w->status === 1 ? 'Approved' : ($w->status === 2 ? 'Rejected' : 'Pending'),
                        'status_class'=> $w->status === 1 ? 'approved' : ($w->status === 2 ? 'rejected' : 'pending'),
                        'date'        => $w->created_at,
                        'tx_id'       => $w->transaction_id,
                    ]);
                });
        }

        if ($type === 'all' || $type === 'invest') {
            Investment::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get()
                ->each(function ($i) use (&$rows) {
                    $rows->push((object)[
                        'type'        => 'invest',
                        'description' => $i->plan . ' — ' . $i->roi . '% ROI',
                        'amount'      => $i->amount,
                        'direction'   => 'neutral',
                        'sign'        => '',
                        'status'      => $i->status,
                        'status_label'=> $i->status === 1 ? 'Completed' : ($i->status === 2 ? 'Cancelled' : 'Active'),
                        'status_class'=> $i->status === 1 ? 'approved' : ($i->status === 2 ? 'rejected' : 'active'),
                        'date'        => $i->created_at,
                        'tx_id'       => $i->transaction_id,
                    ]);
                });
        }

        // Sort all rows by date descending, paginate manually
        $sorted = $rows->sortByDesc('date')->values();

        // Manual pagination
        $perPage     = 15;
        $currentPage = (int) $request->query('page', 1);
        $total       = $sorted->count();
        $transactions = $sorted->forPage($currentPage, $perPage);

        return view('user.history', compact(
            'transactions',
            'type',
            'total',
            'currentPage',
            'perPage',
            'totalDeposited',
            'totalWithdrawn',
            'totalInvested',
            'totalProfit'
        ));
    }
}
