  <nav class="mobile-nav mobile-nav-enhanced">
            <a href="{{ route('user.dashboard') }}" class="mobile-nav-item active" id="mobileDashboard">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            {{-- <a href="{{ route('user.deposit') }}" class="mobile-nav-item" id="mobileDeposit">
                <i class="bi bi-cash-stack"></i>
                <span>Deposit</span>
            </a> --}}
            <a href="{{ route('user.transfer') }}" class="mobile-nav-item" id="mobileTransfer">
                <i class="bi bi-arrow-left-right"></i>
                <span>Transfer</span>
            </a>
            <a href="{{ route('user.profile') }}" class="mobile-nav-item" id="mobileProfile">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
            <a href="#" class="mobile-nav-item" id="mobileLogout" onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </nav>
        <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
    </div>