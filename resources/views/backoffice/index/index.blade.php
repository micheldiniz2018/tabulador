@extends('layouts.appBackOffice')
@section('content')

    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
        @include('backoffice.index.menu')
        @include('backoffice.index.header')
        @yield('contentbody')
    </div>

@endsection