@include('user.header')

<style>
.withdraw-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 28px;
}
@media(max-width:860px){ .withdraw-grid{ grid-template-columns:1fr; } }

.method-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 12px;
    margin-bottom: 20px;
}
.method-card {
    background: var(--card-alt);
    border: 2px solid transparent;
    border-radius: 12px;
    padding: 18px 12px;
    text-align: center;
    cursor: pointer;
    transition: all .2s;
}
.method-card:hover  { border-color: var(--primary); }
.method-card.active { border-color: var(--primary); background: rgba(79,142,247,.1); }
.method-icon {
    width: 44px; height: 44px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
    margin: 0 auto 10px;
}
.method-label { font-size: .82rem; color: var(--text-muted); }

.form-group  { margin-bottom: 18px; }
.form-label  { font-size: .85rem; color: var(--text-muted); margin-bottom: 6px; display: block; }
.form-control-dark {
    width: 100%;
    background: var(--card-alt);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 10px;
    color: var(--text);
    padding: 12px 14px;
    font-size: .95rem;
    outline: none;
    transition: border .2s;
    box-sizing: border-box;
}
.form-control-dark:focus { border-color: var(--primary); }
.form-control-dark option { background: var(--card-bg); }

.submit-btn {
    width: 100%;
    padding: 13px;
    border: none;
    border-radius: 10px;
    background: var(--red);
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: opacity .2s;
    margin-top: 4px;
}
.submit-btn:hover { opacity: .88; }

/* wallet address input box */
.wallet-input-box {
    background: var(--card-alt);
    border: 1px dashed rgba(255,79,112,.35);
    border-radius: 12px;
    padding: 16px 18px;
    margin-bottom: 16px;
}
.wallet-input-box .form-label { margin-bottom: 8px; }

/* balance pill */
.balance-pill {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(0,200,150,.1);
    border: 1px solid rgba(0,200,150,.25);
    color: var(--green);
    border-radius: 8px;
    padding: 6px 14px;
    font-size: .82rem;
    font-weight: 600;
    margin-bottom: 18px;
}

