<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>AnchorTrd Ltd – Smart Crypto Investment Platform</title>
<meta name="description" content="Grow your wealth through professional crypto trading. Up to 200% ROI. Auto withdrawals. 24/7 support."/>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="/css/home.css"/>
</head>
<body>

@include('home.header')

<!-- ══════════════════════════════ HERO ══════════════════════════════ -->
<section class="hero" id="home">
  <div class="hero-gfx"></div>
  <div class="hero-grid"></div>
  <div class="orb" style="width:500px;height:500px;background:rgba(37,99,235,.09);top:-120px;right:-80px;animation-duration:18s;"></div>
  <div class="orb" style="width:320px;height:320px;background:rgba(14,165,233,.06);bottom:-60px;left:5%;animation-duration:13s;animation-delay:-5s;"></div>
  <div class="orb" style="width:200px;height:200px;background:rgba(16,185,129,.04);top:40%;left:40%;animation-duration:20s;animation-delay:-9s;"></div>
  <div class="hero-inner">
    <!-- Left -->
    <div>
      <div class="hero-badge"><div class="hb-dot"></div> Live & Trusted Since 2020</div>
      <h1 class="h-xl">Welcome to<br><span class="grad">AnchorTrd Ltd</span></h1>
      <p class="body-lg" style="max-width:500px;margin-top:18px;">
        We help you grow your future through technological possibilities by earning Profits in crypto currency Trading 💸💸💸
      </p>
      <div class="hero-actions">
        <a href="{{ route('register') }}" class="btn btn-blue btn-lg">Start Investing</a>
        <a href="#plans" class="btn btn-ghost btn-lg">View Plans &darr;</a>
      </div>
      <div class="hero-chips">
        <div class="chip"><div class="cd cd-g"></div> 100% Auto Withdrawal</div>
        <div class="chip"><div class="cd cd-s"></div> 24/7 Live Support</div>
        <div class="chip"><div class="cd cd-a"></div> 5% Referral Bonus</div>
      </div>
    </div>
    <!-- Right – Dashboard Widget -->
    <div class="hw">
      <div class="hw-head">
        <div class="hw-logo"><div class="hw-logo-i">A</div> AnchorTrd Portfolio</div>
        <div class="hw-live">Live</div>
      </div>
      <div class="hw-lbl">Total Platform Earnings</div>
      <div class="hw-bal"><sup>$</sup><span data-target="4872650" data-prefix="$" class="counter-val">4,872,650</span></div>
      <div class="hw-chg">&#9650; +$12,400 Today</div>
      <div class="hw-chart">
        <svg viewBox="0 0 260 60" fill="none" style="width:100%;height:60px">
          <defs>
            <linearGradient id="sg" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#2563eb" stop-opacity=".35"/>
              <stop offset="100%" stop-color="#2563eb" stop-opacity="0"/>
            </linearGradient>
          </defs>
          <path d="M0,52 C20,50 35,44 55,36 C75,28 90,32 110,22 C130,12 145,18 165,10 C180,4 200,8 220,4 C235,1 248,3 260,1" stroke="#2563eb" stroke-width="2" fill="none" stroke-linecap="round"/>
          <path d="M0,52 C20,50 35,44 55,36 C75,28 90,32 110,22 C130,12 145,18 165,10 C180,4 200,8 220,4 C235,1 248,3 260,1 L260,60 L0,60 Z" fill="url(#sg)"/>
        </svg>
      </div>
      <div class="hw-stats">
        <div class="hw-s">
          <div class="hw-s-l">Active Investors</div>
          <div class="hw-s-v" style="color:var(--sky)">18,240+</div>
        </div>
        <div class="hw-s">
          <div class="hw-s-l">Paid Out</div>
          <div class="hw-s-v" style="color:var(--green)">$9.2M+</div>
        </div>
        <div class="hw-s">
          <div class="hw-s-l">Min ROI</div>
          <div class="hw-s-v">50%</div>
        </div>
        <div class="hw-s">
          <div class="hw-s-l">Max ROI</div>
          <div class="hw-s-v" style="color:var(--gold)">200%</div>
        </div>
      </div>
      <div class="hw-bar-row">
        <div class="hw-bar-meta"><span>Portfolio Growth</span><span style="color:var(--sky)">78%</span></div>
        <div class="hw-bar-track"><div class="hw-bar-fill" style="width:78%"></div></div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════ MARQUEE ══════════════════════════════ -->
