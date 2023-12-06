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



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css" />

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            // Get the current authenticated user
                            $user = Auth::user();
                            
                            // Retrieve user notifications based on employee_id, ordered by created_at in descending order
                            $notifications = \App\Models\Notification::where('employee_id', $user->employee_id)
                                ->orderBy('created_at', 'desc')
                                ->get();
                            ?>
                        @endauth

                        <li class="nav-item dropdown noti-dropdown">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fe fe-bell"></i>
                                <span
                                    class="badge badge-pill">{{ isset($notifications) ? $notifications->count() : 0 }}</span>
                            </a>
                            <div class="dropdown-menu notifications">
                                <div class="topnav-dropdown-header">
                                    <span class="notification-title">Notifications</span>
                                    <a href="{{ route('markAllAsRead') }}" class="clear-noti"> Clear All </a>
                                </div>
                                <div class="noti-content">
                                    <ul class="notification-list">
                                        @auth
                                            @forelse ($notifications as $notification)
                                                <li class="notification-message">
                                                    <a href="#"
                                                        onclick="redirectToEvaluation('{{ $notification->evaluation_id }}', '{{ Auth::user()->role_id }}')">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p class="noti-details">
                                                                    <span
                                                                        class="noti-title">{{ $notification->notif_title }}</span>
                                                                    <span
                                                                        class="noti-title">{{ $notification->notif_desc }}</span>
                                                                </p>
                                                                <p class="noti-time">
                                                                    <span
                                                                        class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <script>
                                                        function redirectToEvaluation(evaluationId, userRoleId) {
                                                            var baseUrl = '/evaluations';

                                                            if (userRoleId == 2 || userRoleId == 5) {
                                                                window.location.href = baseUrl + '/view/' + evaluationId;
                                                            } else if (userRoleId == 3) {
                                                                window.location.href = baseUrl + '/' + evaluationId + '/review';
                                                            }
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
                                        <a href="#"><i class="fas fa-user"></i> <span> Evaluations </span>
                                            <span class="menu-arrow"></span></a>
                                        <ul class="submenu_class"
                                            style="{{ request()->routeIs('employees.evaluations') || request()->routeIs('employees.evaluations-view') ? 'display:block' : 'display:none' }}">
                                            <li>
                                                <a class="{{ request()->routeIs('employees.evaluations') || request()->routeIs('employees.evaluations-view') ? 'active' : '' }}"
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
                                <li class="{{ request()->routeIs('settings') ? 'active' : '' }}">
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

    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

    @livewireScripts

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
