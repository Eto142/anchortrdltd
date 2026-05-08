<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Funds | anchortrdltd</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Dashboard CSS (Same as main dashboard) -->
    <style>
        :root {
            --primary: #2a5bd7;
            --primary-dark: #1a365d;
            --secondary: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f8fafc;
            --dark: #1e293b;
            --border: #e2e8f0;
            --card-shadow: 0 4px 12px rgba(0,0,0,0.05);
            --hover-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background-color: #f5f7fa;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Dashboard Container */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: white;
            border-right: 1px solid var(--border);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-logo {
            width: 36px;
            height: 36px;
            background: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logo i {
            color: white;
            font-size: 1.2rem;
        }

        .bank-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-dark);
        }

        .user-section {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary), #667eea);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            font-size: 1rem;
        }

        .user-info h5 {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .user-info p {
            margin: 4px 0 0;
            font-size: 0.8rem;
            color: var(--secondary);
        }

        .nav-menu {
            flex: 1;
            padding: 1rem 0;
        }

        .nav-item {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--secondary);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .nav-item:hover {
            background: var(--light);
            color: var(--primary);
        }

        .nav-item.active {
            background: rgba(42, 91, 215, 0.05);
            color: var(--primary);
            font-weight: 500;
            border-left: 3px solid var(--primary);
        }

        .nav-item i {
            font-size: 1.1rem;
            width: 20px;
        }

        .nav-item span {
            font-size: 0.9rem;
        }

        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--border);
        }

        .sidebar-btn {
            width: 100%;
            padding: 0.75rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
            margin-bottom: 0.75rem;
        }

        .sidebar-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .sidebar-btn.secondary {
            background: transparent;
            color: var(--dark);
            border: 1px solid var(--border);
        }

        .sidebar-btn.secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Top Navigation */
        .top-nav {
            height: 60px;
            background: white;
            border-bottom: 1px solid var(--border);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 900;
            display: flex;
            align-items: center;
            padding: 0 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .nav-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: none;
            background: transparent;
            color: var(--dark);
            font-size: 1.25rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-toggle:hover {
            background: var(--light);
            color: var(--primary);
        }

        .brand-mobile {
            margin-left: 1rem;
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 1.1rem;
        }

        .nav-spacer {
            flex: 1;
        }

        .nav-search {
            position: relative;
            margin-right: 1rem;
            display: none;
        }

        @media (min-width: 768px) {
            .nav-search {
                display: block;
                width: 300px;
            }
        }

        .nav-search i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
            font-size: 0.9rem;
        }

        .nav-search input {
            width: 100%;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--light);
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .nav-search input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(42, 91, 215, 0.1);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-action-btn {
            width: 36px;
            height: 36px;
            border: 1px solid var(--border);
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-action-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: white;
            font-size: 0.65rem;
            min-width: 16px;
            height: 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            font-weight: 600;
        }

        .user-dropdown {
            position: relative;
        }

        .user-dropdown-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.4rem 0.75rem;
            background: white;
            border: 1px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }

        .user-dropdown-btn:hover {
            border-color: var(--primary);
        }

        .user-avatar-sm {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary), #667eea);
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: var(--hover-shadow);
            min-width: 180px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
            z-index: 1000;
            overflow: hidden;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.2s ease;
            border-bottom: 1px solid var(--border);
            font-size: 0.9rem;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background: var(--light);
            color: var(--primary);
        }

        .dropdown-item i {
            width: 16px;
            font-size: 1rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 60px 1rem 1rem;
            transition: margin-left 0.3s ease;
            max-width: 100%;
            overflow-x: hidden;
        }

        @media (min-width: 992px) {
            .sidebar {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 260px;
                padding: 80px 1.5rem 1.5rem;
            }
            
            .top-nav {
                left: 260px;
            }
            
            .nav-toggle {
                display: none;
            }
            
            .brand-mobile {
                display: none;
            }
        }

        /* Transfer Page Specific Styles */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .page-header p {
            color: var(--secondary);
            font-size: 0.95rem;
        }

        /* Transfer Container */
        .transfer-container {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Transfer Steps */
        .transfer-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .transfer-steps::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--border);
            z-index: 1;
        }

        .step {
            position: relative;
            z-index: 2;
            text-align: center;
            flex: 1;
        }

        .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: white;
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-weight: 600;
            color: var(--secondary);
            transition: all 0.3s ease;
        }

        .step.active .step-circle {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .step.completed .step-circle {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        .step.completed .step-circle i {
            display: block;
        }

        .step.completed .step-circle .step-number {
            display: none;
        }

        .step-circle i {
            display: none;
            font-size: 0.9rem;
        }

        .step-label {
            font-size: 0.85rem;
            color: var(--secondary);
            font-weight: 500;
        }

        .step.active .step-label {
            color: var(--primary);
        }

        .step.completed .step-label {
            color: var(--success);
        }

        /* Transfer Form */
        .transfer-form-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }

        .form-header {
            margin-bottom: 2rem;
        }

        .form-header h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: var(--secondary);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: var(--light);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(42, 91, 215, 0.1);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px 12px;
            padding-right: 3rem;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
        }

        .input-with-icon input {
            padding-left: 3rem;
        }

        .amount-input {
            position: relative;
        }

        .currency-symbol {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-weight: 600;
            color: var(--dark);
        }

        .amount-input input {
            padding-left: 2.5rem;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .form-note {
            font-size: 0.85rem;
            color: var(--secondary);
            margin-top: 0.5rem;
        }

        .transfer-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-primary {
            flex: 1;
            padding: 0.875rem 1.5rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary:hover:not(:disabled) {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-outline {
            flex: 1;
            padding: 0.875rem 1.5rem;
            background: transparent;
            color: var(--dark);
            border: 1px solid var(--border);
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Recent Transfers */
        .recent-transfers-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-header h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark);
            margin: 0;
        }

        .view-all-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .transfers-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .transfer-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            border-radius: 10px;
            background: var(--light);
            transition: all 0.2s ease;
        }

        .transfer-item:hover {
            background: #f0f4f8;
        }

        .transfer-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .transfer-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: rgba(42, 91, 215, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .transfer-details h5 {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark);
        }

        .transfer-details p {
            margin: 0.25rem 0 0;
            font-size: 0.85rem;
            color: var(--secondary);
        }

        .transfer-amount {
            font-weight: 600;
            font-size: 1rem;
        }

        .transfer-amount.positive {
            color: var(--success);
        }

        .transfer-amount.negative {
            color: var(--danger);
        }

        /* Transfer Limits */
        .transfer-limits {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: 2rem;
            box-shadow: var(--card-shadow);
        }

        .limits-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .limits-header i {
            color: var(--warning);
            font-size: 1.2rem;
        }

        .limits-header h4 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark);
        }

        .limits-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .limit-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
        }

        .limit-label {
            font-size: 0.9rem;
            color: var(--secondary);
        }

        .limit-value {
            font-weight: 600;
            color: var(--dark);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--border);
            margin-bottom: 1rem;
        }

        .empty-state h4 {
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-weight: 600;
        }

        .empty-state p {
            color: var(--secondary);
            max-width: 400px;
            margin: 0 auto 1.5rem;
        }

        /* Mobile Bottom Navigation */
        .mobile-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-around;
            padding: 0.5rem 0;
            z-index: 1000;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        }

        @media (min-width: 992px) {
            .mobile-nav {
                display: none;
            }
        }

        .mobile-nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.5rem;
            text-decoration: none;
            color: var(--secondary);
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .mobile-nav-item:hover {
            color: var(--primary);
        }

        .mobile-nav-item.active {
            color: var(--primary);
            background: rgba(42, 91, 215, 0.05);
        }

        .mobile-nav-item i {
            font-size: 1.1rem;
            margin-bottom: 4px;
        }

        .mobile-nav-item span {
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* Add padding for mobile nav */
        @media (max-width: 991px) {
            .main-content {
                padding-bottom: 70px;
            }
        }

        /* Overlay for sidebar on mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.3);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }
    </style>
</head>
<body>
@include('user.header')




  <!-- Main Content -->
        <main class="main-content">
            <div class="transfer-container">
                <!-- Page Header -->
                <div class="page-header fade-in">
                    <h1>International Transfer </h1>
                    <p>Send money to accounts, beneficiaries, or other banks</p>
                </div>


                <!-- Transfer Steps -->
                <div class="transfer-steps fade-in">
                    <div class="step active" id="step1">
                        <div class="step-circle">
                            <span class="step-number"></span>
                            <i class="bi bi-check"></i>
                        </div>
                        <div class="step-label">Details</div>
                    </div>
                    {{-- <div class="step" id="step2">
                        <div class="step-circle">
                            <span class="step-number">2</span>
                            <i class="bi bi-check"></i>
                        </div>
                        <div class="step-label">Review</div>
                    </div>
                    <div class="step" id="step3">
                        <div class="step-circle">
                            <span class="step-number">3</span>
                            <i class="bi bi-check"></i>
                        </div>
                        <div class="step-label">Confirm</div>
                    </div> --}}
                </div>

                <!-- Transfer Form -->
                <div class="transfer-form-card fade-in">
                    <div class="form-header">
                        <h3>Transfer Details</h3>
                        <p>Enter the details for your transfer</p>
                    </div>

                   <form  method="POST" action="#">
    <!-- Account Name -->
    <div class="form-group">
        <label class="form-label" for="accountName">Account Name</label>
        <input
            type="text"
            class="form-control"
            id="accountName"
            name="account_name"
            placeholder="Enter account holder name"
            required
        >
    </div>

    <!-- Account Number -->
    <div class="form-group">
        <label class="form-label" for="accountNumber">Account Number</label>
        <input
            type="text"
            class="form-control"
            id="accountNumber"
            name="account_number"
            placeholder="Enter account number"
            required
        >
    </div>

    <!-- Bank Name -->
    <div class="form-group">
        <label class="form-label" for="bankName">Bank Name</label>
        <input
            type="text"
            class="form-control"
            id="bankName"
            name="bank_name"
            placeholder="Enter bank name"
            required
        >
    </div>

    <!-- Bank Country -->
    <div class="form-group">
        <label class="form-label" for="bankCountry">Bank Country</label>
        <input
            type="text"
            class="form-control"
            id="bankCountry"
            name="bank_country"
            placeholder="Enter bank country"
            required
        >
    </div>

    <!-- Bank Address -->
    <div class="form-group">
        <label class="form-label" for="bankAddress">Bank Address</label>
        <input
            type="text"
            class="form-control"
            id="bankAddress"
            name="bank_address"
            placeholder="Enter bank address"
            required
        >
    </div>

    <!-- Amount -->
    <div class="form-group">
        <label class="form-label" for="amount">Amount</label>
        <div class="amount-input">
            <span class="currency-symbol">$</span>
            <input
                type="number"
                class="form-control"
                id="amount"
                name="amount"
                placeholder="0.00"
                min="1"
                step="0.01"
                required
            >
        </div>
    </div>


     <!-- Swift Code -->
    <div class="form-group">
        <label class="form-label" for="amount">Swift Code</label>
        <div class="amount-input">
        
            <input
                type="text"
                class="form-control"
                id="amount"
                name="swift_code"
                placeholder="Enter Swift Code"
        
                required
            >
        </div>
    </div>

    <!-- Description -->
    <div class="form-group">
        <label class="form-label" for="description">Description</label>
        <input
            type="text"
            class="form-control"
            id="description"
            name="description"
            placeholder="Optional description"
            maxlength="100"
        >
    </div>

    <!-- Actions -->
    <div class="transfer-actions">
        <button type="button" class="btn-outline" id="cancelBtn">
            Cancel
        </button>
        <button type="submit" class="btn-primary">
            Continue
        </button>
    </div>
</form>

                </div>

                {{-- <!-- Recent Transfers -->
                <div class="recent-transfers-card fade-in">
                    <div class="section-header">
                        <h3>Recent Transfers</h3>
                        <a href="transfer-history.html" class="view-all-link">View All</a>
                    </div>

                    <div class="transfers-list" id="transfersList">
                        <!-- Recent transfers will be loaded here -->
                    </div>

                    <!-- Empty State -->
                    <div class="empty-state" id="emptyState" style="display: none;">
                        <i class="bi bi-arrow-left-right"></i>
                        <h4>No Recent Transfers</h4>
                        <p>Your recent transfers will appear here once you make your first transfer.</p>
                    </div>
                </div>

                <!-- Transfer Limits -->
                <div class="transfer-limits fade-in">
                    <div class="limits-header">
                        <i class="bi bi-exclamation-circle"></i>
                        <h4>Transfer Limits</h4>
                    </div>
                    <div class="limits-list">
                        <div class="limit-item">
                            <span class="limit-label">Daily Limit</span>
                            <span class="limit-value">$25,000</span>
                        </div>
                        <div class="limit-item">
                            <span class="limit-label">Monthly Limit</span>
                            <span class="limit-value">$100,000</span>
                        </div>
                        <div class="limit-item">
                            <span class="limit-label">Per Transaction</span>
                            <span class="limit-value">$10,000</span>
                        </div>
                    </div> --}}
                </div>
            </div>
        </main>




 @include('user.bottom-navbar')
    <!-- Transfer Page JavaScript -->
    <script>
        // Sample recent transfers data
        const recentTransfers = [
            {
                id: 1,
                name: 'John Smith',
                type: 'sent',
                amount: -500.00,
                date: 'Today • 10:30 AM',
                status: 'completed'
            },
            {
                id: 2,
                name: 'Emily Johnson',
                type: 'sent',
                amount: -250.00,
                date: 'Yesterday • 3:45 PM',
                status: 'completed'
            },
            {
                id: 3,
                name: 'Salary Deposit',
                type: 'received',
                amount: 3500.00,
                date: 'Dec 15 • 9:00 AM',
                status: 'completed'
            },
            {
                id: 4,
                name: 'ACME Corporation',
                type: 'sent',
                amount: -1200.00,
                date: 'Dec 14 • 2:15 PM',
                status: 'pending'
            }
        ];

        // Initialize transfer page
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize sidebar toggle
            initSidebarToggle();
            
            // Initialize dropdown
            initDropdown();
            
            // Initialize mobile navigation
            initMobileNavigation();
            
            // Load recent transfers
            loadRecentTransfers();
            
            // Initialize form
            initTransferForm();
            
            // Initialize other interactive elements
            initInteractiveElements();
        });

        // Sidebar toggle functionality
        function initSidebarToggle() {
            const navToggle = document.getElementById('navToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (navToggle && sidebar && overlay) {
                navToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                    document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
                    
                    // Change icon
                    const icon = navToggle.querySelector('i');
                    icon.className = sidebar.classList.contains('active') ? 'bi bi-x-lg' : 'bi bi-list';
                });
                
                // Close sidebar when overlay is clicked
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                    navToggle.querySelector('i').className = 'bi bi-list';
                });
                
                // Close sidebar when clicking a nav item on mobile
                document.querySelectorAll('.nav-item').forEach(item => {
                    item.addEventListener('click', function() {
                        if (window.innerWidth < 992) {
                            sidebar.classList.remove('active');
                            overlay.classList.remove('active');
                            document.body.style.overflow = '';
                            navToggle.querySelector('i').className = 'bi bi-list';
                        }
                    });
                });
                
                // Handle window resize
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 992) {
                        sidebar.classList.add('active');
                        overlay.classList.remove('active');
                        document.body.style.overflow = '';
                        if (navToggle.querySelector('i')) {
                            navToggle.querySelector('i').className = 'bi bi-list';
                        }
                    }
                });
                
                // Initialize sidebar state
                if (window.innerWidth >= 992) {
                    sidebar.classList.add('active');
                }
            }
        }

        // User dropdown functionality
        function initDropdown() {
            const dropdownBtn = document.getElementById('userDropdownBtn');
            const dropdownMenu = document.getElementById('dropdownMenu');
            
            if (dropdownBtn && dropdownMenu) {
                // Toggle dropdown on click
                dropdownBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownMenu.classList.toggle('show');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.classList.remove('show');
                    }
                });
                
                // Handle logout
                const logoutLink = document.getElementById('logoutLink');
                if (logoutLink) {
                    logoutLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (confirm('Are you sure you want to logout?')) {
                            showNotification('Logged out successfully');
                            // In real app, redirect to login page
                            // window.location.href = '/login';
                        }
                    });
                }
            }
        }

        // Mobile navigation functionality
        function initMobileNavigation() {
            const mobileNavItems = document.querySelectorAll('.mobile-nav-item');
            
            mobileNavItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    if (this.id === 'mobileLogout') {
                        e.preventDefault();
                        if (confirm('Are you sure you want to logout?')) {
                            showNotification('Logged out successfully');
                        }
                        return;
                    }
                    
                    // Remove active class from all items
                    mobileNavItems.forEach(i => i.classList.remove('active'));
                    
                    // Add active class to clicked item
                    this.classList.add('active');
                });
            });
        }

        // Load recent transfers
        function loadRecentTransfers() {
            const transfersList = document.getElementById('transfersList');
            const emptyState = document.getElementById('emptyState');
            
            if (!transfersList) return;
            
            // Clear existing content
            transfersList.innerHTML = '';
            
            if (recentTransfers.length === 0) {
                emptyState.style.display = 'block';
                return;
            }
            
            emptyState.style.display = 'none';
            
            // Display each transfer
            recentTransfers.forEach(transfer => {
                const isReceived = transfer.type === 'received';
                const isPending = transfer.status === 'pending';
                
                const transferItem = document.createElement('div');
                transferItem.className = 'transfer-item';
                
                transferItem.innerHTML = `
                    <div class="transfer-info">
                        <div class="transfer-icon">
                            <i class="bi bi-${isReceived ? 'arrow-down-left' : 'arrow-up-right'}"></i>
                        </div>
                        <div class="transfer-details">
                            <h5>${transfer.name}</h5>
                            <p>${transfer.date} ${isPending ? '• <span style="color: var(--warning)">Pending</span>' : ''}</p>
                        </div>
                    </div>
                    <div class="transfer-amount ${isReceived ? 'positive' : 'negative'}">
                        ${isReceived ? '+' : '-'}$${Math.abs(transfer.amount).toFixed(2)}
                    </div>
                `;
                
                transfersList.appendChild(transferItem);
            });
        }

        // Initialize transfer form
        function initTransferForm() {
            const form = document.getElementById('transferForm');
            const fromAccount = document.getElementById('fromAccount');
            const toAccount = document.getElementById('toAccount');
            const amountInput = document.getElementById('amount');
            const continueBtn = document.getElementById('continueBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Validate form
                    if (!validateForm()) {
                        return;
                    }
                    
                    // Show loading state
                    const originalText = continueBtn.innerHTML;
                    continueBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';
                    continueBtn.disabled = true;
                    
                    // Simulate API call
                    setTimeout(() => {
                        // Show success notification
                        showNotification('Transfer initiated successfully!', 'success');
                        
                        // Update steps
                        updateSteps(2);
                        
                        // Reset button
                        continueBtn.innerHTML = originalText;
                        continueBtn.disabled = false;
                        
                        // In a real app, you would navigate to review page
                        // window.location.href = '/transfer/review';
                    }, 1500);
                });
            }
            
            // Handle cancel button
            if (cancelBtn) {
                cancelBtn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to cancel this transfer?')) {
                        form.reset();
                        showNotification('Transfer cancelled', 'info');
                    }
                });
            }
            
            // Handle amount validation
            if (amountInput) {
                amountInput.addEventListener('input', function() {
                    const maxAmount = 10000;
                    const value = parseFloat(this.value) || 0;
                    
                    if (value > maxAmount) {
                        this.value = maxAmount;
                        showNotification(`Maximum transfer amount is $${maxAmount}`, 'warning');
                    }
                    
                    // Update continue button state
                    updateContinueButton();
                });
            }
            
            // Handle from account change
            if (fromAccount) {
                fromAccount.addEventListener('change', updateContinueButton);
            }
            
            // Handle to account change
            if (toAccount) {
                toAccount.addEventListener('change', function() {
                    if (this.value === 'new') {
                        showNotification('Add beneficiary feature would open here', 'info');
                        this.value = '';
                    }
                    updateContinueButton();
                });
            }
        }

        // Validate form
        function validateForm() {
            const fromAccount = document.getElementById('fromAccount');
            const toAccount = document.getElementById('toAccount');
            const amountInput = document.getElementById('amount');
            
            if (!fromAccount.value) {
                showNotification('Please select a source account', 'warning');
                fromAccount.focus();
                return false;
            }
            
            if (!toAccount.value) {
                showNotification('Please select a recipient', 'warning');
                toAccount.focus();
                return false;
            }
            
            if (!amountInput.value || parseFloat(amountInput.value) <= 0) {
                showNotification('Please enter a valid amount', 'warning');
                amountInput.focus();
                return false;
            }
            
            if (fromAccount.value === toAccount.value) {
                showNotification('Cannot transfer to the same account', 'warning');
                return false;
            }
            
            return true;
        }

        // Update continue button state
        function updateContinueButton() {
            const continueBtn = document.getElementById('continueBtn');
            const fromAccount = document.getElementById('fromAccount');
            const toAccount = document.getElementById('toAccount');
            const amountInput = document.getElementById('amount');
            
            if (!continueBtn) return;
            
            const isValid = fromAccount.value && 
                           toAccount.value && 
                           toAccount.value !== 'new' && 
                           amountInput.value && 
                           parseFloat(amountInput.value) > 0;
            
            continueBtn.disabled = !isValid;
        }

        // Update steps
        function updateSteps(stepNumber) {
            // Reset all steps
            document.querySelectorAll('.step').forEach(step => {
                step.classList.remove('active', 'completed');
            });
            
            // Mark previous steps as completed and current as active
            for (let i = 1; i <= 3; i++) {
                const step = document.getElementById(`step${i}`);
                if (i < stepNumber) {
                    step.classList.add('completed');
                } else if (i === stepNumber) {
                    step.classList.add('active');
                }
            }
        }

        // Initialize other interactive elements
        function initInteractiveElements() {
            // Sidebar buttons
            const sidebarButtons = {
                newAccountBtn: 'New Account',
                helpCenterBtn: 'Help Center'
            };
            
            Object.keys(sidebarButtons).forEach(btnId => {
                const btn = document.getElementById(btnId);
                if (btn) {
                    btn.addEventListener('click', function() {
                        const action = sidebarButtons[btnId];
                        showNotification(`${action} feature would open here`, 'info');
                    });
                }
            });
            
            // Notification bell
            const notificationBtn = document.getElementById('notificationBtn');
            if (notificationBtn) {
                notificationBtn.addEventListener('click', function() {
                    const badge = this.querySelector('.notification-badge');
                    if (badge && badge.textContent !== '0') {
                        badge.textContent = '0';
                        badge.style.opacity = '0.5';
                        showNotification('Notifications cleared', 'success');
                    }
                });
            }
            
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                let searchTimer;
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimer);
                    searchTimer = setTimeout(() => {
                        if (this.value.trim().length > 0) {
                            showNotification(`Searching for "${this.value}"...`, 'info');
                        }
                    }, 500);
                });
            }
        }

        // Show notification
        function showNotification(message, type = 'success') {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = 'position-fixed bottom-4 end-4 p-3 rounded shadow-lg';
            toast.style.zIndex = '9999';
            toast.style.maxWidth = '300px';
            toast.style.fontSize = '0.9rem';
            toast.style.animation = 'fadeIn 0.3s ease-out';
            
            // Set colors based on type
            if (type === 'success') {
                toast.style.background = '#10b981';
                toast.style.color = 'white';
                toast.style.border = '1px solid #059669';
            } else if (type === 'warning') {
                toast.style.background = '#f59e0b';
                toast.style.color = '#78350f';
                toast.style.border = '1px solid #d97706';
            } else if (type === 'info') {
                toast.style.background = '#3b82f6';
                toast.style.color = 'white';
                toast.style.border = '1px solid #1d4ed8';
            } else {
                toast.style.background = '#1e293b';
                toast.style.color = 'white';
                toast.style.border = '1px solid #334155';
            }
            
            const icon = type === 'success' ? 'check-circle' : 
                        type === 'warning' ? 'exclamation-triangle' : 
                        type === 'info' ? 'info-circle' : 'bell';
            
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="bi bi-${icon} me-2"></i>
                    <div class="flex-grow-1">${message}</div>
                    <button class="btn-close ${type === 'warning' ? '' : 'btn-close-white'} ms-2" 
                            onclick="this.parentElement.parentElement.remove()"></button>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.remove();
                }
            }, 3000);
        }

        // Make functions globally available
        window.showNotification = showNotification;
    </script>
</body>
</html>

 @include('user.footer')