<div>
    <!-- Analytics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Posts</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $analytics['total_posts'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-edit fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Engagement</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($analytics['total_engagement']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Followers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($analytics['total_followers']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Reach</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($analytics['reach']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-eye fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Connected Accounts and Recent Activity -->
    <div class="row">
        <!-- Connected Social Accounts -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Connected Social Accounts</h6>
                    <button wire:click="refreshData" class="btn btn-sm btn-primary">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                </div>
                <div class="card-body">
                    @forelse($connectedAccounts as $account)
                        <div class="d-flex align-items-center mb-3">
                            <div class="social-icon {{ $account['color'] }}">
                                <i class="{{ $account['icon'] }}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ $account['platform'] }}</h6>
                                <small class="text-muted">{{ $account['name'] }}</small>
                            </div>
                            <div class="text-end">
                                <div class="font-weight-bold">{{ number_format($account['followers']) }}</div>
                                <small class="text-muted">followers</small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-plus-circle fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No social accounts connected yet.</p>
                            <a href="{{ route('livewire.social-accounts') }}" class="btn btn-primary">Connect Account</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Posts -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Posts</h6>
                </div>
                <div class="card-body">
                    @forelse($recentPosts as $post)
                        <div class="d-flex align-items-start mb-3 p-3 bg-light rounded">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary">{{ $post['platform'] }}</span>
                                    <small class="text-muted">{{ $post['time'] }}</small>
                                </div>
                                <p class="mb-2">{{ $post['content'] }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        <i class="fas fa-heart"></i> {{ $post['engagement'] }} engagements
                                    </span>
                                    <span class="badge {{ $post['status'] === 'published' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($post['status']) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-edit fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No recent posts found.</p>
                            <a href="{{ route('livewire.content-studio') }}" class="btn btn-primary">Create Post</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('livewire.content-studio') }}" class="btn btn-outline-primary btn-lg w-100">
                                <i class="fas fa-edit fa-2x mb-2"></i><br>
                                Create Post
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('livewire.social-accounts') }}" class="btn btn-outline-success btn-lg w-100">
                                <i class="fas fa-plus fa-2x mb-2"></i><br>
                                Add Account
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('livewire.feeds') }}" class="btn btn-outline-info btn-lg w-100">
                                <i class="fas fa-rss fa-2x mb-2"></i><br>
                                Manage Feeds
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('livewire.reports') }}" class="btn btn-outline-warning btn-lg w-100">
                                <i class="fas fa-chart-bar fa-2x mb-2"></i><br>
                                View Reports
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    Livewire.on('dataRefreshed', () => {
        // Show success message or handle refresh completion
        console.log('Dashboard data refreshed successfully');
    });
</script>
@endpush
