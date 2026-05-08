@include('admin.header')
<div class="main-content" id="mainContent">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">All Transactions</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active">Transactions</li>
                </ol>
            </nav>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-exchange-alt me-2"></i>Transaction History</h5>
            <span class="badge bg-secondary">{{ $transactions->total() }} total</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Transaction ID</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th class="text-end">Credit</th>
                            <th class="text-end">Debit</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $txn)
                        <tr>
                            <td><code>{{ $txn->transaction_id }}</code></td>
                            <td>
                                @if($txn->user)
                                    <a href="{{ route('admin.profile', $txn->user_id) }}" class="text-decoration-none fw-semibold">
                                        {{ $txn->user->name }}
                                    </a>
                                    <div class="text-muted small">{{ $txn->user->email }}</div>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border text-capitalize">
                                    {{ str_replace('_', ' ', $txn->transaction_type ?? '—') }}
                                </span>
                            </td>
                            <td>{{ $txn->transaction ?? '—' }}</td>
                            <td class="text-end text-success fw-semibold">
                                @if($txn->credit && $txn->credit > 0)
                                    +${{ number_format($txn->credit, 2) }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="text-end text-danger fw-semibold">
                                @if($txn->debit && $txn->debit > 0)
                                    -${{ number_format($txn->debit, 2) }}
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                @if($txn->status == 1)
                                    <span class="badge bg-success">Approved</span>
                                @elseif($txn->status == 2)
                                    <span class="badge bg-danger">Declined</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td class="small text-muted">{{ $txn->created_at->format('M j, Y g:i A') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2 d-block opacity-50"></i>
                                No transactions found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($transactions->hasPages())
            <div class="card-footer d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <div class="text-muted small">
                    Showing <strong>{{ $transactions->firstItem() }}</strong> to
                    <strong>{{ $transactions->lastItem() }}</strong> of
                    <strong>{{ $transactions->total() }}</strong> entries
                </div>
                {{ $transactions->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>
    </div>
</div>

@include('admin.footer')