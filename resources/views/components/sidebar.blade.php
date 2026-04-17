<div class="sidebar-content">
    <div class="mb-4">
        <h6 class="mb-3 fw-bold text-muted text-uppercase small">Discover</h6>
        {{-- <div class="gap-2 d-grid">
            <a href="{{ route('index') }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-home me-2"></i>Home
            </a>
            <a href="#" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-fire me-2"></i>Trending
            </a>
            <a href="#" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-clock me-2"></i>Latest
            </a>
        </div> --}}
    </div>

    <div class="mb-4">
        <h6 class="mb-3 fw-bold text-muted text-uppercase small">Categories</h6>
        <div class="gap-1 d-grid">
            @php
                $categories = \App\Models\Category::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
            @endphp
            @forelse($categories as $category)
                <a href="{{ route('posts.category', $category) }}" class="px-3 py-2 rounded text-decoration-none d-flex justify-content-between align-items-center hover-bg-light">
                    <span class="text-dark">{{ $category->name }}</span>
                    <span class="badge bg-primary rounded-pill">{{ $category->posts_count }}</span>
                </a>
            @empty
                <p class="mb-0 text-muted small">No categories yet</p>
            @endforelse
        </div>
    </div>

    <div class="mb-4">
        <h6 class="mb-3 fw-bold text-muted text-uppercase small">Popular Tags</h6>
        <div class="flex-wrap gap-1 d-flex">
            @php
                $tags = \App\Models\Tag::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
            @endphp
            @forelse($tags as $tag)
                <a href="{{ route('posts.tag', $tag->slug) }}" class="border badge bg-light text-dark text-decoration-none">
                    #{{ $tag->name }}
                </a>
            @empty
                <p class="mb-0 text-muted small">No tags yet</p>
            @endforelse
        </div>
    </div>

    <div class="mb-4">
        <h6 class="mb-3 fw-bold text-muted text-uppercase small">About</h6>
        <p class="mb-0 text-muted small">
            Welcome to MyBlog! Share your thoughts, connect with others, and discover amazing content.
        </p>
    </div>

    <div class="pt-3 border-top">
        <p class="mb-2 text-muted small">© 2026 Dev.up</p>
        {{-- <div class="gap-2 d-flex">
            <a href="#" class="text-muted small text-decoration-none">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-muted small text-decoration-none">
                <i class="fab fa-github"></i>
            </a>
            <a href="#" class="text-muted small text-decoration-none">
                <i class="fab fa-discord"></i>
            </a>
        </div> --}}
    </div>
</div>

<style>
.hover-bg-light:hover {
    background-color: #f8f9fa !important;
}
</style>
