@include('user.header')

<style>
/* filter bar */
.filter-bar {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 22px;
    flex-wrap: wrap;
}
.filter-tabs {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
}
.ftab {
    padding: 7px 16px;
    border-radius: 20px;
    font-size: .82rem;
    font-weight: 600;
    cursor: pointer;
    border: 1.5px solid var(--border);
    color: var(--text-muted);
    background: transparent;
    transition: all .2s;
    user-select: none;
}
.ftab:hover  { border-color: var(--primary); color: var(--primary); }
.ftab.active { background: var(--primary); border-color: var(--primary); color: #fff; }

.filter-spacer { flex: 1; }

.filter-select {
    background: var(--card-alt);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 10px;
    color: var(--text);
    padding: 8px 12px;
    font-size: .83rem;
    outline: none;
    cursor: pointer;
}
.filter-select option { background: var(--card-bg); }

/* history table */
.hist-table-wrap {
    overflow-x: auto;
}
.hist-table {
    width: 100%;
    border-collapse: collapse;
}
.hist-table th {
    font-size: .75rem;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: .04em;
    padding: 0 12px 12px;
    text-align: left;
    white-space: nowrap;
    border-bottom: 1px solid var(--border);
}
.hist-table td {
    padding: 14px 12px;
    font-size: .87rem;
    border-bottom: 1px solid rgba(255,255,255,.04);
    vertical-align: middle;
}
.hist-table tr:last-child td { border-bottom: none; }
.hist-table tr:hover td { background: rgba(255,255,255,.02); }

.h-type-icon {
    width: 36px; height: 36px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: .95rem;
    flex-shrink: 0;
}
.h-type-icon.deposit  { background: rgba(0,200,150,.12);  color: var(--green); }
.h-type-icon.withdraw { background: rgba(255,79,112,.12); color: var(--red); }
.h-type-icon.invest   { background: rgba(79,142,247,.12); color: var(--primary); }
.h-type-icon.profit   { background: rgba(245,166,35,.12); color: var(--gold); }

.h-amount.positive { color: var(--green); font-weight: 700; }
.h-amount.negative { color: var(--red);   font-weight: 700; }
.h-amount.neutral  { color: var(--text);  font-weight: 700; }

.h-badge {
    font-size: .72rem;
    padding: 3px 9px;
    border-radius: 20px;
    font-weight: 600;
    white-space: nowrap;
}
.h-badge.pending  { background: rgba(245,166,35,.15); color: var(--gold); }
.h-badge.approved { background: rgba(0,200,150,.15);  color: var(--green); }
.h-badge.rejected { background: rgba(255,79,112,.15); color: var(--red); }
.h-badge.active   { background: rgba(79,142,247,.15); color: var(--primary); }

/* summary stats */
.hist-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}
.hstat {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 16px 18px;
    display: flex;
    align-items: center;
    gap: 14px;
}
.hstat-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}
.hstat-val { font-size: 1rem; font-weight: 700; }
.hstat-lbl { font-size: .75rem; color: var(--text-muted); margin-top: 2px; }

/* empty */
.empty-state { text-align: center; padding: 48px 0; color: var(--text-muted); }
.empty-state i { font-size: 2.5rem; display: block; margin-bottom: 12px; opacity: .3; }
.empty-state p { font-size: .85rem; margin: 0; }

