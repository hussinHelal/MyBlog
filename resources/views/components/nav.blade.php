<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('posts.index') }}">Dev.Up</a>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="text-white nav-link" href="{{ route('posts.index') }}">Posts</a>
                </li>
                
            </ul>
            {{-- <p class="seperator" style="height:10px; width:1px; border:2px solid rgba(0, 0, 0, 0.466);">  </p>      --}}

             <ul class="navbar-nav">
                <li class="nav-item dropdown ">
                    @auth
                    <a class="text-white nav-link dropdown-toggle" href=" # " id="userDropdown" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="text-white dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-secondary">Logout</button>
                            </form>
                        </li>
                    </ul>
                    @endauth
                    @guest
                    <ul class="navbar-nav">
                     <li class="nav-item">
                     <form method="get" action="{{ route('login') }}">
                                @csrf
                                <button type="submit" class="nav-link text-success"> Login </button>
                     </form>
                    </li>
                     <li class="nav-item ">
                         <form method="get" action="{{ route('register') }}">
                                @csrf
                                <button type="submit" class="nav-link text-success"> Register </button>
                         </form>
                    </li>
                    @endguest
                </ul>
                </li>
            </ul>
    </div>
</nav>
