@include('admin.header')

<!-- Main Content -->
<div class="main-content" id="mainContent">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
        <div class="mb-3 mb-md-0">
            <h1 class="h3 mb-1">User Profile</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                </ol>
            </nav>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateBalanceModal">
                <i class="fas fa-file-invoice-dollar me-1"></i> Update Balance
            </button>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDepositModal">
                <i class="fas fa-plus-circle me-1"></i> Add Deposit
            </button>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addProfitModal">
                <i class="fas fa-chart-line me-1"></i> Add Profit
            </button>
        </div>
    </div>

    <!-- Flash Alert -->
    <div class="alert-container">
        @if(session('success') || session('error'))
            <div class="alert alert-dismissible fade show custom-alert
                {{ session('success') ? 'alert-success' : 'alert-danger' }}"
                role="alert" id="flashAlert">
                @if(session('success'))
                    <strong>✅ Success!</strong> {{ session('success') }}
                @else
                    <strong>❌ Error!</strong> {{ session('error') }}
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                setTimeout(function () {
                    let alertEl = document.getElementById('flashAlert');
                    if (alertEl) {
                        alertEl.classList.add('fade-out');
                        setTimeout(() => { new bootstrap.Alert(alertEl).close(); }, 600);
                    }
                }, 3500);
            </script>
        @endif
    </div>

    <!-- Two-column layout -->
    <div class="row">

        <!-- Left Column: Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">

                    <!-- Avatar -->
                    <div class="position-relative mb-3 mx-auto" style="width:150px;height:150px;">
                        <div class="rounded-circle shadow w-100 h-100 d-flex align-items-center justify-content-center bg-primary text-white fw-bold fs-4">
                            {{ strtoupper(substr($userProfile->name, 0, 2)) }}
                        </div>
                        <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-3 border-white">
                            <i class="fas fa-check text-white"></i>
                        </span>
                    </div>

                    <h3 class="mb-1">{{ $userProfile->name }}</h3>
                    <p class="text-muted mb-3">{{ $userProfile->email }}</p>

                    <!-- Contact Buttons -->
                    <div class="d-flex justify-content-center flex-wrap gap-2 mb-3">
                        <a href="mailto:{{ $userProfile->email }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-envelope me-1"></i> Email
                        </a>
                        <a href="tel:+{{ $userProfile->phone }}" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-phone me-1"></i> Call
                        </a>
                    </div>

                    <hr>

                    <!-- Stats Cards -->
                    <div class="row g-2">
                        <div class="col-12">
                            <div class="card bg-success bg-opacity-10 border-success">
                                <div class="card-body p-2 text-center">
                                    <h6 class="card-title text-success mb-1">Balance</h6>
                                    <p class="card-text fw-bold fs-5 mb-0">${{ number_format($balance_amount, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card bg-primary bg-opacity-10 border-primary">
                                <div class="card-body p-2 text-center">
                                    <h6 class="card-title text-primary mb-1">Total Deposits</h6>
                                    <p class="card-text fw-bold fs-5 mb-0">${{ number_format($total_deposits, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card bg-warning bg-opacity-10 border-warning">
                                <div class="card-body p-2 text-center">
                                    <h6 class="card-title text-warning mb-1">Total Profits</h6>
                                    <p class="card-text fw-bold fs-5 mb-0">${{ number_format($total_profits, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card bg-danger bg-opacity-10 border-danger">
                                <div class="card-body p-2 text-center">
                                    <h6 class="card-title text-danger mb-1">Total Withdrawals</h6>
                                    <p class="card-text fw-bold fs-5 mb-0">${{ number_format($total_withdrawals, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Stats Cards -->

                </div>
            </div>
        </div>
        <!-- /Left Column -->

        <!-- Right Column -->
        <div class="col-lg-8">

            <!-- Personal Information Card -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>Personal Information</h5>
                    <span class="badge bg-success">Verified</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Full Name</label>
                            <div class="fw-semibold">{{ $userProfile->name }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Email Address</label>
                            <div class="fw-semibold d-flex align-items-center">
                                {{ $userProfile->email }}
                                <span class="badge bg-success ms-2">Verified</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Phone Number</label>
                            <div class="fw-semibold">{{ $userProfile->phone }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Date of Birth</label>
                            <div class="fw-semibold">{{ $userProfile->dob }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Address</label>
                            <div class="fw-semibold">{{ $userProfile->address }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Tabs Card -->
            <div class="card">
                <div class="card-header bg-white p-0">
                    <ul class="nav nav-tabs card-header-tabs flex-nowrap overflow-auto" id="activityTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active px-4 py-3 fw-bold" data-bs-toggle="tab" data-bs-target="#deposits" type="button" role="tab">
                                <i class="fas fa-arrow-down me-2"></i> Deposits
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 py-3 fw-bold" data-bs-toggle="tab" data-bs-target="#profits" type="button" role="tab">
                                <i class="fas fa-chart-line me-2"></i> Profits
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 py-3 fw-bold" data-bs-toggle="tab" data-bs-target="#withdrawals" type="button" role="tab">
                                <i class="fas fa-money-bill-wave me-2"></i> Withdrawals
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-0">
                    <div class="tab-content p-3" id="activityTabsContent">

                        <!-- Deposits Tab -->
                        <div class="tab-pane fade show active" id="deposits" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($deposits as $deposit)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($deposit->created_at)->format('M d, Y') }}</td>
                                                <td>${{ number_format($deposit->amount, 2) }}</td>
                                                <td>{{ $deposit->method ?? '—' }}</td>
                                                <td>
                                                    @if($deposit->status == 1)
                                                        <span class="badge bg-success">Approved</span>
                                                    @elseif($deposit->status == 2)
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($deposit->status != 1)
                                                    <form action="{{ route('admin.deposit.approve', $deposit->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                    </form>
                                                    @endif
                                                    @if($deposit->status != 2)
                                                    <form action="{{ route('admin.deposit.decline', $deposit->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger">Decline</button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-3">No deposits found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Profits Tab -->
                        <div class="tab-pane fade" id="profits" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Source</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($profits as $profit)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($profit->created_at)->format('M d, Y') }}</td>
                                                <td>${{ number_format($profit->amount, 2) }}</td>
                                                <td>{{ $profit->source ?? '—' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">No profits found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Withdrawals Tab -->
                        <div class="tab-pane fade" id="withdrawals" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($withdrawals as $withdrawal)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($withdrawal->created_at)->format('M d, Y') }}</td>
                                                <td>${{ number_format($withdrawal->amount, 2) }}</td>
                                                <td>{{ $withdrawal->method ?? '—' }}</td>
                                                <td>
                                                    @if($withdrawal->status == 1)
                                                        <span class="badge bg-success">Approved</span>
                                                    @elseif($withdrawal->status == 2)
                                                        <span class="badge bg-danger">Declined</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($withdrawal->status != 1)
                                                    <form action="{{ route('admin.withdrawal.approve', $withdrawal->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                    </form>
                                                    @endif
                                                    @if($withdrawal->status != 2)
                                                    <form action="{{ route('admin.withdrawal.decline', $withdrawal->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger">Decline</button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-3">No withdrawals found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /Activity Tabs Card -->

        </div>
        <!-- /Right Column -->

    </div>
    <!-- /Two-column layout -->

</div>
<!-- /Main Content -->

<!-- ==================== MODALS ==================== -->

<!-- Update Balance Modal -->
<div class="modal fade" id="updateBalanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-file-invoice-dollar me-2"></i>Update Balance</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.add.balance') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $userProfile->id }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Balance Amount ($)</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="amount" placeholder="Enter balance amount" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Balance</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Deposit Modal -->
<div class="modal fade" id="addDepositModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Add Deposit</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.deposit.add') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $userProfile->id }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Amount ($)</label>
                        <input type="number" step="0.01" min="0.01" class="form-control" name="amount" placeholder="Enter deposit amount" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Method</label>
                        <select class="form-select" name="method" required>
                            <option value="" disabled selected>Select method</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Crypto">Crypto</option>
                            <option value="Wire Transfer">Wire Transfer</option>
                            <option value="Cash">Cash</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Deposit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Profit Modal -->
<div class="modal fade" id="addProfitModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title"><i class="fas fa-chart-line me-2"></i>Add Profit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.profit.add') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $userProfile->id }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Amount ($)</label>
                        <input type="number" step="0.01" min="0.01" class="form-control" name="amount" placeholder="Enter profit amount" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Source <span class="text-muted fw-normal">(optional)</span></label>
                        <input type="text" class="form-control" name="source" placeholder="e.g. Investment Return, Bonus">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Add Profit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================== SCRIPTS & STYLES ==================== -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (el) { return new bootstrap.Tooltip(el); });
    });
</script>

<style>
    .alert-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        width: 100%;
        max-width: 400px;
        padding: 0 15px;
    }
    .custom-alert {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,.1);
        font-size: .95rem;
        font-weight: 500;
        padding: 12px 16px;
    }
    .custom-alert.fade-out {
        opacity: 0;
        transition: opacity .6s ease;
    }
    .nav-tabs .nav-link {
        border: none;
        border-bottom: 3px solid transparent;
        color: #6c757d;
    }
    .nav-tabs .nav-link.active {
        color: #4e73df;
        border-bottom-color: #4e73df;
        background: transparent;
    }
    .card-header {
        padding: 1rem 1.25rem;
    }
    .table-sm td, .table-sm th {
        padding: .75rem;
    }
</style>

@include('admin.footer')
