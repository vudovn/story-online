<!DOCTYPE html>
<html lang="en">
@include('admin.components.head')

<body>
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    @include('admin.components.sidebar')
    @include('admin.components.header')
    <div class="pc-container">
        <div class="pc-content">
            @yield('content')
        </div>
    </div>
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
        </div>
    </footer>
    @include('admin.components.scripts')
</body>

</html>
