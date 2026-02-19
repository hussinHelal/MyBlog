<div class="sidebar bg-dark text-white" style="width: 250px; min-height: 100vh;">
    <div class="p-3">
        <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                <i class="fas fa-user-circle fa-2x"></i>
            </div>
            <div>
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <small class="text-muted">Administrator</small>
            </div>
        </div>

        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('admin') ? 'active' : '' }}"
               href="{{ route('admin') }}"
               style="border:none;">
                <i class="fas fa-tachometer-alt me-2"></i> Home
            </a>

            <a class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('showPosts') ? 'active' : '' }}"
               href="{{ route('showPosts') }}"
               style="border:none;">
                <i class="fas fa-newspaper me-2"></i> Posts
            </a>

            <a class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('showCategory') ? 'active' : '' }}"
               href="{{ route('showCategory') }}"
               style="border:none;">
                <i class="fas fa-folder me-2"></i> Categories
            </a>

            <a class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('showUsers') ? 'active' : '' }}"
               href="{{ route('showUsers') }}"
               style="border:none;">
                <i class="fas fa-users me-2"></i> Users
            </a>

            <a class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('showComment') ? 'active' : '' }}"
               href="{{ route('showComment') }}"
               style="border:none;">
                <i class="fas fa-comments me-2"></i> Comments
            </a>

            <a class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('showTags') ? 'active' : '' }}"
               href="{{ route('showTags') }}"
               style="border:none;">
                <i class="fas fa-tag me-2"></i> Tags
            </a>
        </div>

        <hr class="text-muted">

        <div class="list-group list-group-flush">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="list-group-item list-group-item-action bg-dark text-white w-100 text-start" style="border:none;">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>
