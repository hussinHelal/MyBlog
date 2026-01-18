<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components.admin_head')
<body>
    @include('components.admin_nav')

    <div class="d-flex">
        <div class="sidebar w-20">
            @include('components.admin_sidebar')
        </div>
    <div class="main-content d-flex">
        <div class="content-wrapper w-auto m-5">
            @yield('content')
        </div>
    </div>
    </div>


@include('components.foot')
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
