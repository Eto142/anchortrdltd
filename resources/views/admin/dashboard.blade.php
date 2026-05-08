@include('admin.header')

<!-- Main Content -->
<div class="main-content" id="mainContent">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Admin Dashboard</h1>
        <div class="text-muted small">Last updated: {{ now()->format('M j, Y g:i A') }}</div>
    </div>

    <!-- Alert Messages -->
    @if(session('status') || session('message'))
        <div class="alert-container">
            <div class="alert alert-{{ session('status') ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
                <div class="alert-content d-flex align-items-center">
                    <div class="alert-icon me-2">
                        @if(session('status'))
                            <!-- Success Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        @else
                            <!-- Error Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                        @endif
                    </div>
                    <div class="alert-text flex-grow-1">
                        {{ session('status') ?? session('message') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="alert-progress"></div>
            </div>
        </div>
    @endif

    <!-- Dashboard Statistics -->
    <div class="dashboard-container">
        <div class="row g-3 mb-4">
            <!-- Total Users -->
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card bg-primary bg-opacity-10 border-primary h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="value fs-3 fw-bold">{{ number_format($totalUsersCount) }}</div>
                                <div class="label text-muted">Total Users</div>
                            </div>
                            <div class="bg-primary bg-opacity-25 p-3 rounded">
                                <i class="fas fa-users text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            <span class="text-success fw-semibold">
                                <i class="fas fa-arrow-up"></i> {{ number_format($newUsersCount) }} new
                            </span>
                            <span class="text-muted">this week</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Deposits -->
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card bg-success bg-opacity-10 border-success h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="value fs-3 fw-bold">${{ number_format($totalDepositsAmount, 2) }}</div>
                                <div class="label text-muted">Total Deposits</div>
                            </div>
                            <div class="bg-success bg-opacity-25 p-3 rounded">
                                <i class="fas fa-arrow-down text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            <span class="text-warning fw-semibold">
                                <i class="fas fa-clock"></i> {{ number_format($pendingDepositsCount) }} pending
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Profits -->
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card bg-warning bg-opacity-10 border-warning h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="value fs-3 fw-bold">${{ number_format($totalProfitsAmount, 2) }}</div>
                                <div class="label text-muted">Total Profits</div>
                            </div>
                            <div class="bg-warning bg-opacity-25 p-3 rounded">
                                <i class="fas fa-chart-line text-warning fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            <span class="text-muted fw-semibold">
                                <i class="fas fa-list"></i> {{ number_format($totalProfitsCount) }} entries
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Withdrawals -->
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card bg-danger bg-opacity-10 border-danger h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="value fs-3 fw-bold">${{ number_format($totalWithdrawalsAmount, 2) }}</div>
                                <div class="label text-muted">Total Withdrawals</div>
                            </div>
                            <div class="bg-danger bg-opacity-25 p-3 rounded">
                                <i class="fas fa-arrow-up text-danger fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            <span class="text-warning fw-semibold">
                                <i class="fas fa-clock"></i> {{ number_format($pendingWithdrawalsCount) }} pending
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add more stat cards here if needed -->
        </div>

        <!-- Recent Users Table -->
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Users</h5>
                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Joined</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers as $user)
                                <tr>
                                    <td>#{{ $user->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-placeholder bg-primary text-white rounded-circle me-2 d-flex justify-content-center align-items-center" style="width: 32px; height: 32px;">
                                                {{ substr($user->first_name, 0, 1) }}
                                            </div>
                                            <div class="fw-semibold">{{ $user->first_name }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('M j, Y') }}</td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.profile', $user->id) }}" class="btn btn-outline-primary" title="View" data-bs-toggle="tooltip">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="mailto:{{ $user->email }}" class="btn btn-outline-success" title="Send Email" data-bs-toggle="tooltip">
                                                <i class="fas fa-envelope"></i>
                                            </a>
                                            <form action="{{ route('admin.delete', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger" title="Delete" data-bs-toggle="tooltip">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No users registered yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')
