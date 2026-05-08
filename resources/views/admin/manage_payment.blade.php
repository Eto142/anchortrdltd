@include('admin.header')

<div class="main-content" id="mainContent">
    <!-- Streamlined Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 mb-1">Wallet Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Financial Settings</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Addresses</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Notifications Section -->
   @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <!-- Current Wallet Addresses Summary -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-eye me-2"></i>Current Wallet Addresses</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Method</th>
                        <th>Address</th>
                        <th>Destination Tag</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(['usdt' => 'USDT (TRC20)', 'btc' => 'Bitcoin (BTC)', 'eth' => 'Ethereum (ETH)', 'xrp' => 'Ripple (XRP)'] as $key => $label)
                    <tr>
                        <td><strong>{{ $label }}</strong></td>
                        <td>
                            @if($wallets->has($key))
                                <code class="text-break">{{ $wallets[$key]->address }}</code>
                            @else
                                <span class="text-muted fst-italic">Not set</span>
                            @endif
                        </td>
                        <td>
                            @if($wallets->has($key) && $wallets[$key]->destination_tag)
                                <code>{{ $wallets[$key]->destination_tag }}</code>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Wallet Update Card -->
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-wallet me-2"></i>Update Wallet Addresses</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.choose.wallet') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="walletSelect" class="form-label">Select Wallet Type</label>
                    <select class="form-select" name="method" id="walletSelect">
                        <option value="">-- Select Payment Method --</option>
                        <option value="usdt">USDT (TRC20)</option>
                        <option value="btc">Bitcoin (BTC)</option>
                        <option value="eth">Ethereum (ETH)</option>
                        <option value="xrp">Ripple (XRP)</option>
                    </select>
                </div>

                <!-- Dynamic Wallet Address Inputs -->
                <div id="walletInputs">
                    <div class="wallet-input d-none" data-wallet="usdt">
                        <label class="form-label">USDT Wallet Address</label>
                        <input type="text" name="usdt_address" class="form-control" placeholder="Enter TRC20 compatible address"
                               value="{{ $wallets->get('usdt')?->address ?? '' }}">
                        <small class="text-muted">Ensure this is a TRC20 compatible address</small>
                    </div>

                    <div class="wallet-input d-none" data-wallet="btc">
                        <label class="form-label">Bitcoin Wallet Address</label>
                        <input type="text" name="btc_address" class="form-control" placeholder="Enter your Bitcoin wallet address"
                               value="{{ $wallets->get('btc')?->address ?? '' }}">
                    </div>

                    <div class="wallet-input d-none" data-wallet="eth">
                        <label class="form-label">Ethereum Wallet Address</label>
                        <input type="text" name="eth_address" class="form-control" placeholder="Enter your Ethereum wallet address"
                               value="{{ $wallets->get('eth')?->address ?? '' }}">
                    </div>

                    <div class="wallet-input d-none" data-wallet="xrp">
                        <label class="form-label">XRP Wallet Address</label>
                        <input type="text" name="xrp_address" class="form-control" placeholder="Enter your XRP wallet address"
                               value="{{ $wallets->get('xrp')?->address ?? '' }}">
                        <label class="form-label mt-2">Destination Tag (Optional)</label>
                        <input type="text" name="xrp_destination_tag" class="form-control" placeholder="Enter destination tag if required"
                               value="{{ $wallets->get('xrp')?->destination_tag ?? '' }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('walletSelect').addEventListener('change', function() {
    const selected = this.value;
    document.querySelectorAll('.wallet-input').forEach(div => {
        div.classList.add('d-none');
        if (div.dataset.wallet === selected) {
            div.classList.remove('d-none');
        }
    });
});
</script>

@include('admin.footer')