<div class="mstrip">
  <div class="mtrack">
    <div class="mitem up">&#9650; Bitcoin <span>BTC/USD</span> $94,210 <span>+2.4%</span></div>
    <div class="mitem up">&#9650; Ethereum <span>ETH/USD</span> $3,187 <span>+1.8%</span></div>
    <div class="mitem dn">&#9660; Litecoin <span>LTC/USD</span> $108 <span>-0.5%</span></div>
    <div class="mitem up">&#9650; USDT <span>Stable</span> $1.00 <span>+0.01%</span></div>
    <div class="mitem up">&#9650; Dogecoin <span>DOGE/USD</span> $0.182 <span>+3.1%</span></div>
    <div class="mitem dn">&#9660; Bitcoin Cash <span>BCH/USD</span> $488 <span>-1.2%</span></div>
    <div class="mitem up">&#9650; Platform ROI <span>Daily</span> Active <span>+200%</span></div>
    <div class="mitem up">&#9650; Withdrawals <span>Today</span> $47,820 <span>Paid</span></div>
    <!-- duplicate -->
    <div class="mitem up">&#9650; Bitcoin <span>BTC/USD</span> $94,210 <span>+2.4%</span></div>
    <div class="mitem up">&#9650; Ethereum <span>ETH/USD</span> $3,187 <span>+1.8%</span></div>
    <div class="mitem dn">&#9660; Litecoin <span>LTC/USD</span> $108 <span>-0.5%</span></div>
    <div class="mitem up">&#9650; USDT <span>Stable</span> $1.00 <span>+0.01%</span></div>
    <div class="mitem up">&#9650; Dogecoin <span>DOGE/USD</span> $0.182 <span>+3.1%</span></div>
    <div class="mitem dn">&#9660; Bitcoin Cash <span>BCH/USD</span> $488 <span>-1.2%</span></div>
    <div class="mitem up">&#9650; Platform ROI <span>Daily</span> Active <span>+200%</span></div>
    <div class="mitem up">&#9650; Withdrawals <span>Today</span> $47,820 <span>Paid</span></div>
  </div>
</div>

<!-- ══════════════════════════════ STATS ══════════════════════════════ -->
<div class="stats-band">
  <div class="wrap">
    <div class="stats-grid">
      <div class="stat-cell reveal">
        <div class="stat-num" style="color:var(--sky)"><span data-target="9" class="counter-val">9</span><span class="sfx">.2M+</span></div>
        <div class="stat-label">Total Withdrawn</div>
        <div class="stat-sub">&#9650; +$47k this week</div>
      </div>
      <div class="stat-cell reveal reveal-delay-1">
        <div class="stat-num"><span data-target="18240" class="counter-val">18,240</span><span class="sfx">+</span></div>
        <div class="stat-label">Active Investors</div>
        <div class="stat-sub">&#9650; +204 this week</div>
      </div>
      <div class="stat-cell reveal reveal-delay-2">
        <div class="stat-num" style="color:var(--gold)"><span data-target="200" class="counter-val">200</span><span class="sfx">%</span></div>
        <div class="stat-label">Max ROI — VIP Plan</div>
        <div class="stat-sub">&#9733; Top earners</div>
      </div>
      <div class="stat-cell reveal reveal-delay-3">
        <div class="stat-num" style="color:var(--green)"><span data-target="48" class="counter-val">48</span><span class="sfx">hr</span></div>
        <div class="stat-label">Fastest Payout</div>
        <div class="stat-sub">&#9650; Fully automatic</div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════ HOW IT WORKS ══════════════════════════════ -->
