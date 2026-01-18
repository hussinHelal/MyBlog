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
         <div class="col-12 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 ">
                            <h2 class="card-title h4 mb-0 ">
                                {{-- <a href="{{ route('notes.show', $post->slug) }}" class="text-decoration-none text-dark"> --}}
                                    {{ $post->title ?? 'no post title'}}
                                </a>
                            </h2>
                            <span class="badge bg-primary">{{ $post->category->name ?? 'no category' }}</span>
                        </div>

                        <div class="d-flex align-items-center mb-3 border-bottom border-black">
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
                         @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                        @endif
                        <p class="card-text mt-4">{{ Str::limit($post->content ?? 'no post' , 200) }}</p>

                        <div class="d-flex justify-content-between align-items-center p-1 mt-4">
                            <div class="tags">
                                @if($post->tags)
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('posts.tag', $tag->slug) }}" class="badge bg-secondary text-decoration-none me-1">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                                @endif
                            </div>
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-dark text-white rounded-pill" >
                                More <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-12 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}
                            <span class="badge bg-primary">{{ $post->category->name ?? 'no category' }}</span> </h5>
                        <p class="card-text">{{ Str::limit($post->content, 300) }}</p>
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Posted {{ $post->created_at->diffForHumans() }}
                        </small>
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div> --}}
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i> No posts found.
                </div>
            </div>
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
