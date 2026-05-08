{{-- ========== TOPBAR + NAVBAR ========== --}}


<div class="topbar" id="topbar">
    <div style="overflow:hidden;flex:1">
        <div class="topbar-track">
            <span>🔒 SSL Secured Platform</span>
            <span>✓ 100% Auto Withdrawal</span>
            <span>📈 Up to 200% ROI</span>
            <span>⚡ 48-Hour Payouts</span>
            <span>🤝 5% Referral Bonus</span>
            <span>💬 24/7 Live Support</span>
            <span>🌍 Available Worldwide</span>
            <span>🔒 SSL Secured Platform</span>
            <span>✓ 100% Auto Withdrawal</span>
            <span>📈 Up to 200% ROI</span>
            <span>⚡ 48-Hour Payouts</span>
            <span>🤝 5% Referral Bonus</span>
            <span>💬 24/7 Live Support</span>
            <span>🌍 Available Worldwide</span>
        </div>
    </div>
    <button class="topbar-close" onclick="this.parentElement.style.display='none'" aria-label="Close">×</button>
</div>

<nav class="navbar" id="mainNav">
    <div class="nav-inner">
        <a class="nav-logo" href="/">
            <div class="nav-logo-mark">A</div>
            <div class="nav-logo-text">AnchorTrd <em>Ltd</em></div>
        </a>
        <div class="nav-links">
            <a href="/" class="active">Home</a>
            <a href="#how">How It Works</a>
            <a href="#plans">Plans</a>
            <a href="#methods">Methods</a>
        </div>
        <div class="nav-actions">
            <a href="{{ route('login') }}" class="nav-login">Login</a>
            <a href="{{ route('register') }}" class="nav-register">Get Started</a>
        </div>
        <button class="hamburger" id="hamburger" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </div>
    <div class="nav-drawer" id="navDrawer">
        <a href="/">Home</a>
        <a href="#how">How It Works</a>
        <a href="#plans">Plans</a>
        <a href="#methods">Methods</a>
        <div class="drawer-actions">
            <a href="{{ route('login') }}" class="d-login">Login</a>
            <a href="{{ route('register') }}" class="d-register">Get Started</a>
        </div>
    </div>
</nav>

<script>
(function(){
    var h = document.getElementById('hamburger');
    var d = document.getElementById('navDrawer');
    var n = document.getElementById('mainNav');
    h.addEventListener('click', function(){ h.classList.toggle('open'); d.classList.toggle('open'); });
    d.querySelectorAll('a').forEach(function(a){ a.addEventListener('click', function(){ h.classList.remove('open'); d.classList.remove('open'); }); });
    window.addEventListener('scroll', function(){ n.classList.toggle('scrolled', window.scrollY > 10); }, { passive: true });
})();
</script>