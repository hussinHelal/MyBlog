<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MyBlog') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; }
        .card {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.25), 0 2px 4px rgba(0,0,0,0.15);
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.35), 0 4px 8px rgba(0,0,0,0.25);
        }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; }
        .btn-primary:hover { background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%); }
        .text-gradient { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* Dark Mode Styles */
        [data-bs-theme="dark"] body {
            background-color: #1a1a1a;
            color: #e0e0e0;
        }
        [data-bs-theme="dark"] .navbar {
            background-color: #2d2d2d !important;
            border-bottom: 1px solid #3d3d3d;
        }
        [data-bs-theme="dark"] .card {
            background-color: #2d2d2d;
            color: #e0e0e0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.6), 0 2px 4px rgba(0,0,0,0.4);
        }
        [data-bs-theme="dark"] .form-control {
            background-color: #3d3d3d;
            border-color: #4d4d4d;
            color: #e0e0e0;
        }
        [data-bs-theme="dark"] .form-control::placeholder {
            color: #999;
        }
        [data-bs-theme="dark"] .dropdown-menu {
            background-color: #2d2d2d;
            border-color: #3d3d3d;
        }
        [data-bs-theme="dark"] .dropdown-item {
            color: #e0e0e0;
        }
        [data-bs-theme="dark"] .dropdown-item:hover,
        [data-bs-theme="dark"] .dropdown-item:focus {
            background-color: #3d3d3d;
            color: #fff;
        }
        [data-bs-theme="dark"] .dropdown-divider {
            border-color: #3d3d3d;
        }
        [data-bs-theme="dark"] .nav-link {
            color: #e0e0e0;
        }
        [data-bs-theme="dark"] .nav-link:hover {
            color: #fff;
        }
        [data-bs-theme="dark"] .text-muted {
            color: #999 !important;
        }
        [data-bs-theme="dark"] .badge {
            background-color: #4d4d4d !important;
        }
        [data-bs-theme="dark"] .btn-outline-secondary {
            color: #e0e0e0;
            border-color: #4d4d4d;
        }
        [data-bs-theme="dark"] .btn-outline-secondary:hover {
            background-color: #4d4d4d;
            border-color: #4d4d4d;
        }
        .theme-toggle {
            cursor: pointer;
            transition: transform 0.3s;
        }
        .theme-toggle:hover {
            transform: rotate(20deg);
        }

        /* Action buttons (like, comment) */
        .action-btn {
            border: none;
            background: none;
            cursor: pointer;
            color: #6c757d;
            transition: color 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0;
        }
        .action-btn:hover {
            color: #495057;
        }
        .action-btn.liked {
            color: #667eea;
            font-weight: 600;
        }
        [data-bs-theme="dark"] .action-btn {
            color: #999;
        }
        [data-bs-theme="dark"] .action-btn:hover {
            color: #bbb;
        }
        [data-bs-theme="dark"] .action-btn.liked {
            color: #9db4ff;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="bg-white shadow-sm navbar navbar-expand-md navbar-light" style="min-height: 50px;">
            <div class="px-3 container-fluid px-md-4" style="display: flex; align-items: center;">
                <a class="navbar-brand text-gradient fs-5 fs-md-6" href="{{ route('index') }}">
                    <i class="fas fa-blog me-2"></i>Dev.Up
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}">Home</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Dark Mode Toggle -->
                        <li class="mt-2 nav-item me-3">
                            <button class="btn btn-sm btn-outline-secondary theme-toggle" type="button" id="themeToggle" title="Toggle dark mode">
                                <i class="fas fa-moon"></i>
                            </button>
                        </li>

                        <!-- Search Bar - Hide on mobile, show on md+  mt-2 me-5 -->
                        <li class="mt-3 nav-item d-none d-md-flex align-items-between ">
                            <form class="d-flex align-items-center" action="{{ route('index') }}" method="GET" style="gap: 0.5rem;">
                                <input class="form-control form-control-sm" type="search" name="search" placeholder="Search posts..." value="{{ request('search') }}" style="width: 200px; height: 38px;">
                                <button class="btn btn-sm btn-outline-secondary" type="submit" style="height: 38px; width: 38px; padding: 0; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </li>

                        @guest
                            <li class="nav-item me-2">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Sign Up</a>
                            </li>
                        @else
                            <!-- Mobile Search Icon -->
                            <li class="nav-item d-md-none me-2">
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSearch">
                                    <i class="fas fa-search"></i>
                                </button>
                            </li>

                            <li class="mt-2 nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode(Auth::user()->name) }}" class="rounded-circle me-2" alt="Profile" style="width: 32px; height: 32px; object-fit: cover;">
                                    <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('settings') }}">
                                        <i class="fas fa-cog me-2"></i>Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>

                <!-- Mobile Search Form - Hidden by default -->
                @auth
                    <div class="mt-2 collapse d-md-none w-100" id="mobileSearch">
                        <form class="d-flex" action="{{ route('index') }}" method="GET">
                            <input class="form-control form-control-sm" type="search" name="search" placeholder="Search posts..." value="{{ request('search') }}">
                            <button class="btn btn-sm btn-outline-secondary ms-2" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </nav>

        <main class="container py-4">
            @yield('content')
        </main>
    </div>

    <script>
        // Initialize dark mode from localStorage or system preference
        function initializeDarkMode() {
            const htmlElement = document.documentElement;
            const themeToggle = document.getElementById('themeToggle');
            const savedTheme = localStorage.getItem('theme');

            let isDarkMode = false;

            if (savedTheme) {
                isDarkMode = savedTheme === 'dark';
            } else {
                // Check system preference
                isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            }

            applyTheme(isDarkMode);
        }

        function applyTheme(isDarkMode) {
            const htmlElement = document.documentElement;
            const themeToggle = document.getElementById('themeToggle');

            if (isDarkMode) {
                htmlElement.setAttribute('data-bs-theme', 'dark');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                localStorage.setItem('theme', 'dark');
            } else {
                htmlElement.removeAttribute('data-bs-theme');
                themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                localStorage.setItem('theme', 'light');
            }
        }

        // Toggle theme on button click
        document.getElementById('themeToggle').addEventListener('click', function() {
            const isDarkMode = document.documentElement.getAttribute('data-bs-theme') === 'dark';
            applyTheme(!isDarkMode);
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', initializeDarkMode);
    </script>
</body>
</html>