<section style="background:var(--s1)" id="how">
  <div class="wrap tc" style="padding-bottom:0">
    <div class="label reveal">Process</div>
    <h2 class="h-lg reveal">Simple Steps to <span class="grad">Get Started</span></h2>
    <p class="body-lg reveal">From sign-up to your first payout in as little as 48 hours.</p>
  </div>
  <div class="wrap" style="margin-top:36px;">
    <div class="how-wrap">
      <div class="how-line"></div>
      <div class="how-grid">
        <div class="how-card reveal">
          <div class="how-num-badge">01</div>
          <div class="how-title">Create an Account</div>
          <p class="how-desc">Sign up in seconds with just your email. Instant access, no lengthy KYC.</p>
        </div>
        <div class="how-card reveal reveal-delay-1">
          <div class="how-num-badge">02</div>
          <div class="how-title">Login to Dashboard</div>
          <p class="how-desc">Access your secure investor dashboard from any device, anywhere in the world.</p>
        </div>
        <div class="how-card reveal reveal-delay-2">
          <div class="how-num-badge">03</div>
          <div class="how-title">Deposit &amp; Choose Plan</div>
          <p class="how-desc">Fund your account with crypto and select the investment plan that fits your goals.</p>
        </div>
        <div class="how-card reveal reveal-delay-3">
          <div class="how-num-badge">04</div>
          <div class="how-title">Withdraw Profit</div>
          <p class="how-desc">Your profit + principal is returned automatically. 100% hands-free, zero delays.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════ PLANS ══════════════════════════════ -->
<section id="plans">
  <div class="wrap tc" style="padding-bottom:0">
    <div class="label reveal">Investment Plans</div>
    <h2 class="h-lg reveal">Choose Your <span class="grad">Growth Plan</span></h2>
    <p class="body-lg reveal">Every plan includes principal return, automatic payout &amp; 24/7 support.</p>
  </div>
  <div class="wrap" style="margin-top:36px;">
    <div class="plans-grid">
      <div class="pc reveal">
        <div class="pc-icon">🥈</div>
        <div class="pc-name">Regular Plan</div>
        <div class="pc-roi" style="color:var(--sky)"><sup>+</sup>50<sup style="font-size:1.4rem">%</sup></div>
        <div class="pc-dur">After 48 Hours</div>
        <div class="pc-div"></div>
        <ul class="pc-feats">
          <li>Minimum deposit: $200</li>
          <li>Maximum deposit: $1,000</li>
          <li>Principal return included</li>
          <li>Auto withdrawal</li>
          <li>24/7 support</li>
        </ul>
        <a href="{{ route('register') }}" class="btn btn-ghost" style="margin-top:24px;width:100%">Get Started</a>
      </div>
      <div class="pc feat reveal reveal-delay-1">
        <div class="pc-pop">Most Popular</div>
        <div class="pc-icon">🏅</div>
        <div class="pc-name">Premium Plan</div>
        <div class="pc-roi" style="color:var(--sky)"><sup>+</sup>80<sup style="font-size:1.4rem">%</sup></div>
        <div class="pc-dur">After 48 Hours</div>
        <div class="pc-div"></div>
        <ul class="pc-feats">
          <li>Minimum deposit: $1,000</li>
          <li>Maximum deposit: $5,000</li>
          <li>Principal return included</li>
          <li>Auto withdrawal</li>
          <li>Priority support</li>
        </ul>
        <a href="{{ route('register') }}" class="btn btn-blue" style="margin-top:24px;width:100%">Get Started</a>
      </div>
      <div class="pc reveal reveal-delay-2">
        <div class="pc-icon">🎖️</div>
        <div class="pc-name">Exclusive Plan</div>
        <div class="pc-roi" style="color:var(--gold)"><sup>+</sup>100<sup style="font-size:1.4rem">%</sup></div>
        <div class="pc-dur">After 72 Hours</div>
        <div class="pc-div"></div>
        <ul class="pc-feats">
          <li>Minimum deposit: $5,000</li>
          <li>Maximum deposit: $10,000</li>
          <li>Principal return included</li>
          <li>Auto withdrawal</li>
          <li>Personal account manager</li>
        </ul>
        <a href="{{ route('register') }}" class="btn btn-ghost" style="margin-top:24px;width:100%">Get Started</a>
      </div>
      <div class="pc reveal reveal-delay-3">
        <div class="pc-icon">🏆</div>
        <div class="pc-name">VIP Plan</div>
        <div class="pc-roi" style="background:linear-gradient(135deg,var(--gold),var(--gold2));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"><sup style="-webkit-text-fill-color:var(--gold);color:var(--gold)">+</sup>200<sup style="font-size:1.4rem;-webkit-text-fill-color:var(--gold);color:var(--gold)">%</sup></div>
        <div class="pc-dur">After 7 Days</div>
        <div class="pc-div"></div>
        <ul class="pc-feats">
          <li>Minimum deposit: $10,000</li>
          <li>Maximum: Unlimited</li>
          <li>Principal return included</li>
          <li>Auto withdrawal</li>
          <li>VIP dedicated manager</li>
        </ul>
        <a href="{{ route('register') }}" class="btn btn-gold" style="margin-top:24px;width:100%">Get Started</a>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════ WHY US ══════════════════════════════ -->
