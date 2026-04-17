@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <!-- Post Card -->
            <div class="card mb-4">
                @if($post->image_path)
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $post->image_path) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 300px; object-fit: cover;">
                        @if($post->category)
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-primary fs-6 px-3 py-2">{{ $post->category->name }}</span>
                            </div>
                        @endif
                    </div>
                @endif

                <div class="card-body p-4">
                    <h1 class="card-title h2 fw-bold mb-3">{{ $post->title }}</h1>

                    <!-- Author and Date -->
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode($post->user->name) }}"
                             class="rounded-circle me-3"
                             alt="Author"
                             style="width: 40px; height: 40px;">
                        <div>
                            <h6 class="mb-0 fw-semibold">{{ $post->user->name }}</h6>
                            <small class="text-muted">
                                {{ $post->created_at->format('F j, Y') }} · {{ $post->views ?? 0 }} views
                            </small>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="post-content mb-4" style="line-height: 1.7; font-size: 1.1rem;">
                        {!! $post->content !!}
                    </div>

                    <!-- Tags -->
                    @if($post->tags->count() > 0)
                        <div class="mb-4">
                            @foreach($post->tags as $tag)
                                <a href="{{ route('posts.tag', $tag->slug) }}" class="badge bg-light text-dark text-decoration-none me-2 mb-2 px-3 py-2">
                                    <i class="fa-solid fa-tag me-1"></i>{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="card-footer bg-light border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-4">
                            <button class="action-btn add-like-btn {{ $post->isLikedBy(auth()->user()) ? 'liked' : '' }}"
                                    data-id="{{ $post->id }}"
                                    data-store-url="{{ route('addLike') }}">
                                <i class="fa-{{ $post->isLikedBy(auth()->user()) ? 'solid' : 'regular' }} fa-thumbs-up fa-sm me-1"></i>
                                <span class="fw-medium">{{ $post->likes->count() }}</span>
                            </button>

                            <a href="#comments" class="action-btn">
                                <i class="fa-solid fa-comment fa-sm me-1"></i>
                                <span class="fw-medium">{{ $post->comments->count() }}</span>
                            </a>
                        </div>

                        <a href="{{ route('index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back to Posts
                        </a>
                    </div>
                </div>
            </div>

    <!-- Comments Section -->
    <div class="card" id="comments">
        <div class="card-header bg-light border-0">
            <h4 class="mb-0 fw-semibold d-flex align-items-center">
                <i class="fa-solid fa-comments text-primary me-2"></i>
                Comments ({{ $post->comments->count() }})
            </h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @auth
                <!-- Comment Form -->
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <label for="content" class="form-label fw-medium">Add a comment</label>
                        <textarea
                            class="form-control @error('content') is-invalid @enderror"
                            id="content"
                            name="content"
                            rows="4"
                            placeholder="Share your thoughts..."
                            required
                        >{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-paper-plane me-1"></i>
                        Post Comment
                    </button>
                </form>
            @else
                <div class="alert alert-info border-0">
                    <i class="fa-solid fa-info-circle me-2"></i>
                    Please <a href="{{ route('login') }}" class="alert-link">login</a> to leave a comment.
                </div>
            @endauth

            <!-- Comments List -->
            @if($post->comments->count() > 0)
                <div class="comments-list">
                    @foreach($post->comments as $comment)
                        <div class="comment mb-3 p-3 bg-light rounded-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex align-items-start flex-grow-1">
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode($comment->user->name) }}"
                                         class="rounded-circle me-3 mt-1"
                                         alt="Commenter"
                                         style="width: 32px; height: 32px;">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center mb-2">
                                            <strong class="me-2">{{ $comment->user->name }}</strong>
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-0">{{ $comment->content }}</p>
                                    </div>
                                </div>
                                @auth
                                    @if($comment->user_id === auth()->id())
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Delete this comment?')" title="Delete comment">
                                                <i class="fa-solid fa-trash fa-sm"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <i class="fa-regular fa-comment-dots fa-3x mb-3 d-block"></i>
                    <h5 class="mb-2">No comments yet</h5>
                    <p class="mb-0">Be the first to share your thoughts!</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
