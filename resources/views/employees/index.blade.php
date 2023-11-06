@extends('layouts.app')

@section('content')
    <div class="">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Employee</h4>
                        <a href="add-employee.html" class="btn btn-primary float-right veiwbutton">Add Employee</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('employees.index') }}" method="GET">
                    <div class="row formtype">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Employee ID</label>
                                <input type="text" name="search_id" class="form-control" id="search_id"
                                    placeholder="Search by Employee ID" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group search-bar">
                                <label for="search">Employee Name</label>
                                <input type="text" name="search" class="form-control" id="search"
                                    value="{{ $search }}" placeholder="Search employees">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="search_role">
                                    <option value="">All Roles</option>
                                    <option value="Web Developer">Web Developer</option>
                                    {{-- <option value="Software Engineer">Software Engineer</option> --}}
                                    <option value="Staff">Staff</option>
                                    <option value="Accountant">Accountant</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Search</label>
                                <button type="submit" class="btn btn-success btn-block mt-0 search_button">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="table-responsive">
                        <div class="datatable table table-stripped">
                            <table id="employees-table" class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th><a class="text-black"
                                                href="{{ route('employees.index', ['orderBy' => 'employee_id', 'orderDirection' => $orderDirection === 'asc' ? 'desc' : 'asc']) }}">Employee
                                                ID</a></th>
                                        <th><a class="text-black"
                                                href="{{ route('employees.index', ['orderBy' => 'last_name', 'orderDirection' => $orderDirection === 'asc' ? 'desc' : 'asc']) }}">
                                                Name</a></th>
                                        <th><a class="text-black"
                                                href="{{ route('employees.index', ['orderBy' => 'department', 'orderDirection' => $orderDirection === 'asc' ? 'desc' : 'asc']) }}">
                                                Department</a></th>
                                        <th><a class="text-black"
                                                href="{{ route('employees.index', ['orderBy' => 'position', 'orderDirection' => $orderDirection === 'asc' ? 'desc' : 'asc']) }}">
                                                Position</a></th>
                                        <th><a class="text-black"
                                                href="{{ route('employees.index', ['orderBy' => 'date_hired', 'orderDirection' => $orderDirection === 'asc' ? 'desc' : 'asc']) }}">
                                                Date Hired</a></th>
                                        <th class="text-black">Status</th>
                                        <th class="text-right text-black">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($employees->count() > 0)
                                        @foreach ($employees as $employee)
                                            <tr class="text-center">
                                                <td>{{ $employee->employee_id }}</td>
                                                <td>{{ $employee->first_name . ' ' . $employee->last_name }}</td>
                                                <td>{{ $employee->department->name }}</td>
                                                <td>{{ $employee->position }}</td>
                                                <td>{{ \Carbon\Carbon::parse($employee->date_hired)->format('F d, Y') }}
                                                </td>
                                                <td>
                                                    @if ($employee->is_active == 1)
                                                        <div class="actions">
                                                            <a href="#"
                                                                class="btn btn-sm bg-success-light mr-2">Active</a>
                                                        </div>
                                                    @elseif ($employee->is_active == 2)
                                                        <div class="actions">
                                                            <a href="#"
                                                                class="btn btn-sm bg-danger-light mr-2">Inactive</a>
                                                        </div>
                                                    @else
                                                        <div class="actions">
                                                            <a href="#"
                                                                class="btn btn-sm bg-success-default mr-2">Unknown</a>
                                                        </div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                            aria-labelledby="dropdownMenuButton">
                                                            @foreach ($evaluationTemplates as $template)
                                                                <a class="dropdown-item"
                                                                    href="{{ route('evaluations.create', ['employee' => $employee->id, 'template' => $template->id, 'templateName' => $template->name]) }}"
                                                                    data-template-name="{{ $template->name }}"
                                                                    data-template-id="{{ $template->id }}">{{ $template->name }}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">No matching employees found.</td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>
                            {{ $employees->appends(['search' => $search])->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
