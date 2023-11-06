<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    @livewireScripts
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @guest
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">
                @yield('content')
            </main>
        @else
            {{-- LOGGED IN --}}
            <div class="main-wrapper">
                <div class="header">
                    <div class="header-left">
                        <a href="{{ route('home') }}" class="logo">
                            <img src="{{ asset('assets/img/profiles/logo.png') }}" width="50" height="70"
                                alt="logo">
                            <span class="logoclass">PMES</span>
                        </a>
                        <a href="{{ url('/') }}" class="logo logo-small">
                            <img src="{{ asset('assets/img/profiles/avatar.png') }}" alt="Logo" width="30"
                                height="30">
                        </a>
                    </div>
                    <a href="javascript:void(0);" id="toggle_btn">
                        <i class="fe fe-text-align-left"></i>
                    </a>
                    <a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
                    <ul class="nav user-menu">
                        <li class="nav-item dropdown has-arrow">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <span class="user-img">
                                    <img class="rounded-circle" src="{{ asset('assets/img/profiles/avatar.png') }}"
                                        width="31" alt="Soeng Souy">
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="user-header">
                                    <div class="avatar avatar-sm">
                                        <img src="{{ asset('assets/img/profiles/avatar.png') }}" alt="User Image"
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="user-text">
                                        <h6> {{ Auth::user()->email }}</h6>
                                        <p class="text-muted mb-0">{{ Auth::user()->role->name }}</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="#">My Profile</a>
                                <a class="dropdown-item" href="#">Account Settings</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="sidebar" id="sidebar">
                    <div class="sidebar-inner slimscroll">
                        <div id="sidebar-menu" class="sidebar-menu">
                            <ul>
                                <li class="active">
                                    <a href="{{ route('employees.index') }}"><i class="fas fa-tachometer-alt"></i>
                                        <span>Dashboard</span></a>
                                </li>
                                <li class="list-divider"></li>
                                <li class="submenu">
                                    <a href="#"><i class="fas fa-user"></i> <span> Employees </span>
                                        <span class="menu-arrow"></span></a>
                                    <ul class="submenu_class" style="display: none">
                                        <li><a href="{{ route('employees.index') }}">Employees List </a></li>
                                        <li><a href="{{ route('evaluations.index') }}">Evaluation </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="page-wrapper">
                    <div class="content container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        @endguest


    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.morris.js') }}"></script> --}}
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

</body>

</html>