<section style="background:var(--s1)">
  <div class="wrap tc" style="padding-bottom:0">
    <div class="label reveal">Why AnchorTrd</div>
    <h2 class="h-lg reveal">Built on <span class="grad">Trust &amp; Security</span></h2>
    <p class="body-lg reveal">We grow, you grow — every feature is designed around your success.</p>
  </div>
  <div class="wrap" style="margin-top:36px;">
    <div class="why-grid">
      <div class="wc reveal"><div class="wc-icon">🔒</div><div class="wc-title">256-bit SSL Security</div><p class="wc-desc">Bank-grade encryption protects every transaction, deposit, and withdrawal on our platform.</p></div>
      <div class="wc reveal reveal-delay-1"><div class="wc-icon">⚡</div><div class="wc-title">Instant Auto Payouts</div><p class="wc-desc">Profits hit your wallet automatically — zero manual approval, zero waiting, fully hands-free.</p></div>
      <div class="wc reveal reveal-delay-2"><div class="wc-icon">📈</div><div class="wc-title">Up to 200% ROI</div><p class="wc-desc">Expert-managed crypto trading strategies deliver consistent, proven returns across all plan tiers.</p></div>
      <div class="wc reveal"><div class="wc-icon">🌍</div><div class="wc-title">Global Platform</div><p class="wc-desc">Invest from any country, any time zone. We support 7 major cryptocurrencies for deposits.</p></div>
      <div class="wc reveal reveal-delay-1"><div class="wc-icon">🤝</div><div class="wc-title">5% Referral Program</div><p class="wc-desc">Earn a 5% commission on every deposit made by investors you refer. Unlimited referrals.</p></div>
      <div class="wc reveal reveal-delay-2"><div class="wc-icon">📊</div><div class="wc-title">Transparent Dashboard</div><p class="wc-desc">Track all deposits, profits, and withdrawals in real-time through your personal investor dashboard.</p></div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════ TESTIMONIALS ══════════════════════════════ -->
<section>
  <div class="wrap tc" style="padding-bottom:0">
    <div class="label reveal">Investor Reviews</div>
    <h2 class="h-lg reveal">What Our <span class="grad">Investors Say</span></h2>
    <p class="body-lg reveal">Real results from real people growing their wealth with AnchorTrd Ltd.</p>
  </div>
  <div class="wrap" style="margin-top:36px;">
    <div class="tgrid">
      <div class="tcard reveal">
        <div class="tcard-stars">★★★★★</div>
        <p class="tcard-quote">I started with $500 on the Regular plan. 48 hours later I received $750 straight to my wallet. The process was completely seamless — I have been investing ever since.</p>
        <div class="tcard-foot">
          <div class="tcard-av">{{ Auth::user()?->name ?? 'JD' }}</div>
          <div><div class="tcard-name">James D.</div><div class="tcard-meta">🇺🇸 United States &middot; Regular Plan</div></div>
        </div>
      </div>
      <div class="tcard reveal reveal-delay-1">
        <div class="tcard-stars">★★★★★</div>
        <p class="tcard-quote">Withdrew my first profit of $4,000 from the Premium plan in 48 hours. The dashboard is clean and professional. I referred three friends and earned referral bonuses too.</p>
        <div class="tcard-foot">
          <div class="tcard-av">FA</div>
          <div><div class="tcard-name">Fatima A.</div><div class="tcard-meta">🇦🇪 UAE &middot; Premium Plan</div></div>
        </div>
      </div>
      <div class="tcard reveal reveal-delay-2">
        <div class="tcard-stars">★★★★★</div>
        <p class="tcard-quote">Invested $10,000 in the VIP plan and received $20,000 back after 7 days. My personal account manager was available throughout. Best investment decision I have made.</p>
        <div class="tcard-foot">
          <div class="tcard-av">RK</div>
          <div><div class="tcard-name">Richard K.</div><div class="tcard-meta">🇬🇧 United Kingdom &middot; VIP Plan</div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════ METHODS ══════════════════════════════ -->
