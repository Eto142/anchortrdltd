@include('user.header')

<style>
.deposit-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 28px;
}
@media(max-width:860px){ .deposit-grid{ grid-template-columns:1fr; } }

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
.method-card:hover { border-color: var(--primary); }
.method-card.active { border-color: var(--primary); background: rgba(79,142,247,.1); }
.method-icon {
    width: 44px; height: 44px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
    margin: 0 auto 10px;
}
.method-label { font-size: .82rem; color: var(--text-muted); }

.form-group { margin-bottom: 18px; }
.form-label { font-size: .85rem; color: var(--text-muted); margin-bottom: 6px; display: block; }
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
    background: var(--primary);
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: opacity .2s;
    margin-top: 4px;
}
.submit-btn:hover { opacity: .88; }

.wallet-box {
    background: var(--card-alt);
    border: 1px dashed rgba(79,142,247,.4);
    border-radius: 12px;
    padding: 18px;
    margin-bottom: 16px;
    display: none;
}
.wallet-box.show { display: block; }
.wallet-addr {
    font-family: monospace;
    font-size: .9rem;
    background: var(--bg);
    border-radius: 8px;
    padding: 10px 14px;
    word-break: break-all;
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-top: 8px;
}
.copy-btn {
    background: none;
    border: 1px solid var(--primary);
    color: var(--primary);
    border-radius: 6px;
    padding: 3px 10px;
    font-size: .78rem;
    cursor: pointer;
    white-space: nowrap;
}
.copy-btn:hover { background: var(--primary); color: #fff; }

.dep-history-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 0;
    border-bottom: 1px solid rgba(255,255,255,.05);
}
.dep-history-item:last-child { border-bottom: none; }
.dep-status {
    font-size: .75rem;
    padding: 3px 10px;
    border-radius: 20px;
    font-weight: 600;
}
.status-pending { background: rgba(245,166,35,.15); color: var(--gold); }
.status-approved { background: rgba(0,200,150,.15); color: var(--green); }
.status-rejected { background: rgba(255,79,112,.15); color: var(--red); }
</style>

        <main class="main-content">

            @if(session('success'))
                <div style="background:rgba(0,200,150,.15);border:1px solid var(--green);color:var(--green);border-radius:10px;padding:12px 18px;margin-bottom:20px;">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif
            <div class="deposit-grid">

                <!-- Left: Deposit Form -->
                <div class="dash-card fade-in">
                    <div class="card-header">
                        <h3><i class="bi bi-plus-circle me-2" style="color:var(--green);"></i>Make a Deposit</h3>
                    </div>

                    <!-- Payment Methods -->
                    <p class="form-label" style="margin-bottom:10px;">Select Payment Method</p>
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

                    <!-- Wallet Address Box (crypto) -->
                    <div class="wallet-box show" id="walletBox">
                        <div class="form-label"><i class="bi bi-info-circle me-1"></i>Send your deposit to the address below</div>
                        <div class="wallet-addr" id="walletAddr">
                            <span id="walletAddrText">{{ $wallets->get('btc')?->address ?? 'No address configured yet' }}</span>
                            <button class="copy-btn" onclick="copyWallet()">Copy</button>
                        </div>
                        <small style="color:var(--text-muted);font-size:.78rem;margin-top:8px;display:block;">
                            <i class="bi bi-exclamation-triangle-fill" style="color:var(--gold);"></i>
                            Only send the exact currency. Wrong transfers cannot be recovered.
                        </small>
                    </div>

                    <form action="{{ route('user.deposit.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="method" id="selectedMethod" value="btc">

                        <div class="form-group">
                            <label class="form-label">Amount (USD)</label>
                            <input type="number" name="amount" class="form-control-dark @error('amount') is-invalid @enderror" placeholder="Enter amount e.g. 500" min="50" step="any" value="{{ old('amount') }}">
                            @error('amount')<small style="color:var(--red);">{{ $message }}</small>@enderror
                            <small style="color:var(--text-muted);font-size:.78rem;margin-top:5px;display:block;">Minimum deposit: $50.00</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Upload Payment Proof</label>
                            <input type="file" name="payment_proof" class="form-control-dark" accept="image/*,.pdf">
                            @error('payment_proof')<small style="color:var(--red);">{{ $message }}</small>@enderror
                            <small style="color:var(--text-muted);font-size:.78rem;margin-top:5px;display:block;">Upload screenshot or receipt of your payment</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Notes (Optional)</label>
                            <textarea name="notes" class="form-control-dark" rows="2" placeholder="Transaction ID or any notes...">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="bi bi-send-fill me-2"></i>Submit Deposit Request
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
                                    <div style="font-size:.83rem;color:var(--text-muted);">Select your preferred payment method from the options above.</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:14px;align-items:flex-start;">
                                <div style="min-width:32px;height:32px;border-radius:50%;background:rgba(0,200,150,.15);color:var(--green);display:flex;align-items:center;justify-content:center;font-weight:700;">2</div>
                                <div>
                                    <div style="font-weight:600;margin-bottom:3px;">Send Your Payment</div>
                                    <div style="font-size:.83rem;color:var(--text-muted);">Transfer funds to the provided wallet address or bank details.</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:14px;align-items:flex-start;">
                                <div style="min-width:32px;height:32px;border-radius:50%;background:rgba(245,166,35,.15);color:var(--gold);display:flex;align-items:center;justify-content:center;font-weight:700;">3</div>
                                <div>
                                    <div style="font-weight:600;margin-bottom:3px;">Upload Proof</div>
                                    <div style="font-size:.83rem;color:var(--text-muted);">Upload a screenshot or receipt of the completed transaction.</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:14px;align-items:flex-start;">
                                <div style="min-width:32px;height:32px;border-radius:50%;background:rgba(168,85,247,.15);color:var(--purple);display:flex;align-items:center;justify-content:center;font-weight:700;">4</div>
                                <div>
                                    <div style="font-weight:600;margin-bottom:3px;">Wait for Approval</div>
                                    <div style="font-size:.83rem;color:var(--text-muted);">Deposits are reviewed and credited within 15–30 minutes.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Deposit History -->
                    <div class="dash-card fade-in">
                        <div class="card-header">
                            <h3><i class="bi bi-clock-history me-2" style="color:var(--gold);"></i>Deposit History</h3>
                            <a href="{{ route('user.deposit.history') }}" class="view-all">View All</a>
                        </div>
                        @forelse($deposits as $dep)
                        <div class="dep-history-item">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div class="tx-icon in"><i class="bi bi-arrow-down-left"></i></div>
                                <div>
                                    <div style="font-weight:600;font-size:.9rem;">{{ strtoupper($dep->method) }} Deposit</div>
                                    <div class="tx-date">{{ $dep->created_at->format('M j, Y') }} &bull; {{ $dep->created_at->format('g:i A') }}</div>
                                </div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-weight:700;color:var(--green);">+${{ number_format($dep->amount, 2) }}</div>
                                <span class="dep-status {{ $dep->status_class }}">{{ $dep->status_label }}</span>
                            </div>
                        </div>
                        @empty
                        <div style="text-align:center;padding:20px 0;color:var(--text-muted);font-size:.85rem;">
                            <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:8px;opacity:.4;"></i>
                            No deposit history yet
                        </div>
                        @endforelse
                    </div>

                </div>
            </div>

        </main>

<script>
const walletAddresses = {
    btc:  '{{ $wallets->get("btc")?->address ?? "" }}',
    eth:  '{{ $wallets->get("eth")?->address ?? "" }}',
    usdt: '{{ $wallets->get("usdt")?->address ?? "" }}',
    xrp:  '{{ $wallets->get("xrp")?->address ?? "" }}',
    bank: null
};
function selectMethod(el, key) {
    document.querySelectorAll('.method-card').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('selectedMethod').value = key;
    const box = document.getElementById('walletBox');
    if (walletAddresses[key]) {
        document.getElementById('walletAddrText').textContent = walletAddresses[key];
        box.classList.add('show');
    } else {
        box.classList.remove('show');
    }
}
function copyWallet() {
    const addr = document.getElementById('walletAddrText').textContent;
    navigator.clipboard.writeText(addr).then(() => {
        const btn = document.querySelector('.copy-btn');
        btn.textContent = 'Copied!';
        setTimeout(() => btn.textContent = 'Copy', 2000);
    });
}
</script>

@include('user.footer')
