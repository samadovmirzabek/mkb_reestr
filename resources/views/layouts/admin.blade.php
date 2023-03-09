<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/assets/img/logomk.jpg">

    <title>MIKROKREDITBANK</title>
    @include('admin.partials.css')
</head>
<body >
<div class="main-wrapper">
    <div class="header">
        <div class="header-left" style="background-color:white">
            <a href="" class="logo">
                <img src="/assets/img/logomkb.jpg" alt="Logo" width="50" height="70"/>
            </a>
            <a href="" class="logo logo-small">
                <img src="/assets/img/logotap.jpg" alt="Logo" width="50" height="70"/>
            </a>
        </div>
        <div>
            @if(Route::has('login'))
                <div  class="nav justify-content-end" >
                    @auth
                    <li class="nav-item">
                        <a class="btn btn-success"  href="">{{auth()->user()->name}}</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="btn btn-primary nav-link" style="color:yellow" href="{{url('/login')}}">Login</a>
                    </li>         
                  <!-- @if(Route::has('register'))

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">Register</a>
                    </li>
                    @endif -->
                   
                    @endauth

                    <div class="btn_middle d-flex" >
                        <a href="{{route('user_sahifa')}}" class="btn btn-primary d-flex">Qidiruv sahifa</a>
                     </div>

                </div>
            @endif
        </div>
    </div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            @include('layouts.sidebar')
        </div>
    </div>
    <div class="page-wrapper">
        @yield('content')
    </div>
@include('admin.partials.js')
@yield('script')
</body>
</html>