/* pagination stub */
.hist-pagination {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 6px;
    margin-top: 20px;
    flex-wrap: wrap;
}
.hpag-btn {
    width: 34px; height: 34px;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--text-muted);
    font-size: .82rem;
    font-weight: 600;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: all .2s;
}
.hpag-btn:hover  { border-color: var(--primary); color: var(--primary); }
.hpag-btn.active { background: var(--primary); border-color: var(--primary); color: #fff; }
</style>

        <main class="main-content">

            <!-- Summary Stats -->
            <div class="hist-stats fade-in">
                <div class="hstat">
                    <div class="hstat-icon" style="background:rgba(0,200,150,.12);color:var(--green);">
                        <i class="bi bi-arrow-down-left"></i>
                    </div>
                    <div>
                        <div class="hstat-val" style="color:var(--green);">${{ number_format($totalDeposited, 2) }}</div>
                        <div class="hstat-lbl">Total Deposited</div>
                    </div>
                </div>
                <div class="hstat">
                    <div class="hstat-icon" style="background:rgba(255,79,112,.12);color:var(--red);">
                        <i class="bi bi-arrow-up-right"></i>
                    </div>
                    <div>
                        <div class="hstat-val" style="color:var(--red);">${{ number_format($totalWithdrawn, 2) }}</div>
                        <div class="hstat-lbl">Total Withdrawn</div>
                    </div>
                </div>
                <div class="hstat">
                    <div class="hstat-icon" style="background:rgba(79,142,247,.12);color:var(--primary);">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <div>
                        <div class="hstat-val" style="color:var(--primary);">${{ number_format($totalInvested, 2) }}</div>
                        <div class="hstat-lbl">Total Invested</div>
                    </div>
                </div>
                <div class="hstat">
                    <div class="hstat-icon" style="background:rgba(245,166,35,.12);color:var(--gold);">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div>
                        <div class="hstat-val" style="color:var(--gold);">${{ number_format($totalProfit, 2) }}</div>
                        <div class="hstat-lbl">Total Profit</div>
                    </div>
                </div>
            </div>

            <!-- Transactions Card -->
            <div class="dash-card fade-in">
                <div class="card-header">
                    <h3><i class="bi bi-clock-history me-2" style="color:var(--gold);"></i>Transaction History</h3>
                </div>

                <!-- Filter Bar -->
                <div class="filter-bar">
                    <div class="filter-tabs">
                        <a href="{{ route('user.history', ['type' => 'all']) }}"
                           class="ftab {{ $type === 'all'     ? 'active' : '' }}">All</a>
                        <a href="{{ route('user.history', ['type' => 'deposit']) }}"
                           class="ftab {{ $type === 'deposit' ? 'active' : '' }}">Deposits</a>
                        <a href="{{ route('user.history', ['type' => 'withdraw']) }}"
                           class="ftab {{ $type === 'withdraw'? 'active' : '' }}">Withdrawals</a>
                        <a href="{{ route('user.history', ['type' => 'invest']) }}"
                           class="ftab {{ $type === 'invest'  ? 'active' : '' }}">Investments</a>
                    </div>
                    <div class="filter-spacer"></div>
                </div>

                <!-- Table -->
                <div class="hist-table-wrap">
                    <table class="hist-table" id="histTable">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="histBody">
                            @forelse($transactions as $tx)
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div class="h-type-icon {{ $tx->type }}">
                                            @if($tx->type === 'deposit')  <i class="bi bi-arrow-down-left"></i>
                                            @elseif($tx->type === 'withdraw') <i class="bi bi-arrow-up-right"></i>
                                            @else <i class="bi bi-graph-up-arrow"></i>
                                            @endif
                                        </div>
                                        <span style="font-weight:600;font-size:.85rem;">
                                            {{ ucfirst($tx->type === 'withdraw' ? 'Withdrawal' : $tx->type) }}
                                        </span>
                                    </div>
                                </td>
                                <td>{{ $tx->description }}</td>
                                <td class="h-amount {{ $tx->direction }}">
                                    {{ $tx->sign }}${{ number_format($tx->amount, 2) }}
                                </td>
                                <td><span class="h-badge {{ $tx->status_class }}">{{ $tx->status_label }}</span></td>
                                <td style="color:var(--text-muted);white-space:nowrap;">
                                    {{ $tx->date->format('M j, Y') }} &bull; {{ $tx->date->format('g:i A') }}
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Empty state -->
                    @if($transactions->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>No transactions found.</p>
                    </div>
                    @endif
                </div>

                <!-- Pagination -->
                @php
                    $lastPage = (int) ceil($total / $perPage);
                @endphp
                @if($lastPage > 1)
                <div class="hist-pagination">
                    @if($currentPage > 1)
                        <a href="{{ route('user.history', ['type' => $type, 'page' => $currentPage - 1]) }}" class="hpag-btn"><i class="bi bi-chevron-left"></i></a>
                    @endif
                    @for($p = 1; $p <= $lastPage; $p++)
                        <a href="{{ route('user.history', ['type' => $type, 'page' => $p]) }}"
                           class="hpag-btn {{ $p === $currentPage ? 'active' : '' }}">{{ $p }}</a>
                    @endfor
                    @if($currentPage < $lastPage)
                        <a href="{{ route('user.history', ['type' => $type, 'page' => $currentPage + 1]) }}" class="hpag-btn"><i class="bi bi-chevron-right"></i></a>
                    @endif
                </div>
                @endif
            </div>

        </main>

@include('user.footer')
