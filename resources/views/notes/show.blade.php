@extends('layouts.app')

@section('content')
<div class="container">
    <article class="note">
        <header class="mb-4">
            <h1 class="display-4 fw-bold">{{ $note->title }}</h1>
            
            <div class="d-flex align-items-center mb-3">
                <div class="me-3">
                    <img src="{{ $note->user->profile_photo_url }}" class="rounded-circle" width="40" height="40" alt="{{ $note->user->name }}">
                </div>
                <div>
                    <div class="fw-bold">{{ $note->user->name }}</div>
                    <div class="text-muted">
                        <small>
                            <i class="fas fa-calendar me-1"></i> {{ $note->created_at->format('F j, Y') }}
                            <span class="mx-2">•</span>
                            <i class="fas fa-clock me-1"></i> {{ $note->read_time }} min read
                        </small>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center mb-4">
                <span class="badge bg-info me-2">{{ $note->category->name }}</span>
                @foreach($note->tags as $tag)
                    <a href="{{ route('notes.tag', $tag->slug) }}" class="badge bg-secondary text-decoration-none me-2">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>

            @if($note->featured_image)
                <img src="{{ $note->featured_image }}" class="img-fluid rounded mb-4" alt="{{ $note->title }}">
            @endif
        </header>

        <div class="note-content mb-5">
            {!! $note->content !!}
        </div>

        <footer class="border-top pt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <button class="btn btn-outline-info btn-sm">
                            <i class="fas fa-thumbs-up me-1"></i> Like
                        </button>
                    </div>
                    <div>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-share me-1"></i> Share
                        </button>
                    </div>
                </div>
                <div class="text-muted">
                    <small>
                        <i class="fas fa-eye me-1"></i> {{ $note->views }} views
                    </small>
                </div>
            </div>

            <div class="author-box bg-light p-4 rounded mb-5">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <img src="{{ $note->user->profile_photo_url }}" class="rounded-circle" width="80" height="80" alt="{{ $note->user->name }}">
                    </div>
                    <div>
                        <h5 class="mb-1">{{ $note->user->name }}</h5>
                        <p class="text-muted mb-2">{{ $note->user->bio ?? 'No bio available' }}</p>
                        <div class="social-links">
                            @if($note->user->twitter)
                                <a href="{{ $note->user->twitter }}" class="text-decoration-none me-2">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                            @if($note->user->linkedin)
                                <a href="{{ $note->user->linkedin }}" class="text-decoration-none me-2">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="related-notes">
                <h3 class="mb-4">Related Notes</h3>
                <div class="row">
                    @foreach($relatedNotes as $relatedNote)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('notes.show', $relatedNote->slug) }}" class="text-decoration-none">
                                            {{ $relatedNote->title }}
                                        </a>
                                    </h5>
                                    <p class="card-text small text-muted">
                                        <i class="fas fa-calendar me-1"></i> {{ $relatedNote->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </footer>
    </article>
</div>
@endsection
