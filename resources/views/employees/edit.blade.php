@extends('layouts.app')


@section('content')
    <div class="m-t-30">
        <h1>Edit Employee</h1>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="employee_id">Employee ID</label>
                <input type="text" name="employee_id" id="employee_id" class="form-control"
                    value="{{ $employee->employee_id }}">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"
                        value="{{ $employee->first_name }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control"
                        value="{{ $employee->last_name }}">
                </div>
            </div>


            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $employee->email }}">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control"
                    value="{{ $employee->phone_number }}">
            </div>


            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                    <option value="">Select Role</option>
                    <optgroup label="ICT Department">
                        <option value="Software Engineer" {{ $employee->role == 'Software Engineer' ? 'selected' : '' }}>
                            Software Engineer</option>
                        <option value="Network Engineer" {{ $employee->role == 'Network Engineer' ? 'selected' : '' }}>
                            Network Engineer</option>
                        <option value="System Administrator"
                            {{ $employee->role == 'System Administrator' ? 'selected' : '' }}>
                            System Administrator</option>
                        <option value="IT Support Specialist"
                            {{ $employee->role == 'IT Support Specialist' ? 'selected' : '' }}>IT Support Specialist
                        </option>
                        <option value="Web Developer" {{ $employee->role == 'Web Developer' ? 'selected' : '' }}>Web
                            Developer</option>
                    </optgroup>
                </select>
            </div>

            <div class="form-group">
                <label for="join_date">Join Date</label>
                <x-flatpickr name="join_date" id="join_date" altFormat="F j, Y" value="{{ $employee->join_date }}" />
            </div>

            <!-- Add more fields as needed -->

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
