<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin') }}">{{ config('app.name') }} Dashboard</a>

        <div class="collapse navbar-collapse" id="adminNavbar">

            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href=" # " id="userDropdown" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                    @endauth
                    @guest
                     <li class="dropdown-item nav-item"> <a class="nav-link" href=" {{ route('showLogin') }} " > Login </a> </li>
                     <li class="dropdown-item nav-item"> <a class="nav-link" href=" {{ route('showRegister') }} "> Register </a> </li>
                    @endguest
            </ul>
        </div>
    </div>
</nav>
