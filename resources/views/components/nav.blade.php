<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('posts.index') }}">My Blog</a>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('posts.index') }}">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('notes.index') }}">Notes</a>
                </li>
            </ul>
            {{-- <p class="seperator" style="height:10px; width:1px; border:2px solid rgba(0, 0, 0, 0.466);">  </p>      --}}

             <ul class="navbar-nav">
                <li class="nav-item dropdown ">
                    @auth
                    <a class="nav-link dropdown-toggle text-white" href=" # " id="userDropdown" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item text-white" href="#">Profile</a></li>
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
                     <form method="get" action="{{ route('showLogin') }}">
                                @csrf
                                <button type="submit" class="nav-link text-success"> Login </button>
                     </form>    
                    </li>
                     <li class="nav-item "> 
                         <form method="get" action="{{ route('showRegister') }}">
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
