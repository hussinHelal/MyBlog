@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2>
            <i class="fa-solid fa-folder me-2"></i>
            {{ $category->name }}
        </h2>
        @if($category->description)
            <p class="text-muted">{{ $category->description }}</p>
        @endif
        <small class="text-muted">{{ $posts->total() }} posts</small>
    </div>

    @forelse($posts as $post)
        @include('posts.partials.post-card')
    @empty
        <div class="alert alert-info">
            No posts in this category yet.
        </div>
    @endforelse

    {{ $posts->links() }}
@endsection
