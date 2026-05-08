@include('user.header')

        <main class="main-content">

            <!-- Welcome -->
            <div class="welcome-section fade-in">
                <h1>Welcome back, <span class="text-primary">{{ Auth::user()->name }}</span>!</h1>
                <p id="currentDate">Here's your investment overview for today</p>
            </div>

            <!-- Investment Stats -->
            <div class="stats-grid">

                <div class="stat-card s-balance fade-in">
                    <div class="stat-icon"><i class="bi bi-wallet2"></i></div>
                    <div class="stat-label">Total Balance</div>
                    <div class="stat-value">${{ number_format($totalBalance, 2) }}</div>
                    <span class="stat-badge badge-info"><i class="bi bi-person-badge"></i> {{ Auth::user()->name }}</span>
                </div>

                <div class="stat-card s-deposit fade-in">
                    <div class="stat-icon"><i class="bi bi-cash-coin"></i></div>
                    <div class="stat-label">Total Deposit</div>
                    <div class="stat-value">${{ number_format($totalDeposited, 2) }}</div>
                    <span class="stat-badge badge-up"><i class="bi bi-arrow-up"></i> All time</span>
                </div>

                <div class="stat-card s-profit fade-in">
                    <div class="stat-icon"><i class="bi bi-bar-chart-line"></i></div>
                    <div class="stat-label">Total Profit</div>
                    <div class="stat-value">${{ number_format($totalProfit, 2) }}</div>
                    <span class="stat-badge badge-up"><i class="bi bi-arrow-up"></i> All time</span>
                </div>

                <div class="stat-card s-withdraw fade-in">
                    <div class="stat-icon"><i class="bi bi-arrow-up-circle"></i></div>
                    <div class="stat-label">Total Withdrawal</div>
                    <div class="stat-value">${{ number_format($totalWithdrawn, 2) }}</div>
                    <span class="stat-badge badge-down"><i class="bi bi-dash"></i> All time</span>
                </div>

                {{-- <div class="stat-card s-invest fade-in">
                    <div class="stat-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <div class="stat-label">Active Investment</div>
                    <div class="stat-value">$0.00</div>
                    <span class="stat-badge badge-info"><i class="bi bi-activity"></i> 0 plans</span>
                </div> --}}

            </div>

            <!-- Quick Actions -->
            <div class="quick-actions fade-in">
                <h3 class="section-title">Quick Actions</h3>
                <div class="actions-grid">
                    <a href="#" class="action-btn">
                        <div class="action-icon"><i class="bi bi-speedometer2"></i></div>
                        <span>Dashboard</span>
                    </a>
                    <a href="#" class="action-btn">
                        <div class="action-icon" style="background:var(--green-dim);color:var(--green);"><i class="bi bi-cash-coin"></i></div>
                        <span>Deposit</span>
                    </a>
                    <a href="#" class="action-btn">
                        <div class="action-icon" style="background:var(--purple-dim);color:var(--purple);"><i class="bi bi-graph-up-arrow"></i></div>
                        <span>Invest</span>
                    </a>
                    <a href="#" class="action-btn">
                        <div class="action-icon" style="background:var(--red-dim);color:var(--red);"><i class="bi bi-arrow-up-circle"></i></div>
                        <span>Withdraw</span>
                    </a>
                    <a href="#" class="action-btn">
                        <div class="action-icon" style="background:var(--gold-dim);color:var(--gold);"><i class="bi bi-clock-history"></i></div>
                        <span>History</span>
                    </a>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid fade-in">
                <!-- Recent Transactions -->
                <div class="dash-card">
                    <div class="card-header">
                        <h3>Recent Transactions</h3>
                        <a href="{{ route('user.history') }}" class="view-all">View All</a>
                    </div>
                    @forelse($recentTransactions as $tx)
                    <div class="tx-item">
                        <div class="tx-info">
                            <div class="tx-icon {{ $tx->direction }}">
                                @if($tx->direction === 'in')   <i class="bi bi-arrow-down-left"></i>
                                @elseif($tx->direction === 'out') <i class="bi bi-arrow-up-right"></i>
                                @else <i class="bi bi-graph-up-arrow"></i>
                                @endif
                            </div>
                            <div>
                                <div class="tx-name">{{ $tx->description }}</div>
                                <div class="tx-date">{{ $tx->date->diffForHumans() }}</div>
                            </div>
                        </div>
                        <span class="tx-amount {{ $tx->direction }}">
                            {{ $tx->sign }}${{ number_format($tx->amount, 2) }}
                        </span>
                    </div>
                    @empty
                    <div style="text-align:center;padding:28px 0;color:var(--text-muted);font-size:.85rem;">
                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:8px;opacity:.4;"></i>
                        No transactions yet
                    </div>
                    @endforelse
                </div>

                <!-- Active Investments -->
                <div class="dash-card">
                    <div class="card-header">
                        <h3>Active Investments</h3>
                        <a href="{{ route('user.invest') }}" class="view-all">Invest Now</a>
                    </div>
                    @forelse($activeInvestments as $inv)
                    @php
                        $elapsed  = $inv->created_at->diffInSeconds(now());
                        $total    = $inv->created_at->diffInSeconds($inv->maturity_at);
                        $progress = $total > 0 ? min(100, round(($elapsed / $total) * 100)) : 0;
                    @endphp
                    <div class="plan-item">
                        <div class="plan-header">
                            <div>
                                <div class="plan-name">{{ $inv->plan }}</div>
                                <div class="plan-roi">{{ $inv->roi }}% ROI &bull; {{ $inv->duration }} &bull; Matures {{ $inv->maturity_at->format('M j') }}</div>
                            </div>
                            <span class="stat-badge badge-info">Active</span>
                        </div>
                        <div class="plan-bar">
                            <div class="plan-fill" style="width:{{ $progress }}%;background:var(--primary);"></div>
                        </div>
                        <div style="display:flex;justify-content:space-between;font-size:.75rem;color:var(--text-muted);margin-top:4px;">
                            <span>${{ number_format($inv->amount, 2) }} invested</span>
                            <span>Returns ${{ number_format($inv->total_return, 2) }}</span>
                        </div>
                    </div>
                    @empty
                    <div style="text-align:center;padding:28px 0;color:var(--text-muted);font-size:.85rem;">
                        <i class="bi bi-graph-up" style="font-size:2rem;display:block;margin-bottom:8px;opacity:.4;"></i>
                        No active investments
                    </div>
                    @endforelse
                </div>
            </div>

        </main>

@include('user.footer')
