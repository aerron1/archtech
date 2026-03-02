@extends('layouts.admin')

@section('page-title', 'View Post')
@section('page-subtitle', 'Post Details')

@section('content')
<div class="admin-card">
    <div class="d-flex justify-content-between align-items-center admin-card-header mb-4">
        <h3 class="admin-card-title mb-0">
            <i class="fas fa-eye me-2"></i>Post Details
        </h3>
        <div>
            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-archtech-outline me-2">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-archtech">
                <i class="fas fa-arrow-left me-2"></i>Back to Posts
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Post Title -->
            <div class="mb-4">
                <h2 style="color: #084433;">{{ $post->title }}</h2>
                <div class="d-flex align-items-center text-muted">
                    <i class="fas fa-user me-2"></i>
                    <span class="me-3">{{ $post->user->name }}</span>
                    <i class="fas fa-calendar me-2"></i>
                    <span>
                        {{ $post->created_at->format('F j, Y \a\t g:i A') }}
                    </span>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="mb-4">
                @if($post->is_published && $post->published_at <= now())
                    <span class="badge badge-published">Published</span>
                @elseif($post->is_published && $post->published_at > now())
                    <span class="badge badge-pending">
                        <i class="fas fa-clock me-1"></i>
                        Scheduled for {{ $post->published_at->format('M d, Y') }}
                    </span>
                @else
                    <span class="badge badge-draft">Draft</span>
                @endif
            </div>

            <!-- Featured Image -->
            @if($post->featured_image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $post->featured_image) }}"
                         alt="{{ $post->title }}"
                         class="img-fluid rounded"
                         style="max-height: 400px; width: 100%; object-fit: cover;">
                </div>
            @endif

            <!-- Excerpt -->
            @if($post->excerpt)
                <div class="mb-4 p-3" style="background-color: #f8f9fa; border-left: 4px solid #084433;">
                    <p class="mb-0">{{ $post->excerpt }}</p>
                </div>
            @endif

            <!-- Content -->
            <div class="mb-4">
                <div class="post-content">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <!-- Slug -->
            <div class="mb-4">
                <h5 class="fw-bold" style="color: #084433;">URL Slug</h5>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{ $post->slug }}" readonly>
                    <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard(this)">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                <small class="text-muted">This is the URL identifier for this post</small>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Post Statistics -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h4 class="admin-card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Statistics
                    </h4>
                </div>
                <div class="p-3">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                            <span>Created</span>
                            <span class="fw-bold">{{ $post->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                            <span>Last Updated</span>
                            <span class="fw-bold">{{ $post->updated_at->format('M d, Y') }}</span>
                        </div>
                        @if($post->published_at)
                            <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                                <span>Published</span>
                                <span class="fw-bold">{{ $post->published_at->format('M d, Y') }}</span>
                            </div>
                        @endif
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                            <span>Author</span>
                            <span class="fw-bold">{{ $post->user->name }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h4 class="admin-card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h4>
                </div>
                <div class="p-3">
                    <div class="d-grid gap-2">
                        <a href="{{ route('posts.show', $post) }}" target="_blank" class="btn btn-archtech">
                            <i class="fas fa-external-link-alt me-2"></i>View on Website
                        </a>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-archtech-outline">
                            <i class="fas fa-edit me-2"></i>Edit Post
                        </a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-grid">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post? This action cannot be undone.')">
                                <i class="fas fa-trash me-2"></i>Delete Post
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function copyToClipboard(button) {
        const input = button.parentElement.querySelector('input');
        input.select();
        document.execCommand('copy');

        // Change button icon temporarily
        const icon = button.querySelector('i');
        icon.className = 'fas fa-check';
        setTimeout(() => {
            icon.className = 'fas fa-copy';
        }, 2000);
    }
</script>
@endpush
