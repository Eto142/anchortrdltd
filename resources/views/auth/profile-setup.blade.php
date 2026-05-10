@php $errors ??= new \Illuminate\Support\ViewErrorBag; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>Personal Info – AnchorTrd Ltd</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="/css/home.css"/>
<style>
/* ── AUTH PAGE LAYOUT ── */
.auth-page {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 32px 20px;
    position: relative;
    background: var(--bg);
}
.auth-page::before {
    content: '';
    position: fixed; inset: 0; pointer-events: none;
    background:
        radial-gradient(ellipse 60% 50% at 20% 20%, rgba(37,99,235,.12) 0%, transparent 60%),
        radial-gradient(ellipse 50% 60% at 80% 75%, rgba(14,165,233,.08) 0%, transparent 55%);
}
.auth-grid {
    position: fixed; inset: 0; pointer-events: none;
    background-image:
        linear-gradient(rgba(255,255,255,.015) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.015) 1px, transparent 1px);
    background-size: 64px 64px;
    mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, black 30%, transparent 100%);
}

/* ── AUTH CARD ── */
.auth-card {
    width: 100%; max-width: 520px;
    background: var(--s2);
    border: 1px solid rgba(37,99,235,.2);
    border-radius: 28px;
    padding: 44px 44px 40px;
    box-shadow: 0 32px 80px rgba(0,0,0,.55), inset 0 1px 0 rgba(255,255,255,.05);
    position: relative; z-index: 1;
}

/* ── BRAND TOP ── */
.auth-brand {
    display: flex; align-items: center; justify-content: center; gap: 10px;
    margin-bottom: 28px;
    text-decoration: none;
}
.auth-brand-mark {
    width: 36px; height: 36px; border-radius: 10px;
    background: linear-gradient(135deg, var(--blue), var(--sky));
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; font-weight: 900; color: #fff;
    box-shadow: 0 4px 18px rgba(37,99,235,.45);
}
.auth-brand-name { font-size: 17px; font-weight: 800; color: var(--t1); letter-spacing: -.01em; }
.auth-brand-name em { font-style: normal; color: rgba(255,255,255,.3); font-weight: 500; font-size: 14px; }

/* ── STEP INDICATOR ── */
.auth-steps {
    display: flex; align-items: center; justify-content: center; gap: 0;
    margin-bottom: 32px;
}
.step-item {
    display: flex; flex-direction: column; align-items: center; gap: 6px;
}
.step-circle {
    width: 32px; height: 32px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 800;
}
.step-circle.done {
    background: rgba(16,185,129,.2);
    border: 2px solid rgba(16,185,129,.5);
    color: #10b981;
}
.step-circle.active {
    background: linear-gradient(135deg, var(--blue), var(--sky));
    border: none;
    color: #fff;
    box-shadow: 0 4px 16px rgba(37,99,235,.45);
}
.step-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--t3); }
.step-label.active { color: var(--sky); }
.step-connector {
    width: 48px; height: 2px;
    background: rgba(255,255,255,.08);
    margin: 0 6px;
    margin-bottom: 22px;
}
.step-connector.done { background: rgba(16,185,129,.3); }

/* ── HEADING ── */
.auth-head { text-align: center; margin-bottom: 32px; }
.auth-head h1 { font-size: 1.65rem; font-weight: 900; letter-spacing: -.025em; margin-bottom: 8px; }
.auth-head p  { font-size: 13.5px; color: var(--t2); line-height: 1.6; }

/* ── FORM ELEMENTS ── */
.auth-form { display: flex; flex-direction: column; gap: 16px; }
.form-row   { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.form-group { display: flex; flex-direction: column; gap: 7px; }
.form-label {
    font-size: 11.5px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .07em; color: var(--t3);
}
.form-label .optional {
    font-weight: 400; text-transform: none; letter-spacing: 0;
    font-size: 11px; color: var(--t3); opacity: .6; margin-left: 4px;
}
.form-input {
    background: rgba(255,255,255,.04);
    border: 1px solid var(--border);
    border-radius: 11px;
    padding: 13px 16px;
    font-size: 14px; font-weight: 500;
    color: var(--t1);
    font-family: 'Inter', sans-serif;
    transition: border-color .2s, box-shadow .2s;
    outline: none; width: 100%;
}
.form-input::placeholder { color: var(--t3); }
.form-input:focus {
    border-color: rgba(37,99,235,.55);
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
    background: rgba(37,99,235,.04);
}
.form-input.is-error { border-color: rgba(239,68,68,.5); }
.form-input.is-error:focus { box-shadow: 0 0 0 3px rgba(239,68,68,.1); }
.field-error { font-size: 11.5px; color: #f87171; margin-top: 1px; }

/* ── SUBMIT ── */
.auth-submit {
    width: 100%;
    padding: 15px;
    border-radius: 12px;
    font-size: 14.5px; font-weight: 800;
    color: #fff; border: none; cursor: pointer;
    background: linear-gradient(135deg, var(--blue), var(--blue2));
    box-shadow: 0 6px 28px rgba(37,99,235,.4);
    transition: all .22s;
    margin-top: 4px;
    position: relative; overflow: hidden;
}
.auth-submit::after {
    content: '';
    position: absolute; top: 0; left: -100%; width: 60%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,.15), transparent);
    transform: skewX(-20deg); transition: left .55s;
}
.auth-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 40px rgba(37,99,235,.55); }
.auth-submit:hover::after { left: 160%; }

