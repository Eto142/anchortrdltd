    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <div class="sidebar-logo">
                   
                </div>
                 <div class="nav-logo-mark">A</div>
            <div class="nav-logo-text">AnchorTrd <em>Ltd</em></div>
            </div>

            <!-- User Section -->
            <div class="user-section">
                <div class="user-avatar">{{ Auth::user()->name }}</div>
                <div class="user-info">
                    <h5>{{ Auth::user()->name }}</h5>
                    {{-- <p>Premium Account</p> --}}
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="nav-menu">
                <a href="{{ route('user.dashboard') }}" class="nav-item active">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
                 <a href="{{ route('user.transfer') }}" class="nav-item">
                    <i class="bi bi-arrow-left-right"></i>
                    <span>Transfers</span>
                </a>
                <a href="{{ route('user.profile') }}" class="nav-item">
                    <i class="bi bi-wallet2"></i>
                    <span>Profile</span>
                </a>
               
                {{-- <a href="#" class="nav-item">
                    <i class="bi bi-cash-stack"></i>
                    <span>Deposit</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="bi bi-credit-card"></i>
                    <span>Cards</span>
                </a> --}}
                {{-- <a href="#" class="nav-item">
                    <i class="bi bi-graph-up"></i>
                    <span>Investments</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="bi bi-receipt"></i>
                    <span>Statements</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="bi bi-shield-check"></i>
                    <span>Security</span>
                </a> --}}
                <a href="#" class="nav-item" onclick="event.preventDefault(); document.getElementById('navbar-logout-form').submit();">
                    <i class="bi bi-gear"></i>
                    <span>Logout</span>
                </a>
            </nav>

            {{-- Hidden logout form --}}
            <form id="navbar-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>

            <!-- Sidebar Footer -->
            <div class="sidebar-footer">
                <button class="sidebar-btn" id="newAccountBtn">
                    <i class="bi bi-plus-circle"></i>
                    <span>New Account</span>
                </button>
                <button class="sidebar-btn secondary" id="helpCenterBtn">
                    <i class="bi bi-question-circle"></i>
                    <span>Help Center</span>
                </button>
            </div>
        </aside>

        <!-- Top Navigation -->
        <nav class="top-nav">
            <button class="nav-toggle" id="navToggle">
                <i class="bi bi-list"></i>
            </button>

            <div class="brand-mobile">anchortrdltd</div>

            <div class="nav-spacer"></div>

            {{-- <div class="nav-search">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Search..." id="searchInput">
            </div> --}}

            <div class="nav-actions">
                {{-- <div class="nav-action-btn notification-btn" id="notificationBtn">
                    <i class="bi bi-bell"></i>
                    <span class="notification-badge">3</span>
                </div> --}}

                <div class="user-dropdown" id="userDropdown">
                    <button class="user-dropdown-btn" id="userDropdownBtn">
                        <div class="user-avatar-sm">{{ Auth::user()->name }}</div>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ route('user.profile') }}" class="dropdown-item" id="profileLink">
                            <i class="bi bi-person"></i>
                            <span>Profile</span>
                        </a>
                        {{-- <a href="#" class="dropdown-item" id="settingsLink">
                            <i class="bi bi-gear"></i>
                            <span>Settings</span>
                        </a>
                        <a href="#" class="dropdown-item" id="securityLink">
                            <i class="bi bi-shield-check"></i>
                            <span>Security</span>
                        </a> --}}
                        <a href="#" class="dropdown-item text-danger" id="logoutLink" onclick="event.preventDefault(); document.getElementById('navbar-logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>