@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2>
            <i class="fa-solid fa-user me-2"></i>
            Posts by {{ $user->name }}
        </h2>
        <small class="text-muted">{{ $posts->total() }} posts</small>
    </div>

    @forelse($posts as $post)
        @include('posts.partials.post-card')
    @empty
        <div class="alert alert-info">
            This author hasn't posted anything yet.
        </div>
    @endforelse

    {{ $posts->links() }}
@endsection
