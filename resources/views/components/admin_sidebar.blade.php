<div class="sidebar bg-dark text-white" style="width: 250px; min-height: 100vh;">
    <div class="p-3">
        <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                <i class="fas fa-user-circle fa-2x"></i>
            </div>
            <div>
                <h6 class="mb-0 ">{{ Auth::user()->name }}</h6>
                <small class="text-muted">Administrator</small>
            </div>
        </div>

        <div class="list-group">
            {{-- <li class="nav-item"> --}}
                <a class="list-group-item list-group-item active text-white  {{ request()->routeIs('admin') ? 'active' : '' }}"  aria-current="true" href="{{ route('admin') }}" style="border:none;">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard </a>
            {{-- </li> --}}
            {{-- {{ request()->routeIs('admin.posts') ? 'active' : '' }}" href="{{ route('showPosts') }}" --}}
            {{-- <li class="nav-item"> --}}
                <a class="list-group-item list-group-item-dark text-white bg-dark {{ request()->routeIs('showPosts') ? 'active' : '' }} " style="border:none;" href="{{ route('showPosts') }}">
                    <i class="fas fa-newspaper me-2"></i> Posts </a>
            {{-- </li> --}}
            {{-- {{ request()->routeIs('admin.categories') ? 'active' : '' }}" href="{{ route('admin.categories') }}" --}}
            {{-- <li class="nav-item">  --}}
                <a class="list-group-item list-group-item-dark text-white bg-dark {{ request()->routeIs('showCategory') ? 'active' : '' }} " style="border:none;" href="{{ route('showCategory') }}">
                    <i class="fas fa-folder me-2"></i> Categories </a>
            {{-- </li> --}}
            {{-- {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}" --}}
            {{-- <li class="nav-item"> --}}
                <a class="list-group-item list-group-item-dark text-white bg-dark {{ request()->routeIs('showUsers') ? 'active' : '' }} " style="border:none;" href="{{ route('showUsers') }}">
                    <i class="fas fa-users me-2"></i> Users </a>
            {{-- </li> --}}
            {{-- {{ request()->routeIs('admin.comments') ? 'active' : '' }}" href="{{ route('admin.comments') }}" --}}
            {{-- <li class="nav-item"> --}}
                <a class="list-group-item list-group-item-dark text-white bg-dark {{ request()->routeIs('showComment') ? 'active' : '' }} " style="border:none;" href="{{ route('showComment') }}">
                    <i class="fas fa-comments me-2"></i> Comments  </a>
            {{-- </li> --}}
            {{-- <li class="nav-item"> --}}
                <a class="list-group-item list-group-item-dark text-white bg-dark {{ request()->routeIs('showNotes') ? 'active' : '' }} " style="border:none;" href="{{ route('showNotes') }}">
                    <i class="fas fa-newspaper me-2"></i> Notes  </a>
            {{-- </li> --}}
        </div>

        <hr class="text-muted">

        <div class="list-group">
            {{-- <li class="nav-item"> --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                       <a class="list-group-item list-group-item-dark text-white bg-dark " style="border:none;">
                        <i class="fas fa-sign-out me-2"></i> Logout  </a>
                </form>
            {{-- </li> --}}
        </div>
    </div>
</div>
