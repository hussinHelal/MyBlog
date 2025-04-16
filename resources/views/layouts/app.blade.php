<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components.head')
<body>
    @include('components.nav')

    <div class="main-content">
        <div class="sidebar">
            @include('components.sidebar')
        </div>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    
@include('components.foot')
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
