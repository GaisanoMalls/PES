<!DOCTYPE html>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>


<body>
    <div id="app">
        @guest
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
                        <br>
                    </div>

                    <a href="javascript:void(0);" id="toggle_btn">
                        <i class="fe fe-text-align-left"></i>
                    </a>
                    <a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
                    <ul class="nav user-menu">
                        @auth
                            <?php
                            $user = Auth::user();
                            
                            $evaluationNotifications = \App\Models\NotificationEvaluation::where('notifiable_id', $user->employee_id)
                                ->orderBy('created_at', 'desc')
                                ->get();
                            $employeeNotifications = \App\Models\NotificationEmployee::where('notifiable_id', $user->employee_id)
                                ->orderBy('created_at', 'desc')
                                ->get();
                            
                            $unreadEvaluationNotificationsCount = $evaluationNotifications->whereNull('read_at')->count();
                            $unreadEmployeeNotificationsCount = $employeeNotifications->whereNull('read_at')->count();
                            
                            $unreadNotificationsCount = $unreadEvaluationNotificationsCount + $unreadEmployeeNotificationsCount;
                            
                            $notifications = $evaluationNotifications->merge($employeeNotifications)->sortByDesc('created_at');
                            
                            ?>
                        @endauth
                        <li class="nav-item dropdown noti-dropdown">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fe fe-bell"></i>
                                <span class="@if ($unreadNotificationsCount > 0) badge badge-pill @endif">
                                    @if (!$unreadNotificationsCount == 0)
                                        {{ $unreadNotificationsCount }}
                                    @endif
                                </span>
                            </a>

                            <div class="dropdown-menu notifications">
                                <div class="topnav-dropdown-header">
                                    <span class="notification-title">Notifications</span>
                                    <a href="{{ url('/mark-all-as-read') }}" class="clear-noti">Mark as Read All</a>
                                </div>
                                <div class="noti-content">
                                    <ul class="notification-list">
                                        @auth
                                            @forelse ($notifications as $notification)
                                                <li class="notification-message">
                                                    <a href="#"
                                                        onclick="redirectToNotification('{{ $notification->type }}', '{{ $notification->person_id }}', '{{ Auth::user()->role_id }}', '{{ $notification->id }}')">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p
                                                                    class=" @if (!$notification->read_at) noti-details-unread unread-notification @else noti-details @endif">
                                                                    @if ($notification->type == 'evaluation')
                                                                        @if (stripos($notification->notif_title, 'Approved') === 0)
                                                                            <!-- SVG code for Approved -->
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 24 24" width="24"
                                                                                height="24" class="main-grid-item-icon"
                                                                                fill="none" stroke="#339900"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                stroke-width="2">
                                                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                                                                <polyline points="22 4 12 14.01 9 11.01" />
                                                                            </svg>
                                                                        @elseif (stripos($notification->notif_title, 'Partially') === 0)
                                                                            <!-- https://feathericons.dev/?search=clock&iconset=feather -->

                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 24 24" width="24"
                                                                                height="24" class="main-grid-item-icon"
                                                                                fill="none" stroke="#586D4D"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                stroke-width="2">
                                                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                                                                <polyline points="22 4 12 14.01 9 11.01" />
                                                                            </svg>
                                                                        @elseif (stripos($notification->notif_title, 'New') !== false)
                                                                            <!-- SVG code for New -->
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 24 24" width="24"
                                                                                height="24" class="main-grid-item-icon"
                                                                                fill="none" stroke="#99cc33"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                stroke-width="2">
                                                                                <path
                                                                                    d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                                                <polyline points="14 2 14 8 20 8" />
                                                                                <line x1="16" x2="8"
                                                                                    y1="13" y2="13" />
                                                                                <line x1="16" x2="8"
                                                                                    y1="17" y2="17" />
                                                                                <polyline points="10 9 9 9 8 9" />
                                                                            </svg>
                                                                        @elseif (stripos($notification->notif_title, 'Disapproved') === 0)
                                                                            <!-- SVG code for Disapproved -->
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 24 24" width="24"
                                                                                height="24" class="main-grid-item-icon"
                                                                                fill="none" stroke="#cc3300"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                stroke-width="2">
                                                                                <circle cx="12" cy="12"
                                                                                    r="10" />
                                                                                <line x1="15" x2="9"
                                                                                    y1="9" y2="15" />
                                                                                <line x1="9" x2="15"
                                                                                    y1="9" y2="15" />
                                                                            </svg>
                                                                        @elseif (stripos($notification->notif_title, 'Clarification') === 0)
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 24 24" width="24"
                                                                                height="24" class="main-grid-item-icon"
                                                                                fill="none" stroke="#ffcc00"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                stroke-width="2">
                                                                                <circle cx="12" cy="12"
                                                                                    r="10" />
                                                                                <line x1="12" x2="12"
                                                                                    y1="16" y2="12" />
                                                                                <line x1="12" x2="12.01"
                                                                                    y1="8" y2="8" />
                                                                            </svg>
                                                                        @elseif (stripos($notification->notif_desc, 'acknowledged') !== false)
                                                                            <!-- https://feathericons.dev/?search=user-check&iconset=feather -->
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 24 24" width="24"
                                                                                height="24" class="main-grid-item-icon"
                                                                                fill="none" stroke="#99cc33"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                stroke-width="2">
                                                                                <path
                                                                                    d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                                                                <circle cx="8.5" cy="7" r="4" />
                                                                                <polyline points="17 11 19 13 23 9" />
                                                                            </svg>
                                                                        @endif
                                                                    @else
                                                                        @if (stripos($notification->notif_desc, '105') !== false)
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 24 24" width="24"
                                                                                height="24" class="main-grid-item-icon"
                                                                                fill="none" stroke="#ff9966"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                stroke-width="2">
                                                                                <path
                                                                                    d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                                                                                <line x1="12" x2="12"
                                                                                    y1="9" y2="13" />
                                                                                <line x1="12" x2="12.01"
                                                                                    y1="17" y2="17" />
                                                                            </svg>
                                                                        @else
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 24 24" width="24"
                                                                                height="24" class="main-grid-item-icon"
                                                                                fill="none" stroke="#cc3300"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                stroke-width="2">
                                                                                <path
                                                                                    d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                                                                                <line x1="12" x2="12"
                                                                                    y1="9" y2="13" />
                                                                                <line x1="12" x2="12.01"
                                                                                    y1="17" y2="17" />
                                                                            </svg>
                                                                        @endif
                                                                    @endif
                                                                    <span
                                                                        class="noti-title">{{ $notification->notif_title }}</span>

                                                                </p>
                                                                <p class="noti-time">
                                                                    <span
                                                                        class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <script>
                                                        function redirectToNotification(type, targetId, userRoleId, notificationId) {
                                                            var baseUrl = '/evaluations'; // Change this to the appropriate base URL
                                                            var baseUrl2 = '/employee_evaluations/'; // Change this to the appropriate base URL

                                                            // Make an AJAX request to update the notification status
                                                            $.ajax({
                                                                url: '/update-notification/' + notificationId,
                                                                type: 'GET',
                                                                success: function() {
                                                                    // Handle success, then redirect based on the notification type
                                                                    if (type === 'evaluation') {
                                                                        if (userRoleId == 2 || userRoleId == 5) {
                                                                            window.location.href = baseUrl + '/view/' + targetId;
                                                                        } else if (userRoleId == 3 || userRoleId == 4) {
                                                                            window.location.href = baseUrl + '/review/' + targetId;
                                                                        }
                                                                    } else if (type === 'employee') {
                                                                        window.location.href = baseUrl2 + targetId;
                                                                    }
                                                                },
                                                                error: function(error) {
                                                                    console.error('Error updating notification:', error);
                                                                }
                                                            });
                                                        }
                                                    </script>

                                                </li>
                                            @empty
                                                <li class="notification-message ml-3 mt-3">
                                                    <p>No notifications</p>
                                                </li>
                                            @endforelse
                                        @endauth

                                    </ul>
                                </div>
                                <div class="topnav-dropdown-footer">
                                    <a href="#">View all Notifications</a>
                                </div>
                            </div>
                        </li>


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
                                        <p> {{ Auth::user()->employee->first_name . ' ' . Auth::user()->employee->last_name }}
                                        </p>
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
                                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                    <a href="{{ route('home') }}"><i class="fas fa-tachometer-alt"></i>
                                        <span>Dashboard</span></a>
                                </li>
                                @if (Auth::user()->role_id != 4)
                                    <li class="list-divider"></li>
                                    <li class="submenu">
                                        <a href="#"><i class="fas fa-file"></i> <span> Evaluations </span>
                                            <span class="menu-arrow"></span></a>
                                        <ul class="submenu_class"
                                            style="{{ request()->routeIs('employees.evaluations') ? 'display:block' : 'display:none' }}">
                                            <li>
                                                <a class="{{ request()->routeIs('employees.evaluations') ? 'active' : '' }}"
                                                    href="{{ route('employees.evaluations') }}">Employee
                                                    Evaluation List </a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li class="submenu">
                                        <a href="#"><i class="fas fa-user"></i> <span> Employees </span>
                                            <span class="menu-arrow"></span></a>
                                        <ul class="submenu_class"
                                            style="{{ request()->routeIs('employees.index') || request()->routeIs('evaluations.index') ? 'display:block' : 'display:none' }}">
                                            <li>
                                                <a class="{{ request()->routeIs('employees.index') ? 'active' : '' }}"
                                                    href="{{ route('employees.index') }}">Employees List </a>
                                            </li>
                                            <li>
                                                <a class="{{ request()->routeIs('evaluations.index') ? 'active' : '' }}"
                                                    href="{{ route('evaluations.index') }}">Evaluation Status </a>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li class="{{ request()->routeIs('employee.myevaluations') ? 'active' : '' }}">
                                        <a href="{{ route('employee.myevaluations') }}"><i
                                                class="fa fa-user-circle"></i><span>My
                                                Evaluations</span></a>
                                    </li>
                                @endif

                                @if (Auth::user()->role_id == 1)
                                    <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                                        <a href="{{ route('users.index') }}"><i class="fa fa-user-circle"></i><span>User
                                                Management</span></a>
                                    </li>
                                @endif
                                @if (Auth::user()->role_id == 5)
                                    <li class="{{ request()->routeIs('templates.index') ? 'active' : '' }}">
                                        <a href="{{ route('templates.index') }}"><i
                                                class="fa fa-user-circle"></i><span>Evaluation Template</span></a>
                                    </li>
                                    <li>
                                        <a><i class="fe fe-table"></i> <span> Reports
                                            </span>
                                            <span class="menu-arrow"></span></a>
                                        <ul class="submenu_class"
                                            style="{{ request()->routeIs('reports.reco-employees') || request()->routeIs('reports.list-evaluated') || request()->routeIs('reports.list-evaluation') ? 'display:block' : 'display:none' }}">
                                            <li>
                                                <a class="{{ request()->routeIs('reports.reco-employees') ? 'active' : '' }}"
                                                    href="{{ route('reports.reco-employees') }}">List of Recommended
                                                    Employees
                                                </a>
                                            </li>
                                            <li><a class="{{ request()->routeIs('reports.list-evaluated') ? 'active' : '' }}"
                                                    href="{{ route('reports.list-evaluated') }}">List of Evaluated
                                                    Employees
                                                </a></li>
                                            <li><a class="{{ request()->routeIs('reports.list-evaluation') ? 'active' : '' }}"
                                                    href="{{ route('reports.list-evaluation') }}">List of Evaluations
                                                </a></li>
                                        </ul>
                                    </li>
                                @endif

                                @if (Auth::user()->role_id == 1)
                                    <li class="submenu">
                                        <a href="#"><i class="fas fa-user"></i> <span> Settings </span>
                                            <span class="menu-arrow"></span></a>
                                        <ul class="submenu_class"
                                            style="{{ request()->routeIs('settings.evalperm') || request()->routeIs('settings.deptconfig') || request()->routeIs('settings.evalpermShow') || request()->routeIs('settings.deptconfigEdit') || request()->routeIs('settings.evalpermCreate') || request()->routeIs('settings.deptconfigCreate') || request()->routeIs('settings.evalpermEdit') ? 'display:block' : 'display:none' }}">
                                            <li>
                                                <a class="{{ request()->routeIs('settings.evalperm') || request()->routeIs('settings.evalpermCreate') || request()->routeIs('settings.evalpermShow') || request()->routeIs('settings.evalpermEdit') ? 'active' : '' }}"
                                                    href="{{ route('settings.evalperm') }}">Evaluations Permissions</a>
                                            </li>
                                            <li>
                                                <a class="{{ request()->routeIs('settings.deptconfig') || request()->routeIs('settings.deptconfigEdit') || request()->routeIs('settings.deptconfigCreate') ? 'active' : '' }}"
                                                    href="{{ route('settings.deptconfig') }}">Department
                                                    Configuration</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="page-wrapper">
                    <div class="content m-t-15">
                        @yield('content')
                    </div>
                </div>
            </div>
        @endguest


    </div>
    @livewireScripts
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.morris.js') }}"></script> --}}
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        window.addEventListener('swal:modal', event => {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-secondary",
                    cancelButton: "btn btn-info"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                reverseButtons: true,
                icon: "success",
                title: "Evaluation Submitted",
                text: "You will be notified if the evaluation is approved",
                confirmButtonText: "Close",
                footer: ''
            }).then((result) => {
                if (result.isConfirmed) {
                    redirectAfterClose();
                } else if (result.dismiss === Swal.DismissReason.cancel) {

                }
            });
        });

        window.addEventListener('swal:modal2', event => {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-secondary",
                    cancelButton: "btn btn-info"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                reverseButtons: true,
                icon: "success",
                title: "Evaluation Submitted with recommendations",
                text: "2nd text",
                footer: `2nd footer`,
                confirmButtonText: "Close",
            }).then((result) => {
                if (result.isConfirmed) {
                    redirectAfterClose();
                }
            });
        });


        window.addEventListener('swal:success', event => {
            Swal.fire({
                icon: 'success',
                title: 'Evaluation Template Created Successfully',
                showCancelButton: false,
                confirmButtonText: 'Close',
                customClass: {
                    confirmButton: 'btn btn-secondary',
                },
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    redirectAfterCloseEvalautionIndex();
                }
            });
        });




        window.addEventListener('swal:success2', event => {
            Swal.fire({
                icon: 'success',
                title: 'Evaluation Approved',
                showCancelButton: false,
                confirmButtonText: 'Close',
                customClass: {
                    confirmButton: 'btn btn-secondary',
                },
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    redirectAfterClose();
                }
            });
        });
        window.addEventListener('swal:success3', event => {
            Swal.fire({
                icon: 'success',
                title: 'Evaluation Disapproved',
                showCancelButton: false,
                confirmButtonText: 'Close',
                customClass: {
                    confirmButton: 'btn btn-secondary',
                },
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    redirectAfterClose();
                }
            });
        });

        window.addEventListener('swal:update', event => {
            Swal.fire({
                icon: 'success',
                title: 'Evaluation Template Updated Successfully',
                showCancelButton: false,
                confirmButtonText: 'Close',
                customClass: {
                    confirmButton: 'btn btn-secondary',
                },
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    redirectAfterCloseEvalautionIndex();
                }
            });
        });

        function redirectAfterClose() {
            window.location.href = '{{ route('evaluations.index') }}';
        }

        function redirectAfterCloseEvalautionIndex() {
            window.location.href = '{{ route('templates.index') }}';
        }
    </script>

    <script>
        function deleteTemplate(templateId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this template!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('delete-form-' + templateId).submit();
                }
            });
        }
    </script>

    <script>
        function confirmDeleteEvaluation(evaluationId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this evaluation!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, make an AJAX request to delete the evaluation
                    $.ajax({
                        url: '/delete-evaluation/' + evaluationId, // Adjust the URL based on your setup
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Handle the success response if needed
                            Swal.fire('Deleted!', 'Your evaluation has been deleted.', 'success');
                            // Optionally, you can reload the page or perform other actions
                            location.reload();
                        },
                        error: function(error) {
                            // Handle the error response if needed
                            Swal.fire('Error!', 'An error occurred while deleting the evaluation.',
                                'error');
                        }
                    });
                }
            });
        }
    </script>


    <script>
        function submit {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>


</body>

</html>
