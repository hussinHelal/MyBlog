@extends('layouts.app')

@section('content')
<div class="card">
    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
    @endif
    
    <div class="card-body">
        <h1 class="card-title">{{ $post->title }}</h1>
        
        <div class="text-muted mb-4">
            <small>Posted {{ $post->created_at->format('M d, Y') }} by {{ $post->user->name ?? 'Unknown' }}</small>
        </div>
        
        <div class="post-content">
            {{ $post->content }}
        </div>
    </div>
    
    <div class="card-footer">
        <div class="d-flex justify-content-between">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
        </div>
    </div>
</div>
@endsection