<section style="background:var(--s1)" id="methods">
  <div class="wrap tc" style="padding-bottom:0">
    <div class="label reveal">Payment Methods</div>
    <h2 class="h-lg reveal">Accepted <span class="grad">Cryptocurrencies</span></h2>
    <p class="body-lg reveal">Deposit and withdraw using your preferred digital currency — fast, low-fee, secure.</p>
  </div>
  <div class="wrap" style="margin-top:36px;">
    <div class="coin-grid">
      <div class="cc reveal"><div class="cc-ic">₿</div><div class="cc-name">Bitcoin</div><div class="cc-sym">BTC</div></div>
      <div class="cc reveal reveal-delay-1"><div class="cc-ic">🅿️</div><div class="cc-name">Payeer</div><div class="cc-sym">P</div></div>
      <div class="cc reveal reveal-delay-2"><div class="cc-ic">₮</div><div class="cc-name">Tether</div><div class="cc-sym">USDT</div></div>
      <div class="cc reveal"><div class="cc-ic">Ł</div><div class="cc-name">Litecoin</div><div class="cc-sym">LTC</div></div>
      <div class="cc reveal reveal-delay-1"><div class="cc-ic">Ξ</div><div class="cc-name">Ethereum</div><div class="cc-sym">ETH</div></div>
      <div class="cc reveal reveal-delay-2"><div class="cc-ic">₿</div><div class="cc-name">Bitcoin Cash</div><div class="cc-sym">BCH</div></div>
      <div class="cc reveal"><div class="cc-ic">🐕</div><div class="cc-name">Dogecoin</div><div class="cc-sym">DOGE</div></div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════ CTA BAND ══════════════════════════════ -->
<div class="cta-band">
  <div class="cta-band-inner">
    <div class="label" style="margin:0 auto 20px;">Join 18,000+ Investors</div>
    <h2 class="cta-h">Ready to Grow Your Wealth<br>With <span class="grad">AnchorTrd Ltd?</span></h2>
    <p class="cta-p">Create your free account in under 2 minutes. Choose a plan, deposit, and watch your portfolio grow — automatically.</p>
    <div class="cta-btns">
      <a href="{{ route('register') }}" class="btn btn-blue btn-lg">Create Free Account</a>
      <a href="{{ route('login') }}" class="btn btn-ghost btn-lg">Login to Dashboard</a>
    </div>
  </div>
</div>

@include('home.footer')

<!-- ══════════════════════════════ JAVASCRIPT ══════════════════════════════ -->
<script>
/* ─ Scroll Reveal ─ */
(function(){
  var els = document.querySelectorAll('.reveal');
  if(!els.length) return;
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(e){ if(e.isIntersecting){ e.target.classList.add('visible'); io.unobserve(e.target); } });
  },{threshold:0.08});
  els.forEach(function(el){ io.observe(el); });
})();

