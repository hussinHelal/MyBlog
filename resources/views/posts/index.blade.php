@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-4 border-bottom border-black">Posts</h1>
        </div>
    </div>

    <div class="row">
    @forelse ($posts as $post)
    <div class="col-12 mt-2">
        <div class="card  shadow-sm overflow-hidden">
            <div class="row g-0">
                @if($post->image_path)
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $post->image_path) }}"
                         class="img-fluid h-100 object-fit-cover"
                         alt="{{ $post->title }}"
                         style="min-height: 250px;">
                </div>
                @endif
                <div class="{{ $post->image_path ? 'col-md-8' : 'col-12' }}">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h2 class="card-title h4 mb-0">
                                {{ $post->title ?? 'no post title'}}
                            </h2>
                            <span class="badge bg-primary ms-2">{{ $post->category->name ?? 'no category' }}</span>
                        </div>

                        <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                            <small class="text-muted me-3">
                                <i class="fas fa-user me-1"></i> {{ $post->user->name ?? 'unknown' }}
                            </small>
                            <small class="text-muted me-3">
                                <i class="fas fa-calendar me-1"></i> {{ $post->created_at?->format('M d, Y') ?? 'no date' }}
                            </small>
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i> {{ $post->views ?? 0 }} views
                            </small>
                        </div>

                        <p class="card-text text-muted mb-3">{{ Str::limit($post->content ?? 'no post', 200) }}</p>

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="d-flex gap-3">
                                <button class="add-like-btn d-flex align-items-center gap-1 {{ $post->isLikedBy(auth()->user()) ? 'liked' : '' }}"
                                        data-id="{{ $post->id }}"
                                        data-store-url="{{route('addLike')}}"
                                        style="{{ $post->isLikedBy(auth()->user()) ? 'color: #0d6efd;' : '' }} ; border:none; background:none;">
                                    <i class="fa-{{ $post->isLikedBy(auth()->user()) ? 'solid' : 'regular' }} fa-thumbs-up"></i>
                                    <span>like ({{ $post->likes->count() }})</span>
                                </button>

                                <a href="{{ route('posts.show', $post) }}" class="d-flex align-items-center gap-1 text-decoration-none" style="background: none; border:none;">
                                    <i class="fa-solid fa-comment"></i>
                                    <span>Comment ({{ $post->comments->count() }})</span>
                                </a>

                            </div>

                            <a href="{{ route('posts.show', $post) }}" class="btn btn-dark rounded-pill">
                                Read More <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                        <div class="tags mt-2">
                            @if($post->tags->count() > 0)
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('posts.tag', $tag->slug) }}" class="badge bg-secondary text-decoration-none me-1">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            @endif
                        </div>

                </div>
            </div>
        </div>
    </div>

    @empty
        <p>No posts available</p>
    @endforelse

</div>

    @if($posts->hasPages())
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif

</div>

@endsection
