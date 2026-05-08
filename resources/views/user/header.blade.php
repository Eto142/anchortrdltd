<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | anchortrdltd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/user-dashboard.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                 <div class="nav-logo-mark">A</div>
            <div class="nav-logo-text">AnchorTrd <em>Ltd</em></div>
            </div>
            <div class="user-section">
                <div class="user-avatar">{{ Auth::user()->name }}</div>
                <div class="user-info">
                    <div class="u-name">{{ Auth::user()->name }}</div>
                    <div class="u-role">Investor Account</div>
                </div>
            </div>
            <nav class="nav-menu">
                <span class="nav-section-label">Main</span>
                <a href="#" class="nav-item active"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a>
                <a href="{{ route('user.deposit') }}" class="nav-item"><i class="bi bi-cash-coin"></i><span>Deposit</span></a>
                <a href="{{ route('user.invest') }}" class="nav-item"><i class="bi bi-graph-up-arrow"></i><span>Invest</span></a>
                <a href="{{ route('user.withdraw') }}" class="nav-item"><i class="bi bi-arrow-up-circle"></i><span>Withdraw</span></a>
                <span class="nav-section-label">Account</span>
                <a href="{{ route('user.profile') }}" class="nav-item"><i class="bi bi-person-circle"></i><span>Profile</span></a>
                <a href="{{ route('user.history') }}" class="nav-item"><i class="bi bi-clock-history"></i><span>History</span></a>
                <a href="{{ route('user.support') }}" class="nav-item"><i class="bi bi-headset"></i><span>Support</span></a>
                <a href="#" class="nav-item danger" onclick="event.preventDefault(); document.getElementById('user-logout-form').submit();"><i class="bi bi-box-arrow-right"></i><span>Logout</span></a>
            </nav>
        </aside>

        {{-- Hidden logout form (POST required by Laravel CSRF protection) --}}
        <form id="user-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>

        <nav class="top-nav">
            <button class="nav-toggle" id="navToggle"><i class="bi bi-list"></i></button>
            <span class="brand-mobile">anchortrdltd</span>
            <div class="nav-spacer"></div>
            <div class="nav-actions">
                <div class="user-dropdown" id="userDropdown">
                    <button class="user-dropdown-btn" id="userDropdownBtn">
                        <div class="user-avatar-sm">{{ Auth::user()->name }}</div>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="#" class="dropdown-item"><i class="bi bi-person"></i><span>Profile</span></a>
                        <a href="#" class="dropdown-item"><i class="bi bi-gear"></i><span>Settings</span></a>
                        <a href="#" class="dropdown-item text-danger" onclick="event.preventDefault(); document.getElementById('user-logout-form').submit();"><i class="bi bi-box-arrow-right"></i><span>Logout</span></a>
                    </div>
                </div>
            </div>
        </nav>
