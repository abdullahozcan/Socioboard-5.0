<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Create Post Form -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create New Post</h6>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="createPost">
                        <div class="mb-3">
                            <label for="postContent" class="form-label">Post Content</label>
                            <textarea wire:model="postContent" class="form-control" id="postContent" rows="4" 
                                      placeholder="What would you like to share with your audience?"></textarea>
                            @error('postContent') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Select Platforms</label>
                                @error('selectedPlatforms') <div class="text-danger">{{ $message }}</div> @enderror
                                <div class="row">
                                    @foreach($availablePlatforms as $key => $platform)
                                        <div class="col-6 mb-2">
                                            <div class="form-check">
                                                <input wire:model="selectedPlatforms" class="form-check-input" 
                                                       type="checkbox" value="{{ $key }}" id="{{ $key }}">
                                                <label class="form-check-label" for="{{ $key }}">
                                                    <i class="{{ $platform['icon'] }} text-{{ $platform['color'] }}"></i>
                                                    {{ $platform['name'] }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="scheduleDateTime" class="form-label">Schedule Time</label>
                                <input wire:model="scheduleDateTime" type="datetime-local" class="form-control" id="scheduleDateTime">
                                <small class="text-muted">Leave empty to publish immediately</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="uploadedImage" class="form-label">Upload Image (Optional)</label>
                            <input wire:model="uploadedImage" type="file" class="form-control" id="uploadedImage" accept="image/*">
                            @if ($uploadedImage)
                                <div class="mt-2">
                                    <img src="{{ $uploadedImage->temporaryUrl() }}" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> 
                                {{ $scheduleDateTime > now() ? 'Schedule Post' : 'Publish Now' }}
                            </button>
                            <button type="button" class="btn btn-outline-secondary" wire:click="$refresh">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Posts List -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Your Posts</h6>
                    <span class="badge bg-primary">{{ count($posts) }} Posts</span>
                </div>
                <div class="card-body">
                    @forelse($posts as $post)
                        <div class="card mb-3 border-left-{{ $post['status'] === 'published' ? 'success' : ($post['status'] === 'scheduled' ? 'warning' : 'secondary') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="card-text">{{ $post['content'] }}</p>
                                        
                                        @if($post['image'])
                                            <div class="mb-2">
                                                <small class="text-muted">
                                                    <i class="fas fa-image"></i> {{ $post['image'] }}
                                                </small>
                                            </div>
                                        @endif

                                        <div class="mb-2">
                                            <strong>Platforms:</strong>
                                            @foreach($post['platforms'] as $platform)
                                                <span class="badge bg-{{ $availablePlatforms[$platform]['color'] }} me-1">
                                                    <i class="{{ $availablePlatforms[$platform]['icon'] }}"></i>
                                                    {{ $availablePlatforms[$platform]['name'] }}
                                                </span>
                                            @endforeach
                                        </div>

                                        @if($post['status'] === 'published')
                                            <div class="d-flex gap-3">
                                                <small class="text-muted">
                                                    <i class="fas fa-heart"></i> {{ $post['engagement']['likes'] }} likes
                                                </small>
                                                <small class="text-muted">
                                                    <i class="fas fa-share"></i> {{ $post['engagement']['shares'] }} shares
                                                </small>
                                                <small class="text-muted">
                                                    <i class="fas fa-comment"></i> {{ $post['engagement']['comments'] }} comments
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="col-md-4 text-end">
                                        <div class="mb-2">
                                            <span class="badge bg-{{ $post['status'] === 'published' ? 'success' : ($post['status'] === 'scheduled' ? 'warning' : 'secondary') }}">
                                                {{ ucfirst($post['status']) }}
                                            </span>
                                        </div>
                                        
                                        @if($post['scheduled_at'])
                                            <div class="mb-2">
                                                <small class="text-muted">
                                                    <i class="fas fa-clock"></i> 
                                                    {{ \Carbon\Carbon::parse($post['scheduled_at'])->format('M d, Y H:i') }}
                                                </small>
                                            </div>
                                        @endif

                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item" wire:click="duplicatePost({{ $post['id'] }})">
                                                        <i class="fas fa-copy"></i> Duplicate
                                                    </button>
                                                </li>
                                                @if($post['status'] === 'draft' || $post['status'] === 'scheduled')
                                                    <li>
                                                        <button class="dropdown-item text-primary" href="#">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                    </li>
                                                @endif
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <button class="dropdown-item text-danger" wire:click="deletePost({{ $post['id'] }})">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-edit fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No posts created yet</h5>
                            <p class="text-muted">Create your first post to get started with content management.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Character counter for post content
    document.addEventListener('livewire:load', function () {
        Livewire.hook('message.processed', (message, component) => {
            // Add any custom JavaScript functionality here
        });
    });
</script>
@endpush
