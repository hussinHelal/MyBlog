@extends('layouts.app')

@section('content')
    <div class="card">
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
        @endif

        <div class="card-body">
            <h1 class="card-title">{{ $post->title }}</h1>

            <div class="d-flex flex-wrap gap-2 mb-3">
                @if($post->category)
                    <a href="{{ route('posts.category', $post->category) }}" class="badge bg-primary text-decoration-none">
                        <i class="fa-solid fa-folder me-1"></i>
                        {{ $post->category->name }}
                    </a>
                @endif

                <!-- Tags -->
                @foreach($post->tags as $tag)
                    <a href="{{ route('posts.tag', $tag) }}" class="badge bg-secondary text-decoration-none">
                        <i class="fa-solid fa-tag me-1"></i>
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>

            <div class="text-muted mb-4">
                <small>
                    Posted {{ $post->created_at?->format('M d, Y') ?? 'Unknown' }} by
                    <a href="{{ route('posts.author', $post->user) }}" class="text-decoration-none">
                        {{ $post->user->name ?? 'Unknown' }}
                    </a>
                </small>
            </div>

            <div class="post-content">
                {{ $post->content }}
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-3">
                    <button  style="border:none; background:none;" class="add-like-btn d-flex align-items-center gap-1 {{ $post->isLikedBy(auth()->user()) ? 'liked' : '' }}"
                            data-id="{{ $post->id }}"
                            data-store-url="{{route('addLike')}}"
                            style="{{ $post->isLikedBy(auth()->user()) ? 'color: #0d6efd;' : '' }}">
                        <i class="fa-{{ $post->isLikedBy(auth()->user()) ? 'solid' : 'regular' }} fa-thumbs-up"></i>
                        <span>{{ $post->likes->count() }}</span>
                    </button>

                    <a href="#comments" class="d-flex align-items-center gap-1">
                        <i class="fa-solid fa-comment"></i>
                        <span>{{ $post->comments->count() }}</span>
                    </a>


                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('index') }}" class="btn btn-dark rounded-pill">
                        Back <i class="fa-solid fa-arrow-left ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4" id="comments">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fa-solid fa-comments me-2"></i>
                Comments ({{ $post->comments->count() }})
            </h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @auth
                <!-- Comment Form -->
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <label for="content" class="form-label">Add a comment</label>
                        <textarea
                            class="form-control @error('content') is-invalid @enderror"
                            id="content"
                            name="content"
                            rows="3"
                            placeholder="Write your comment..."
                            required
                        >{{ old('content') }}</textarea>
                        @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark rounded-pill">
                        <i class="fa-solid fa-paper-plane me-1"></i>
                         Comment
                    </button>
                </form>
            @else
                <div class="alert alert-info">
                    Please <a href="{{ route('login') }}">login</a> to leave a comment.
                </div>
            @endauth

            <!-- Comments List -->
            @if($post->comments->count() > 0)
                <hr>
                <div class="comments-list">
                    @foreach($post->comments as $comment)
                        <div class="comment mb-3 p-3 border rounded">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <strong class="me-2">{{ $comment->user->name }}</strong>
                                        <small class="text-muted">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <p class="mb-0">{{ $comment->content }}</p>
                                </div>

                                @auth
                                    @if($comment->user_id === auth()->id())
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this comment?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted text-center py-4">
                    <i class="fa-regular fa-comment-dots fa-2x mb-2 d-block"></i>
                    No comments yet. Be the first to comment!
                </p>
            @endif
        </div>
@endsection