/* ─ Twinkling Particles ─ */
(function(){
  var hero = document.querySelector('.hero');
  if(!hero) return;
  for(var i=0;i<28;i++){
    var p = document.createElement('div');
    var sz = Math.random()*2.5+1;
    var x = Math.random()*100, y = Math.random()*100;
    var dur = Math.random()*4+3, del = Math.random()*5;
    p.style.cssText='position:absolute;width:'+sz+'px;height:'+sz+'px;border-radius:50%;'
      +'left:'+x+'%;top:'+y+'%;pointer-events:none;z-index:2;'
      +'background:rgba(255,255,255,'+(Math.random()*.35+.08)+');'
      +'animation:twinkle '+dur+'s '+del+'s ease-in-out infinite;';
    hero.appendChild(p);
  }
  var st = document.createElement('style');
  st.textContent='@keyframes twinkle{0%,100%{opacity:0;transform:scale(.8);}50%{opacity:1;transform:scale(1);}}';
  document.head.appendChild(st);
})();

/* ─ Animated number update (live feel) ─ */
(function(){
  var chg = document.querySelector('.hw-chg');
  if(!chg) return;
  var vals = ['+$12,400','+$8,750','+$14,220','+$9,880','+$11,600'];
  var i=0;
  setInterval(function(){
    i=(i+1)%vals.length;
    chg.style.opacity='0';
    setTimeout(function(){ chg.innerHTML='&#9650; '+vals[i]+' Today'; chg.style.opacity='1'; },320);
  }, 4000);
  chg.style.transition='opacity .3s';
})();

/* ─ Count-Up ─ */
(function(){
  function countUp(el){
    var target = parseInt(el.getAttribute('data-target'));
    if(!target) return;
    var dur = 1800, step = target / (dur / 16), cur = 0;
    var t = setInterval(function(){
      cur += step;
      if(cur >= target){ cur = target; clearInterval(t); }
      el.textContent = Math.floor(cur).toLocaleString();
    }, 16);
  }
  var io2 = new IntersectionObserver(function(entries){
    entries.forEach(function(e){ if(e.isIntersecting){ countUp(e.target); io2.unobserve(e.target); } });
  },{threshold:0.4});
  document.querySelectorAll('.counter-val[data-target]').forEach(function(el){ io2.observe(el); });
})();

/* ─ Live Activity Feed ─ */
(function(){
  var acts = [
    {ic:'💰',name:'Michael T.',flag:'🇺🇸',action:'withdrew',amount:'+$1,840',plan:'Premium Plan'},
    {ic:'📈',name:'Adaeze K.',flag:'🇳🇬',action:'invested in',amount:'$1,000',plan:'Regular Plan'},
    {ic:'💸',name:'James W.',flag:'🇬🇧',action:'withdrew',amount:'+$2,400',plan:'Premium Plan'},
    {ic:'🏆',name:'Priya S.',flag:'🇮🇳',action:'invested in',amount:'$10,000',plan:'VIP Plan'},
    {ic:'💰',name:'Robert M.',flag:'🇺🇸',action:'withdrew',amount:'+$800',plan:'Regular Plan'},
    {ic:'📈',name:'Yusuf A.',flag:'🇦🇪',action:'invested in',amount:'$5,000',plan:'Exclusive Plan'},
    {ic:'💸',name:'Chen L.',flag:'🇸🇬',action:'withdrew',amount:'+$4,000',plan:'Premium Plan'},
    {ic:'💰',name:'Emeka O.',flag:'🇿🇦',action:'invested in',amount:'$2,500',plan:'Premium Plan'},
  ];
  var idx = 0;
  function show(){
    var a = acts[idx % acts.length]; idx++;
    var d = document.createElement('div');
    d.className = 'act-toast';
    d.innerHTML = '<div class="act-toast-ic">'+a.ic+'</div>'
      +'<div class="act-toast-body">'
      +'<div class="act-toast-title">'+a.flag+' '+a.name+' '+a.action+'</div>'
      +'<div class="act-toast-sub">'+a.plan+' &bull; just now</div>'
      +'</div>'
      +'<div class="act-toast-amt">'+a.amount+'</div>';
    document.body.appendChild(d);
    setTimeout(function(){ d.classList.add('show'); }, 80);
    setTimeout(function(){ d.classList.remove('show'); setTimeout(function(){ if(d.parentNode) d.parentNode.removeChild(d); }, 450); }, 4200);
  }
  setTimeout(function(){ show(); setInterval(show, 6500); }, 3000);
})();
</script>
</body>
</html>