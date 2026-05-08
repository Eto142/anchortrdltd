@include('user.header')

<style>
/* ── page layout ── */
.invest-page { padding-bottom: 32px; }

.page-hero {
    background: linear-gradient(135deg, rgba(79,142,247,.12), rgba(168,85,247,.08));
    border: 1px solid rgba(79,142,247,.2);
    border-radius: 16px;
    padding: 28px 32px;
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
}
.page-hero h2 { font-size: 1.35rem; font-weight: 700; margin: 0 0 6px; }
.page-hero p  { font-size: .88rem; color: var(--text-muted); margin: 0; }
.hero-badge {
    background: var(--primary-dim);
    color: var(--primary);
    border-radius: 10px;
    padding: 10px 20px;
    font-size: .82rem;
    font-weight: 600;
    white-space: nowrap;
}

/* ── plans grid ── */
.inv-plans-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 22px;
    margin-bottom: 36px;
}
.plan-card {
    background: var(--card-bg);
    border: 2px solid var(--border);
    border-radius: 16px;
    padding: 28px 22px 22px;
    display: flex;
    flex-direction: column;
    transition: transform .2s, border-color .2s, box-shadow .2s;
    position: relative;
    overflow: hidden;
}
.plan-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,.3);
}
.plan-card.featured {
    border-color: var(--primary);
    box-shadow: 0 0 0 1px rgba(79,142,247,.3), 0 8px 32px rgba(79,142,247,.15);
}
.plan-card.gold-card {
    border-color: var(--gold);
    box-shadow: 0 0 0 1px rgba(245,166,35,.3), 0 8px 32px rgba(245,166,35,.1);
}
.plan-pop {
    position: absolute;
    top: 14px; right: 14px;
    background: var(--primary);
    color: #fff;
    font-size: .7rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: .04em;
}
.plan-pop.gold { background: linear-gradient(135deg, var(--gold), #e6a817); color: #1a1a2e; }

.plan-icon { font-size: 2.2rem; margin-bottom: 12px; line-height: 1; }
.plan-name { font-size: 1rem; font-weight: 700; color: var(--text); margin-bottom: 4px; }
.plan-roi-big {
    font-size: 2.8rem;
    font-weight: 800;
    line-height: 1;
    margin: 8px 0 2px;
}
.plan-roi-big sup { font-size: 1.1rem; font-weight: 700; }
.plan-dur { font-size: .8rem; color: var(--text-muted); margin-bottom: 18px; }
.plan-divider { height: 1px; background: var(--border); margin: 0 0 18px; }
.plan-feats {
    list-style: none;
    padding: 0;
    margin: 0 0 22px;
    display: flex;
    flex-direction: column;
    gap: 9px;
    flex: 1;
}
.plan-feats li {
    font-size: .83rem;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 8px;
}
.plan-feats li i { color: var(--green); flex-shrink: 0; }

.invest-btn {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 10px;
    font-size: .92rem;
    font-weight: 600;
    cursor: pointer;
    transition: opacity .2s, transform .1s;
}
.invest-btn:hover  { opacity: .88; transform: scale(1.01); }
.invest-btn:active { transform: scale(.98); }
.invest-btn.btn-primary-inv  { background: var(--primary); color: #fff; }
.invest-btn.btn-gold-inv     { background: linear-gradient(135deg, var(--gold), #e6a817); color: #1a1a2e; }
.invest-btn.btn-outline-inv  { background: transparent; border: 1.5px solid var(--primary); color: var(--primary); }
.invest-btn.btn-outline-inv:hover { background: var(--primary-dim); }

/* ── modal overlay ── */
.modal-overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,.65);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.modal-overlay.open { display: flex; }
.modal-box {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 18px;
    width: 100%;
    max-width: 460px;
    padding: 32px 28px;
    position: relative;
    animation: slideUp .25s ease;
}
@keyframes slideUp {
    from { opacity:0; transform:translateY(30px); }
    to   { opacity:1; transform:translateY(0); }
}
.modal-close {
    position: absolute; top: 16px; right: 18px;
    background: none; border: none;
    color: var(--text-muted); font-size: 1.3rem;
    cursor: pointer; line-height: 1; transition: color .2s;
}
.modal-close:hover { color: var(--text); }
.modal-plan-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--primary-dim);
    color: var(--primary);
    border-radius: 8px;
    padding: 6px 14px;
    font-size: .83rem;
    font-weight: 600;
    margin-bottom: 20px;
}
.modal-title { font-size: 1.2rem; font-weight: 700; margin-bottom: 6px; }
.modal-desc  { font-size: .85rem; color: var(--text-muted); margin-bottom: 24px; }

.m-form-group { margin-bottom: 18px; }
.m-label { font-size: .83rem; color: var(--text-muted); margin-bottom: 6px; display: block; }
.m-input {
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
.m-input:focus { border-color: var(--primary); }
.m-hint { font-size: .76rem; color: var(--text-muted); margin-top: 5px; display: block; }

.m-summary {
    background: var(--card-alt);
    border-radius: 10px;
    padding: 14px 16px;
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.m-summary-row { display: flex; justify-content: space-between; font-size: .83rem; }
.m-summary-row span:first-child { color: var(--text-muted); }
.m-summary-row span:last-child  { font-weight: 600; }

.m-submit {
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
}
.m-submit:hover { opacity: .88; }
.m-submit.gold  { background: linear-gradient(135deg, var(--gold), #e6a817); color: #1a1a2e; }

/* ── empty / history ── */
.empty-state { text-align: center; padding: 36px 0; color: var(--text-muted); }
.empty-state i { font-size: 2.5rem; display: block; margin-bottom: 10px; opacity: .35; }
.empty-state p { font-size: .85rem; margin: 0; }
</style>

        <main class="main-content invest-page">

            @if(session('success'))
                <div style="background:rgba(0,200,150,.15);border:1px solid var(--green);color:var(--green);border-radius:10px;padding:12px 18px;margin-bottom:20px;">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

            <!-- Page Hero -->
            <div class="page-hero fade-in">
                <div>
                    <h2><i class="bi bi-graph-up-arrow me-2" style="color:var(--primary);"></i>Investment Plans</h2>
                    <p>Choose a plan that matches your goals. Principal is always returned with your profit.</p>
                </div>
                <div>
                    <div class="hero-badge"><i class="bi bi-shield-check me-1"></i>All plans include principal return</div>
                    <div style="margin-top:8px;font-size:.85rem;color:var(--text-muted);">Available Balance: <strong style="color:var(--green);">${{ number_format($balance, 2) }}</strong></div>
                </div>
            </div>

            <!-- Plans Grid -->
            <div class="inv-plans-grid">

                <!-- Regular Plan -->
                <div class="plan-card fade-in">
                    <div class="plan-icon">🥈</div>
                    <div class="plan-name">Regular Plan</div>
                    <div class="plan-roi-big" style="color:var(--primary);">
                        <sup>+</sup>50<sup style="font-size:1rem;">%</sup>
                    </div>
                    <div class="plan-dur"><i class="bi bi-clock me-1"></i>Returns after 48 Hours</div>
                    <div class="plan-divider"></div>
                    <ul class="plan-feats">
                        <li><i class="bi bi-check-circle-fill"></i>Minimum: $200</li>
                        <li><i class="bi bi-check-circle-fill"></i>Maximum: $1,000</li>
                        <li><i class="bi bi-check-circle-fill"></i>Principal return included</li>
                        <li><i class="bi bi-check-circle-fill"></i>Auto withdrawal</li>
                        <li><i class="bi bi-check-circle-fill"></i>24/7 support</li>
                    </ul>
                    <button class="invest-btn btn-outline-inv"
                            onclick="openModal('Regular Plan', 200, 1000, 50, '48 Hours')">
                        <i class="bi bi-lightning-charge-fill me-1"></i>Invest Now
                    </button>
                </div>

                <!-- Premium Plan -->
                <div class="plan-card featured fade-in">
                    <div class="plan-pop">Most Popular</div>
                    <div class="plan-icon">🏅</div>
                    <div class="plan-name">Premium Plan</div>
                    <div class="plan-roi-big" style="color:var(--primary);">
                        <sup>+</sup>80<sup style="font-size:1rem;">%</sup>
                    </div>
                    <div class="plan-dur"><i class="bi bi-clock me-1"></i>Returns after 48 Hours</div>
                    <div class="plan-divider"></div>
                    <ul class="plan-feats">
                        <li><i class="bi bi-check-circle-fill"></i>Minimum: $1,000</li>
                        <li><i class="bi bi-check-circle-fill"></i>Maximum: $5,000</li>
                        <li><i class="bi bi-check-circle-fill"></i>Principal return included</li>
                        <li><i class="bi bi-check-circle-fill"></i>Auto withdrawal</li>
                        <li><i class="bi bi-check-circle-fill"></i>Priority support</li>
                    </ul>
                    <button class="invest-btn btn-primary-inv"
                            onclick="openModal('Premium Plan', 1000, 5000, 80, '48 Hours')">
                        <i class="bi bi-lightning-charge-fill me-1"></i>Invest Now
                    </button>
                </div>

                <!-- Exclusive Plan -->
                <div class="plan-card fade-in">
                    <div class="plan-icon">🎖️</div>
                    <div class="plan-name">Exclusive Plan</div>
                    <div class="plan-roi-big" style="color:var(--gold);">
                        <sup style="color:var(--gold);">+</sup>100<sup style="font-size:1rem;color:var(--gold);">%</sup>
                    </div>
                    <div class="plan-dur"><i class="bi bi-clock me-1"></i>Returns after 72 Hours</div>
                    <div class="plan-divider"></div>
                    <ul class="plan-feats">
                        <li><i class="bi bi-check-circle-fill"></i>Minimum: $5,000</li>
                        <li><i class="bi bi-check-circle-fill"></i>Maximum: $10,000</li>
                        <li><i class="bi bi-check-circle-fill"></i>Principal return included</li>
                        <li><i class="bi bi-check-circle-fill"></i>Auto withdrawal</li>
                        <li><i class="bi bi-check-circle-fill"></i>Personal account manager</li>
                    </ul>
                    <button class="invest-btn btn-outline-inv"
                            onclick="openModal('Exclusive Plan', 5000, 10000, 100, '72 Hours')">
                        <i class="bi bi-lightning-charge-fill me-1"></i>Invest Now
                    </button>
                </div>

                <!-- VIP Plan -->
                <div class="plan-card gold-card fade-in">
                    <div class="plan-pop gold">VIP</div>
                    <div class="plan-icon">🏆</div>
                    <div class="plan-name">VIP Plan</div>
                    <div class="plan-roi-big"
                         style="background:linear-gradient(135deg,var(--gold),#e6a817);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                        <sup style="-webkit-text-fill-color:var(--gold);color:var(--gold);">+</sup>200<sup
                            style="font-size:1rem;-webkit-text-fill-color:var(--gold);color:var(--gold);">%</sup>
                    </div>
                    <div class="plan-dur"><i class="bi bi-clock me-1"></i>Returns after 7 Days</div>
                    <div class="plan-divider"></div>
                    <ul class="plan-feats">
                        <li><i class="bi bi-check-circle-fill"></i>Minimum: $10,000</li>
                        <li><i class="bi bi-check-circle-fill"></i>Maximum: Unlimited</li>
                        <li><i class="bi bi-check-circle-fill"></i>Principal return included</li>
                        <li><i class="bi bi-check-circle-fill"></i>Auto withdrawal</li>
                        <li><i class="bi bi-check-circle-fill"></i>VIP dedicated manager</li>
                    </ul>
                    <button class="invest-btn btn-gold-inv"
                            onclick="openModal('VIP Plan', 10000, null, 200, '7 Days')">
                        <i class="bi bi-lightning-charge-fill me-1"></i>Invest Now
                    </button>
                </div>

            </div>

            <!-- My Investments -->
            <div class="dash-card fade-in">
                <div class="card-header">
                    <h3><i class="bi bi-activity me-2" style="color:var(--green);"></i>My Investments</h3>
                    <a href="{{ route('user.history') }}" class="view-all">View History</a>
                </div>
                @forelse($investments as $inv)
                <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 0;border-bottom:1px solid rgba(255,255,255,.05);">
                    <div style="display:flex;align-items:center;gap:14px;">
                        <div class="tx-icon in"><i class="bi bi-graph-up-arrow"></i></div>
                        <div>
                            <div style="font-weight:600;font-size:.9rem;">{{ $inv->plan }}</div>
                            <div class="tx-date">{{ $inv->created_at->format('M j, Y') }} &bull; Matures {{ $inv->maturity_at->format('M j, Y') }}</div>
                        </div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-weight:700;color:var(--green);">+${{ number_format($inv->total_return, 2) }}</div>
                        <div style="font-size:.78rem;color:var(--text-muted);">Invested: ${{ number_format($inv->amount, 2) }} &bull; ROI {{ $inv->roi }}%</div>
                        <span class="dep-status {{ $inv->status_class }}">{{ $inv->status_label }}</span>
                    </div>
                </div>
                @empty
                <div class="empty-state" id="emptyInvest">
                    <i class="bi bi-graph-up"></i>
                    <p>No active investments yet. Choose a plan above to get started.</p>
                </div>
                @endforelse
            </div>

        </main>

        <!-- Invest Modal -->
        <div class="modal-overlay" id="investModal">
            <div class="modal-box">
                <button class="modal-close" onclick="closeModal()"><i class="bi bi-x"></i></button>

                <div class="modal-plan-badge" id="modalBadge">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span id="modalPlanName">Regular Plan</span>
                </div>

                <div class="modal-title">Confirm Investment</div>
                <div class="modal-desc">Enter the amount you wish to invest in this plan.</div>

                <form action="{{ route('user.invest.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="hiddenPlan" name="plan">

                    @if($errors->any())
                        <div style="background:rgba(255,79,112,.12);border:1px solid var(--red);color:var(--red);border-radius:10px;padding:10px 14px;margin-bottom:16px;font-size:.85rem;">
                            <i class="bi bi-exclamation-circle-fill me-1"></i>{{ $errors->first() }}
                        </div>
                    @endif

                    <div class="m-form-group">
                        <label class="m-label">Investment Amount (USD)</label>
                        <input type="number" class="m-input" id="modalAmount" name="amount"
                               placeholder="e.g. 500" step="any" min="0"
                               oninput="updateSummary()">
                        <span class="m-hint" id="modalRange">Min: $200 &mdash; Max: $1,000</span>
                    </div>

                    <div class="m-summary">
                        <div class="m-summary-row">
                            <span>Plan</span>
                            <span id="sumPlan">Regular Plan</span>
                        </div>
                        <div class="m-summary-row">
                            <span>ROI</span>
                            <span id="sumRoi" style="color:var(--green);">+50%</span>
                        </div>
                        <div class="m-summary-row">
                            <span>Duration</span>
                            <span id="sumDur">48 Hours</span>
                        </div>
                        <div class="m-summary-row">
                            <span>You invest</span>
                            <span id="sumAmount">&mdash;</span>
                        </div>
                        <div class="m-summary-row" style="padding-top:6px;border-top:1px solid var(--border);">
                            <span>You receive</span>
                            <span id="sumReturn" style="color:var(--green);font-size:.9rem;">&mdash;</span>
                        </div>
                    </div>

                    <button type="submit" class="m-submit" id="modalSubmitBtn">
                        <i class="bi bi-send-fill me-2"></i>Submit Investment
                    </button>
                </form>
            </div>
        </div>

<script>
let activePlan = { name: '', min: 0, max: null, roi: 0, dur: '' };

function openModal(name, min, max, roi, dur) {
    activePlan = { name, min, max, roi, dur };

    document.getElementById('investModal').classList.add('open');
    document.getElementById('modalPlanName').textContent = name;
    document.getElementById('hiddenPlan').value = name;
    document.getElementById('modalAmount').value = '';
    document.getElementById('modalAmount').min = min;
    if (max) {
        document.getElementById('modalAmount').max = max;
    } else {
        document.getElementById('modalAmount').removeAttribute('max');
    }
    document.getElementById('modalRange').innerHTML =
        'Min: $' + min.toLocaleString() +
        (max ? ' &mdash; Max: $' + max.toLocaleString() : ' &mdash; No maximum');

    document.getElementById('sumPlan').textContent = name;
    document.getElementById('sumRoi').textContent  = '+' + roi + '%';
    document.getElementById('sumDur').textContent  = dur;
    document.getElementById('sumAmount').textContent = '—';
    document.getElementById('sumReturn').textContent = '—';

    // VIP gold styling
    const btn   = document.getElementById('modalSubmitBtn');
    const badge = document.getElementById('modalBadge');
    if (roi >= 200) {
        btn.className = 'm-submit gold';
        badge.style.background = 'rgba(245,166,35,.15)';
        badge.style.color = 'var(--gold)';
    } else {
        btn.className = 'm-submit';
        badge.style.background = '';
        badge.style.color = '';
    }
}

function closeModal() {
    document.getElementById('investModal').classList.remove('open');
}

// close on backdrop click
document.getElementById('investModal').addEventListener('click', function (e) {
    if (e.target === this) closeModal();
});

function updateSummary() {
    const amt = parseFloat(document.getElementById('modalAmount').value);
    if (!amt || isNaN(amt)) {
        document.getElementById('sumAmount').textContent = '—';
        document.getElementById('sumReturn').textContent = '—';
        return;
    }
    const profit = amt * activePlan.roi / 100;
    const total  = amt + profit;
    const fmt = v => '$' + v.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById('sumAmount').textContent = fmt(amt);
    document.getElementById('sumReturn').textContent = fmt(total);
}
</script>

@include('user.footer')
