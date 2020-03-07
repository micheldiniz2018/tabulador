<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

<!-- meta dependences -->
@include('operator.assets.meta.meta')
<!-- css dependences -->
@include('operator.assets.css.css')
<!-- TITLE -->
@include('operator.assets.title.title')
</head>
<body>
<!-- content -->
@yield('content')

<!-- js -->
@include('operator.assets.js.js')
</body>
</html>

