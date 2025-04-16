@extends('layouts.app')

@section('content')
@forelse ($posts as $post)
    <div class="card mb-4">
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ Str::limit($post->content, 300) }}</p>
        </div>
        <div class="card-footer">
            <small class="text-muted">Posted {{ $post->created_at->diffForHumans() }}</small>
            <a href="{{ route('posts.show', $post) }}" class="btn btn-primary float-end">Read More</a>
        </div>
    </div>
@empty
    <div class="alert alert-info">
        No posts found.
    </div>
@endforelse

<div class="container">
<div class="d-flex justify-content-center mb-4">
    {{ $posts->links('pagination::bootstrap-5') }}
</div>
</div>

@endsection


