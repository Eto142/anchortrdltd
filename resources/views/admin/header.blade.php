<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body>
    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar Toggle Button (Mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="">
        </div>
        
        <div class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.users') }}" class="nav-link">
                <i class="fas fa-users"></i>
                <span>Manage Users</span>
            </a>
            
            <a href="{{ route('admin.transactions') }}" class="nav-link">
                <i class="fas fa-exchange-alt"></i>
                <span>Total Transactions</span>
            </a>
            

              <a href="{{ route('admin.manage.payment') }}" class="nav-link">
                <i class="fas fa-piggy-bank"></i>
                <span>Update Wallet</span>
            </a>
            

                {{-- <a href="{{ route('admin.deposits') }}" class="nav-link">
                <i class="fas fa-file-invoice-dollar"></i>
                <span> Deposits</span>
            </a> --}}
            
            {{-- <a href="{{ route('admin.loans') }}" class="nav-link">
                <i class="fas fa-hand-holding-usd"></i>
                <span>Loans</span>
            </a>
             --}}
            {{-- <a href="{{ route('admin.send.email') }}" class="nav-link">
                <i class="fas fa-credit-card"></i>
                <span>Send Mail</span>
            </a> --}}
{{--             
              <a href="{{ route('admin.transactions') }}" class="nav-link">
                <i class="fas fa-exchange-alt"></i>
                <span>Total Transactions</span>
               
            </a> --}}
        
            
            {{-- <a href="#" class="nav-link">
                <i class="fas fa-chart-line"></i>
                <span>Reports</span>
            </a> --}}
            
          <!-- Logout Link with Hidden Form -->
<a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
    <i class="fas fa-sign-out-alt"></i>
    <span>Logout</span>
</a>

<!-- Hidden Logout Form -->
<form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>

        </div>
        
     
        </div>
    </div>
