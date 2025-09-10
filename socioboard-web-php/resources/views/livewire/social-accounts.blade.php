<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Connected Accounts -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Connected Accounts</h6>
                    <span class="badge bg-primary">{{ count($accounts) }} Connected</span>
                </div>
                <div class="card-body">
                    @forelse($accounts as $account)
                        <div class="row align-items-center p-3 mb-3 bg-light rounded">
                            <div class="col-md-1">
                                <div class="social-icon {{ $account['color'] }}">
                                    <i class="{{ $account['icon'] }}"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="mb-1">{{ $account['platform'] }}</h6>
                                <p class="mb-0 text-muted">{{ $account['name'] }}</p>
                                <small class="text-muted">{{ $account['username'] }}</small>
                            </div>
                            <div class="col-md-2">
                                <div class="text-center">
                                    <strong>{{ number_format($account['followers']) }}</strong>
                                    <br><small class="text-muted">Followers</small>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <span class="badge {{ $account['status'] === 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($account['status']) }}
                                </span>
                                <br><small class="text-muted">Connected: {{ $account['connected_at'] }}</small>
                            </div>
                            <div class="col-md-3 text-end">
                                @if($account['status'] === 'error')
                                    <button wire:click="refreshAccount({{ $account['id'] }})" class="btn btn-sm btn-warning me-2">
                                        <i class="fas fa-sync-alt"></i> Refresh
                                    </button>
                                @endif
                                <button wire:click="disconnectAccount({{ $account['id'] }})" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-unlink"></i> Disconnect
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No accounts connected yet</h5>
                            <p class="text-muted">Connect your social media accounts to start managing your content.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Available Platforms -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Available Platforms</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($availablePlatforms as $platform)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <div class="social-icon {{ $platform['color'] }} mx-auto mb-3">
                                            <i class="{{ $platform['icon'] }} fa-2x"></i>
                                        </div>
                                        <h5 class="card-title">{{ $platform['name'] }}</h5>
                                        <p class="card-text text-muted">{{ $platform['description'] }}</p>
                                        <button wire:click="connectAccount('{{ $platform['name'] }}')" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Connect
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Connect Account Modal -->
    @if($showConnectModal)
        <div class="modal fade show" style="display: block;" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Connect {{ $selectedPlatform }}</h5>
                        <button type="button" class="btn-close" wire:click="$set('showConnectModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="fas fa-info-circle fa-3x text-info mb-3"></i>
                            <h6>Connect your {{ $selectedPlatform }} account</h6>
                            <p class="text-muted">You will be redirected to {{ $selectedPlatform }} to authorize the connection.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showConnectModal', false)">Cancel</button>
                        <button type="button" class="btn btn-primary" wire:click="confirmConnect">
                            <i class="fas fa-external-link-alt"></i> Connect to {{ $selectedPlatform }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
