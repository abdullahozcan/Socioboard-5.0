<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Add New Feed -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add New RSS Feed</h6>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="addFeed" class="row">
                        <div class="col-md-8">
                            <input wire:model="newFeedUrl" type="url" class="form-control" 
                                   placeholder="Enter RSS feed URL (e.g., https://example.com/feed)">
                            @error('newFeedUrl') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                ➕ Add Feed
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Feeds List -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">RSS Feeds</h6>
                    <span class="badge bg-primary">{{ count($feeds) }} Feeds</span>
                </div>
                <div class="card-body">
                    @forelse($feeds as $feed)
                        <div class="row align-items-center p-3 mb-3 bg-light rounded">
                            <div class="col-md-1">
                                📡
                            </div>
                            <div class="col-md-4">
                                <h6 class="mb-1">{{ $feed['title'] }}</h6>
                                <small class="text-muted">{{ $feed['url'] }}</small>
                                <br>
                                <span class="badge bg-secondary">{{ ucfirst($feed['category']) }}</span>
                            </div>
                            <div class="col-md-2">
                                <div class="text-center">
                                    <strong>{{ $feed['post_count'] }}</strong>
                                    <br><small class="text-muted">Posts</small>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <span class="badge {{ $feed['status'] === 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($feed['status']) }}
                                </span>
                                <br><small class="text-muted">{{ \Carbon\Carbon::parse($feed['last_updated'])->diffForHumans() }}</small>
                            </div>
                            <div class="col-md-3 text-end">
                                @if($feed['status'] === 'error')
                                    <button wire:click="refreshFeed({{ $feed['id'] }})" class="btn btn-sm btn-warning me-2">
                                        🔄 Refresh
                                    </button>
                                @endif
                                <button wire:click="deleteFeed({{ $feed['id'] }})" class="btn btn-sm btn-outline-danger">
                                    🗑️ Delete
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            📡📡📡
                            <h5 class="text-muted">No RSS feeds added yet</h5>
                            <p class="text-muted">Add RSS feeds to start curating content for your social media.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Feed Categories Info -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Feed Categories</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-2">
                            <div class="p-3">
                                💻
                                <h6>Tech</h6>
                                <small class="text-muted">Technology news</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="p-3">
                                📢
                                <h6>Marketing</h6>
                                <small class="text-muted">Marketing insights</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="p-3">
                                💼
                                <h6>Business</h6>
                                <small class="text-muted">Business news</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="p-3">
                                🔗
                                <h6>Social</h6>
                                <small class="text-muted">Social media</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="p-3">
                                📋
                                <h6>All</h6>
                                <small class="text-muted">All categories</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
