@extends('layouts.appOperator')
@section('content')

    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
        @include('operator.varejo.menu')
        @include('operator.varejo.header')
        @yield('contentbody')
    </div>

@endsection
