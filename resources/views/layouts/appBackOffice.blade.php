<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- meta dependences -->
@include('backoffice.assets.meta.meta')
<!-- css dependences -->
@include('backoffice.assets.css.css')
<!-- TITLE -->
    @include('backoffice.assets.title.title')
</head>
<body>
<div id="page-loader" class="show"></div>
<!-- content -->
@yield('content')

<!-- js -->
@include('backoffice.assets.js.js')
<script>
    One.loader('show');
</script>
</body>
</html>
