@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h1 class="display-4">Notes</h1>
            <p class="lead">Quick insights and personal thoughts</p>
        </div>
    </div>

    <div class="row">
        @forelse($notes as $note)
            <div class="col-12 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="card-title h4 mb-0">
                                <a href="{{ route('notes.show', $note->slug) }}" class="text-decoration-none text-dark">
                                    {{ $note->title }}
                                </a>
                            </h2>
                            <span class="badge bg-info">{{ $note->category->name }}</span>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <small class="text-muted me-3">
                                <i class="fas fa-user me-1"></i> {{ $note->user->name }}
                            </small>
                            <small class="text-muted me-3">
                                <i class="fas fa-calendar me-1"></i> {{ $note->created_at->format('M d, Y') }}
                            </small>
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i> {{ $note->views }} views
                            </small>
                        </div>

                        <p class="card-text">{{ Str::limit($note->excerpt, 200) }}</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="tags">
                                @foreach($note->tags as $tag)
                                    <a href="{{ route('notes.tag', $tag->slug) }}" class="badge bg-secondary text-decoration-none me-1">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                            <a href="{{ route('notes.show', $note->slug) }}" class="btn btn-info text-white">
                                Read More <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> No notes found. Check back later!
                </div>
            </div>
        @endforelse
    </div>

    @if($notes->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                {{ $notes->links() }}
            </div>
        </div>
    @endif
</div>
@endsection


