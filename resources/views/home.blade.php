@extends('layouts.app')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <h3 class="page-title mt-3">Good Day {{ Auth::user()->employee->first_name }}!</h3>


                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        @if (Auth::user()->role_id != 4)
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card board1 fill">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <div>
                                    @php
                                        $sixMonthsAgo = now()->subMonths(6);
                                        $newlyHiredCount = DB::table('employees')
                                            ->where('date_hired', '>=', $sixMonthsAgo)
                                            ->count();
                                    @endphp
                                    <h3 class="card_widget_header">{{ $newlyHiredCount }}</h3>
                                    <h6 class="text-muted">Newly Hired</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0"> <span
                                        class="opacity-7 text-muted"><!-- https://feathericons.dev/?search=user&iconset=feather -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50"
                                            height="50" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                    </span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12" onclick="window.location='{{ route('evaluations.index') }}'"
                    style="cursor: pointer;">
                    <div class="card board1 fill">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <!-- resources/views/your-view.blade.php -->
                                @php
                                    $totalEvaluations = DB::table('evaluations')->count();
                                @endphp
                                <div>
                                    <h3 class="card_widget_header">{{ $totalEvaluations }}</h3>
                                    <h6 class="text-muted">Evaluations</h6>
                                </div>

                                <div class="ml-auto mt-md-3 mt-lg-0"> <span
                                        class="opacity-7 text-muted"><!-- https://feathericons.dev/?search=file&iconset=feather -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50"
                                            height="50" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z" />
                                            <polyline points="13 2 13 9 20 9" />
                                        </svg>
                                    </span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card board1 fill">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                @php
                                    $regularEmployeesCount = DB::table('employees')
                                        ->where('employment_status', '=', 'REGULAR')
                                        ->count();
                                @endphp

                                <div>
                                    <h3 class="card_widget_header">{{ $regularEmployeesCount }}</h3>
                                    <h6 class="text-muted">Regular</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0"> <span
                                        class="opacity-7 text-muted"><!-- https://feathericons.dev/?search=user-check&iconset=feather -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50"
                                            height="50" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                            <circle cx="8.5" cy="7" r="4" />
                                            <polyline points="17 11 19 13 23 9" />
                                        </svg>
                                    </span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card board1 fill">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <div>
                                    @php
                                        $totalEmployees = DB::table('employees')->count();
                                    @endphp

                                    <h3 class="card_widget_header">{{ $totalEmployees }}</h3>
                                    <h6 class="text-muted">Total Employees</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0"> <span
                                        class="opacity-7 text-muted"><!-- https://feathericons.dev/?search=users&iconset=feather -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="60"
                                            height="60" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        </svg>
                                    </span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
