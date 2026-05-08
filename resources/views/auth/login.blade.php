@php $errors ??= new \Illuminate\Support\ViewErrorBag; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>Sign In – AnchorTrd Ltd</title>
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
    width: 100%; max-width: 440px;
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

/* ── HEADING ── */
.auth-head { text-align: center; margin-bottom: 32px; }
.auth-head h1 { font-size: 1.65rem; font-weight: 900; letter-spacing: -.025em; margin-bottom: 8px; }
.auth-head p  { font-size: 13.5px; color: var(--t2); line-height: 1.6; }

/* ── FORM ELEMENTS ── */
.auth-form  { display: flex; flex-direction: column; gap: 16px; }
.form-group { display: flex; flex-direction: column; gap: 7px; }
.form-label {
    font-size: 11.5px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .07em; color: var(--t3);
}
.form-label-row { display: flex; justify-content: space-between; align-items: center; }
.form-label-row a { font-size: 11.5px; font-weight: 600; color: var(--sky); text-decoration: none; }
.form-label-row a:hover { text-decoration: underline; }
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

/* ── REMEMBER ROW ── */
.form-remember {
    display: flex; align-items: center; gap: 9px;
    font-size: 13px; color: var(--t2); cursor: pointer;
    margin-top: 2px;
}
.form-remember input[type="checkbox"] {
    width: 16px; height: 16px; accent-color: var(--blue);
    border-radius: 4px; cursor: pointer;
}

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

/* ── DIVIDER ── */
.auth-divider {
    display: flex; align-items: center; gap: 12px;
    font-size: 11px; color: var(--t3); margin: 4px 0;
}
.auth-divider::before, .auth-divider::after {
    content: ''; flex: 1; height: 1px; background: var(--border);
}

/* ── FOOTER LINK ── */
.auth-footer { text-align: center; margin-top: 24px; font-size: 13px; color: var(--t2); }
.auth-footer a { color: var(--sky); font-weight: 600; text-decoration: none; }
.auth-footer a:hover { text-decoration: underline; }

/* ── ALERT ── */
.auth-alert {
    border-radius: 12px; padding: 12px 16px;
    font-size: 13px; font-weight: 600; margin-bottom: 4px;
    display: flex; align-items: flex-start; gap: 10px;
}
.auth-alert.error   { background: rgba(239,68,68,.1); border: 1px solid rgba(239,68,68,.25); color: #fca5a5; }
.auth-alert.success { background: rgba(16,185,129,.1); border: 1px solid rgba(16,185,129,.25); color: var(--green2); }

/* ── TRUST STRIP ── */
.auth-trust {
    display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;
    margin-top: 24px;
}
.auth-trust span { font-size: 11px; color: var(--t3); display: flex; align-items: center; gap: 5px; }

/* ── INFO HINT ── */
.auth-hint {
    background: rgba(14,165,233,.06);
    border: 1px solid rgba(14,165,233,.15);
    border-radius: 10px; padding: 11px 14px;
    font-size: 12px; color: var(--t2); line-height: 1.6;
}

/* ── RESPONSIVE ── */
@media (max-width: 480px) {
    .auth-card { padding: 32px 24px 28px; }
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

        <div class="auth-head">
            <h1>Welcome back</h1>
            <p>Sign in to your account to manage your investments</p>
        </div>

        {{-- Global validation errors --}}
        @isset($errors)
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
        @endisset

        {{-- Success / logout flash --}}
        @if (session('success'))
        <div class="auth-alert success" style="margin-bottom:20px;">
            <span>✓</span> {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="auth-form" novalidate>
            @csrf

            {{-- Email / Account ID --}}
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    class="form-input @error('email') is-error @enderror"
                    placeholder="you@example.com or Account ID"
                    value="{{ old('email') }}"
                    autocomplete="username"
                    required
                    autofocus
                />
                @error('email')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <div class="form-label-row">
                    <label class="form-label" for="password">Password</label>
                    {{-- <a href="#">Forgot password?</a> --}}
                </div>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input @error('password') is-error @enderror"
                    placeholder="Your password"
                    autocomplete="current-password"
                    required
                />
                @error('password')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember me --}}
            <label class="form-remember">
                <input type="checkbox" name="remember"/>
                Keep me signed in
            </label>

            <button type="submit" class="auth-submit">
                Sign In &rarr;
            </button>
        </form>

        <div class="auth-divider" style="margin-top:24px;">New to AnchorTrd?</div>

        <div class="auth-footer">
            <a href="{{ route('register') }}">Create a free account</a>
        </div>

    </div>

    <div class="auth-trust">
        <span>🔒 SSL Secured</span>
        <span>✓ Auto Withdrawal</span>
        <span>⚡ Fast Payouts</span>
    </div>

</div>
</body>
</html>