/* fee summary box */
.fee-summary {
    background: var(--card-alt);
    border-radius: 10px;
    padding: 14px 16px;
    margin-bottom: 18px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.fee-row {
    display: flex;
    justify-content: space-between;
    font-size: .83rem;
}
.fee-row span:first-child { color: var(--text-muted); }
.fee-row span:last-child  { font-weight: 600; }
.fee-row.total {
    padding-top: 8px;
    border-top: 1px solid var(--border);
    font-size: .9rem;
}
.fee-row.total span:last-child { color: var(--green); font-size: 1rem; }

/* history items */
.wth-history-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 0;
    border-bottom: 1px solid rgba(255,255,255,.05);
}
.wth-history-item:last-child { border-bottom: none; }
.wth-status {
    font-size: .75rem;
    padding: 3px 10px;
    border-radius: 20px;
    font-weight: 600;
}
.status-pending  { background: rgba(245,166,35,.15);  color: var(--gold); }
.status-approved { background: rgba(0,200,150,.15);   color: var(--green); }
.status-rejected { background: rgba(255,79,112,.15);  color: var(--red); }
</style>

        <main class="main-content">

            @if(session('success'))
                <div style="background:rgba(0,200,150,.15);border:1px solid var(--green);color:var(--green);border-radius:10px;padding:12px 18px;margin-bottom:20px;">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

            <!-- Withdraw Form + Info -->
            <div class="withdraw-grid">

                <!-- Left: Withdraw Form -->
                <div class="dash-card fade-in">
                    <div class="card-header">
                        <h3><i class="bi bi-arrow-up-circle me-2" style="color:var(--red);"></i>Request Withdrawal</h3>
                    </div>

                    <!-- Available Balance -->
                    <div class="balance-pill">
                        <i class="bi bi-wallet2"></i>
                        Available Balance: <strong>${{ number_format($availableBalance, 2) }}</strong>
                    </div>

                    <!-- Payout Methods -->
                    <p class="form-label" style="margin-bottom:10px;">Select Withdrawal Method</p>
                    <div class="method-cards">
                        <div class="method-card active" onclick="selectMethod(this,'btc')">
                            <div class="method-icon" style="background:rgba(247,147,26,.15);color:#f7931a;"><i class="bi bi-currency-bitcoin"></i></div>
                            <div class="method-label">Bitcoin</div>
                        </div>
                        <div class="method-card" onclick="selectMethod(this,'eth')">
                            <div class="method-icon" style="background:rgba(98,126,234,.15);color:#627eea;"><i class="bi bi-currency-exchange"></i></div>
                            <div class="method-label">Ethereum</div>
                        </div>
                        <div class="method-card" onclick="selectMethod(this,'usdt')">
                            <div class="method-icon" style="background:rgba(0,200,150,.15);color:var(--green);"><i class="bi bi-coin"></i></div>
                            <div class="method-label">USDT</div>
                        </div>
                        <div class="method-card" onclick="selectMethod(this,'bank')">
                            <div class="method-icon" style="background:rgba(79,142,247,.15);color:var(--primary);"><i class="bi bi-bank"></i></div>
                            <div class="method-label">Bank Wire</div>
                        </div>
                    </div>

                    <form action="{{ route('user.withdraw.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="method" id="selectedMethod" value="btc">

                        <!-- Wallet / Bank Address -->
                        <div class="wallet-input-box" id="cryptoAddrBox">
                            <label class="form-label">
                                <i class="bi bi-wallet me-1"></i>Your <span id="methodLabel">Bitcoin</span> Wallet Address
                            </label>
                            <input type="text" class="form-control-dark" id="walletAddrInput" name="wallet_address"
                                   placeholder="Enter your wallet address">
                            <small style="color:var(--text-muted);font-size:.78rem;margin-top:6px;display:block;">
                                <i class="bi bi-exclamation-triangle-fill" style="color:var(--gold);"></i>
                                Double-check your address. Incorrect addresses result in permanent loss of funds.
                            </small>
                        </div>

                        <!-- Bank Details (shown for Bank Wire) -->
                        <div id="bankBox" style="display:none;">
                            <div class="form-group">
                                <label class="form-label">Bank Name</label>
                                <input type="text" class="form-control-dark" name="bank_name" placeholder="e.g. Chase Bank">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Account Number / IBAN</label>
                                <input type="text" class="form-control-dark" name="account_number" placeholder="Enter account number or IBAN">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Account Holder Name</label>
                                <input type="text" class="form-control-dark" name="account_name" placeholder="Full name on account">
                            </div>
                            <div class="form-group">
                                <label class="form-label">SWIFT / BIC Code</label>
                                <input type="text" class="form-control-dark" name="swift_code" placeholder="e.g. CHASUS33">
                            </div>
                        </div>

                        <!-- Amount -->
                        <div class="form-group">
                            <label class="form-label">Amount (USD)</label>
                            <input type="number" class="form-control-dark @error('amount') is-invalid @enderror" id="withdrawAmount" name="amount"
                                   placeholder="Enter amount e.g. 500" min="50" step="any"
                                   value="{{ old('amount') }}" oninput="updateFee()">
                            @error('amount')<small style="color:var(--red);">{{ $message }}</small>@enderror
                            <small style="color:var(--text-muted);font-size:.78rem;margin-top:5px;display:block;">Minimum withdrawal: $50.00</small>
                        </div>

                        <!-- Fee Summary -->
                        <div class="fee-summary">
                            <div class="fee-row">
                                <span>Withdrawal amount</span>
                                <span id="feeAmount">&mdash;</span>
                            </div>
                            <div class="fee-row">
                                <span>Processing fee (2%)</span>
                                <span id="feeDed" style="color:var(--red);">&mdash;</span>
                            </div>
                            <div class="fee-row total">
                                <span>You receive</span>
                                <span id="feeNet">&mdash;</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Notes (Optional)</label>
                            <textarea class="form-control-dark" name="notes" rows="2"
                                      placeholder="Any additional notes..."></textarea>
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="bi bi-send-fill me-2"></i>Submit Withdrawal Request
                        </button>
                    </form>
                </div>

                <!-- Right: How It Works + History -->
                <div style="display:flex;flex-direction:column;gap:24px;">

                    <!-- How It Works -->
                    <div class="dash-card fade-in">
                        <div class="card-header">
                            <h3><i class="bi bi-info-circle me-2" style="color:var(--primary);"></i>How It Works</h3>
                        </div>
                        <div style="display:flex;flex-direction:column;gap:16px;padding-top:4px;">
                            <div style="display:flex;gap:14px;align-items:flex-start;">
                                <div style="min-width:32px;height:32px;border-radius:50%;background:rgba(79,142,247,.15);color:var(--primary);display:flex;align-items:center;justify-content:center;font-weight:700;">1</div>
                                <div>
                                    <div style="font-weight:600;margin-bottom:3px;">Choose a Method</div>
                                    <div style="font-size:.83rem;color:var(--text-muted);">Select the method you want to receive your funds.</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:14px;align-items:flex-start;">
                                <div style="min-width:32px;height:32px;border-radius:50%;background:rgba(0,200,150,.15);color:var(--green);display:flex;align-items:center;justify-content:center;font-weight:700;">2</div>
                                <div>
                                    <div style="font-weight:600;margin-bottom:3px;">Enter Your Address</div>
                                    <div style="font-size:.83rem;color:var(--text-muted);">Provide your wallet address or bank details for the payout.</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:14px;align-items:flex-start;">
                                <div style="min-width:32px;height:32px;border-radius:50%;background:rgba(245,166,35,.15);color:var(--gold);display:flex;align-items:center;justify-content:center;font-weight:700;">3</div>
                                <div>
                                    <div style="font-weight:600;margin-bottom:3px;">Enter Amount</div>
                                    <div style="font-size:.83rem;color:var(--text-muted);">Specify how much you'd like to withdraw from your balance.</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:14px;align-items:flex-start;">
                                <div style="min-width:32px;height:32px;border-radius:50%;background:rgba(168,85,247,.15);color:var(--purple);display:flex;align-items:center;justify-content:center;font-weight:700;">4</div>
                                <div>
                                    <div style="font-weight:600;margin-bottom:3px;">Wait for Processing</div>
                                    <div style="font-size:.83rem;color:var(--text-muted);">Withdrawals are reviewed and processed within 15–30 minutes.</div>
                                </div>
                            </div>
                        </div>

                        <!-- Notice -->
                        <div style="background:rgba(245,166,35,.08);border:1px solid rgba(245,166,35,.25);border-radius:10px;padding:12px 14px;margin-top:20px;">
                            <div style="font-size:.82rem;font-weight:600;color:var(--gold);margin-bottom:4px;">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>Important Notice
                            </div>
                            <ul style="font-size:.8rem;color:var(--text-muted);margin:0;padding-left:16px;display:flex;flex-direction:column;gap:4px;">
                                <li>Minimum withdrawal amount is $50.00</li>
                                <li>A 2% processing fee applies to all withdrawals</li>
                                <li>Ensure your wallet address is correct before submitting</li>
                                <li>Withdrawals are only available from profit balance</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Recent Withdrawal History -->
                    <div class="dash-card fade-in">
                        <div class="card-header">
                            <h3><i class="bi bi-clock-history me-2" style="color:var(--gold);"></i>Withdrawal History</h3>
                            <a href="{{ route('user.history') }}" class="view-all">View All</a>
                        </div>
                        @forelse($withdrawals as $wth)
                        <div class="wth-history-item">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div class="tx-icon out"><i class="bi bi-arrow-up-right"></i></div>
                                <div>
                                    <div style="font-weight:600;font-size:.9rem;">{{ strtoupper($wth->method) }} Withdrawal</div>
                                    <div class="tx-date">{{ $wth->created_at->format('M j, Y') }} &bull; {{ $wth->created_at->format('g:i A') }}</div>
                                </div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-weight:700;color:var(--red);">-${{ number_format($wth->amount, 2) }}</div>
                                <span class="wth-status {{ $wth->status_class }}">{{ $wth->status_label }}</span>
                            </div>
                        </div>
                        @empty
                        <div style="text-align:center;padding:20px 0;color:var(--text-muted);font-size:.85rem;">
                            <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:8px;opacity:.4;"></i>
                            No withdrawal history yet
                        </div>
                        @endforelse
                    </div>

                </div>
            </div>

        </main>

