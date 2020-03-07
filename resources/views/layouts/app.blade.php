<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- meta dependences -->
    @include('assets.meta.meta')
    <!-- css dependences -->
    @include('assets.css.css')
    <!-- TITLE -->
    @include('assets.title.title')
</head>
<body>
    <!-- content -->
     @yield('content')

     <!-- js -->
     @include('assets.js.js')
</body>
</html>
