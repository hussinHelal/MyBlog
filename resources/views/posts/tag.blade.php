@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2>
            <i class="fa-solid fa-tag me-2"></i>
            {{ $tag->name }}
        </h2>
        <small class="text-muted">{{ $posts->total() }} posts</small>
    </div>

    @forelse($posts as $post)
        @include('posts.partials.post-card')
    @empty
        <div class="alert alert-info">
            No posts with this tag yet.
        </div>
    @endforelse

    {{ $posts->links() }}
@endsection
