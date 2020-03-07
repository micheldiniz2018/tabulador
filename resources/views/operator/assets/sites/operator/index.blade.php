@extends('layouts.app')

@section('content')

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <a class="button-a" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf

        </form>
        You are logged in supervisor
    </div>

@endsection