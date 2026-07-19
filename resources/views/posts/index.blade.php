@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        @forelse ($posts as $post)
            <div class="mt-2 col-12">
                <div class="overflow-hidden shadow-sm card">
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
                            <div class="p-4 card-body">
                                <div class="mb-3 d-flex justify-content-between align-items-start">
                                    <h2 class="mb-0 card-title h4">
                                        {{ $post->title ?? 'no post title'}}
                                    </h2>
                                    <span class="badge bg-primary ms-2">{{ $post->category->name ?? 'no category' }}</span>
                                </div>

                                <div class="pb-2 mb-3 d-flex align-items-center border-bottom">
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

                                <p class="mb-3 card-text text-muted">{{ Str::limit($post->content ?? 'no post', 200) }}</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="gap-3 d-flex">
                                        <button class="action-btn add-like-btn {{ $post->isLikedBy(auth()->user()) ? 'liked' : '' }}"
                                                data-id="{{ $post->id }}"
                                                data-store-url="{{ route('addLike') }}">
                                            <i class="fa-{{ $post->isLikedBy(auth()->user()) ? 'solid' : 'regular' }} fa-thumbs-up"></i>
                                            <span>like ({{ $post->likes->count() }})</span>
                                        </button>

                                        <a href="{{ route('posts.show', $post) }}" class="action-btn">
                                            <i class="fa-solid fa-comment"></i>
                                            <span>Comment ({{ $post->comments->count() }})</span>
                                        </a>
                                    </div>

                                    <a href="{{ route('posts.show', $post) }}" class="btn btn-dark rounded-pill">
                                        Read More <i class="fa-solid fa-arrow-right ms-1"></i>
                                    </a>
                                </div>

                                <div class="mt-2 tags">
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
            </div>
        @empty
            <p>No posts available</p>
        @endforelse
    </div>

    @if($posts->hasPages())
        <div class="mt-4 row">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection

</div>


