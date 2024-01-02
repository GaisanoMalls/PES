@extends('layouts.app')


@section('content')
    <div class="m-t-30">
        <h3>Edit Employee</h3>
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="employee_id">Employee ID</label>
                    <input type="text" name="employee_id" id="employee_id" class="form-control"
                        value="{{ $employee->employee_id }}">
                </div>
            </div>

            <div class="row">

                <div class="form-group col-md-4">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"
                        value="{{ $employee->first_name }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control"
                        value="{{ $employee->last_name }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="department_id">Department</label>
                    <select name="department_id" id="department_id" class="form-control">
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ $department->id == $employee->department_id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="position">Position</label>
                    <input type="text" name="position" id="position" class="form-control"
                        value="{{ $employee->position }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="employment_status">Employment Status</label>
                    <input type="text" name="employment_status" id="employment_status" class="form-control"
                        value="{{ $employee->employment_status }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="date_hired">Date Hired</label>
                    <input type="date" name="date_hired" id="date_hired" class="form-control"
                        value="{{ $employee->date_hired }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('employees.index') }}" class="btn btn-outline-success">Cancel</a>
        </form>
    </div>
@endsection