/* ── SKIP LINK ── */
.auth-footer { text-align: center; margin-top: 20px; font-size: 13px; color: var(--t2); }
.auth-footer a { color: var(--t3); font-weight: 500; text-decoration: none; transition: color .2s; }
.auth-footer a:hover { color: var(--sky); }

/* ── ALERT ── */
.auth-alert {
    border-radius: 12px; padding: 12px 16px;
    font-size: 13px; font-weight: 600; margin-bottom: 4px;
    display: flex; align-items: flex-start; gap: 10px;
}
.auth-alert.error { background: rgba(239,68,68,.1); border: 1px solid rgba(239,68,68,.25); color: #fca5a5; }

/* ── INFO BADGE ── */
.info-badge {
    background: rgba(37,99,235,.08);
    border: 1px solid rgba(37,99,235,.18);
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 12.5px; color: var(--t2); line-height: 1.55;
    display: flex; gap: 10px; align-items: flex-start;
}
.info-badge-icon { font-size: 15px; margin-top: 1px; flex-shrink: 0; }

/* ── TRUST STRIP ── */
.auth-trust {
    display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;
    margin-top: 24px;
}
.auth-trust span { font-size: 11px; color: var(--t3); display: flex; align-items: center; gap: 5px; }

/* ── RESPONSIVE ── */
@media (max-width: 520px) {
    .auth-card { padding: 32px 24px 28px; }
    .form-row  { grid-template-columns: 1fr; }
    .step-connector { width: 28px; }
}
</style>
</head>
<body>
<div class="auth-page">
    <div class="auth-grid"></div>

    <a href="{{ route('home') }}" class="auth-brand">
        <div class="auth-brand-mark">A</div>
        <div class="auth-brand-name">AnchorTrd <em>Ltd</em></div>
    </a>

    <div class="auth-card">

        {{-- Step Indicator --}}
        <div class="auth-steps">
            <div class="step-item">
                <div class="step-circle done">✓</div>
                <span class="step-label">Account</span>
            </div>
            <div class="step-connector done"></div>
            <div class="step-item">
                <div class="step-circle active">2</div>
                <span class="step-label active">Profile</span>
            </div>
            <div class="step-connector"></div>
            <div class="step-item">
                <div class="step-circle" style="background:rgba(255,255,255,.06);border:2px solid var(--border);color:var(--t3);">3</div>
                <span class="step-label">Dashboard</span>
            </div>
        </div>

        <div class="auth-head">
            <h1>Personal Information</h1>
            <p>Help us personalise your experience. You can update these anytime.</p>
        </div>

        {{-- Validation errors --}}
        @if ($errors->any())
        <div class="auth-alert error" style="margin-bottom:20px;">
            <span>⚠</span>
            <div>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
        @endif

        <form action="{{ route('register.profile.save') }}" method="POST" class="auth-form" novalidate>
            @csrf

            {{-- Phone --}}
            <div class="form-group">
                <label class="form-label" for="phone">Phone Number</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    class="form-input @error('phone') is-error @enderror"
                    placeholder="+1 555 000 0000"
                    value="{{ old('phone') }}"
                    autocomplete="tel"
                    required
                />
                @error('phone')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Country / State --}}
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="country">Country</label>
                    <input
                        type="text"
                        id="country"
                        name="country"
                        class="form-input @error('country') is-error @enderror"
                        placeholder="United States"
                        value="{{ old('country') }}"
                        autocomplete="country-name"
                        required
                    />
                    @error('country')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="state">State / Region <span class="optional">(optional)</span></label>
                    <input
                        type="text"
                        id="state"
                        name="state"
                        class="form-input @error('state') is-error @enderror"
                        placeholder="California"
                        value="{{ old('state') }}"
                        autocomplete="address-level1"
                    />
                    @error('state')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Address --}}
            <div class="form-group">
                <label class="form-label" for="address">Home Address <span class="optional">(optional)</span></label>
                <input
                    type="text"
                    id="address"
                    name="address"
                    class="form-input @error('address') is-error @enderror"
                    placeholder="123 Main Street"
                    value="{{ old('address') }}"
                    autocomplete="street-address"
                />
                @error('address')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Date of Birth --}}
            <div class="form-group">
                <label class="form-label" for="dob">Date of Birth <span class="optional">(optional)</span></label>
                <input
                    type="date"
                    id="dob"
                    name="dob"
                    class="form-input @error('dob') is-error @enderror"
                    value="{{ old('dob') }}"
                    max="{{ date('Y-m-d', strtotime('-1 day')) }}"
                />
                @error('dob')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="info-badge" style="margin-top:4px;">
                <span class="info-badge-icon">🔒</span>
                <span>Your personal information is encrypted and never shared with third parties.</span>
            </div>

            <button type="submit" class="auth-submit">
                Continue to Dashboard &rarr;
            </button>
        </form>

        <div class="auth-footer">
            <a href="{{ route('user.dashboard') }}">Skip for now</a>
        </div>

    </div>

    <div class="auth-trust">
        <span>🔒 SSL Secured</span>
        <span>✓ Auto Withdrawal</span>
        <span>⚡ Instant Access</span>
    </div>

</div>
</body>
</html>
