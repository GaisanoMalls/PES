@extends('layouts.app')

@section('content')
    <div class="m-t-30">
        <div class="profile-header">
            <h3>Employee Details</h3>
            <div class="row align-items-center">
                <div class="col-auto profile-image">
                    <a href="#"> <img class="rounded-circle" alt="User Image"
                            src=" {{ asset('assets/img/profiles/avatar.png') }}">
                    </a>
                </div>
                <div class="col ml-md-n2 profile-user-info">
                    <h5 class="user-name mb-3">Name:
                        <strong>{{ $employee->first_name . ' ' . $employee->last_name }}</strong>
                    </h5>
                    <h5 class="text-muted mt-1">
                        <strong>Employee ID: {{ $employee->employee_id }}</strong>
                    </h5>


                </div>
            </div>
            <div class="m-t-30">
                <a href="{{ route('employees.create', ['employee_id' => $employee->employee_id]) }}">
                    <button class="btn btn-primary">Create User</button>
                </a>
                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>


    {{-- <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>



        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a> --}}
@endsection