<script>
const methodLabels = {
    btc:  'Bitcoin',
    eth:  'Ethereum',
    usdt: 'USDT (TRC-20)',
    bank: 'Bank Wire'
};
const methodPlaceholders = {
    btc:  'Enter your BTC wallet address',
    eth:  'Enter your ETH wallet address',
    usdt: 'Enter your USDT (TRC-20) wallet address',
    bank: null
};

function selectMethod(el, key) {
    document.querySelectorAll('.method-card').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('selectedMethod').value = key;

    const cryptoBox = document.getElementById('cryptoAddrBox');
    const bankBox   = document.getElementById('bankBox');

    if (key === 'bank') {
        cryptoBox.style.display = 'none';
        bankBox.style.display   = 'block';
    } else {
        cryptoBox.style.display = 'block';
        bankBox.style.display   = 'none';
        document.getElementById('methodLabel').textContent     = methodLabels[key];
        document.getElementById('walletAddrInput').placeholder = methodPlaceholders[key];
    }
}

function updateFee() {
    const amt = parseFloat(document.getElementById('withdrawAmount').value);
    const fmt = v => '$' + v.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    if (!amt || isNaN(amt) || amt <= 0) {
        document.getElementById('feeAmount').textContent = '—';
        document.getElementById('feeDed').textContent    = '—';
        document.getElementById('feeNet').textContent    = '—';
        return;
    }

    const fee = amt * 0.02;
    const net = amt - fee;
    document.getElementById('feeAmount').textContent = fmt(amt);
    document.getElementById('feeDed').textContent    = '-' + fmt(fee);
    document.getElementById('feeNet').textContent    = fmt(net);
}
</script>

@include('user.footer')
