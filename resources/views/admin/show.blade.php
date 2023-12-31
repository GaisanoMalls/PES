@extends('layouts.app')

@section('content')
    <div class="m-t-30">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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
                        <strong>{{ $user->employee->first_name . ' ' . $user->employee->last_name }}</strong>
                    </h5>
                    <h5 class="text-muted mt-1">
                        <strong>Employee ID: {{ $user->employee->employee_id }}</strong>
                    </h5>


                    <h5 class="text-muted mt-1">Email: <strong>{{ $user->email }}</strong></h5>
                    <h5 class="text-muted mt-1">Role: <strong>{{ $user->role->name }}</strong></h5>
                    <h5 class="text-muted mt-1">Business Unit: <strong>{{ $businessUnitName }}</strong></h5>
                </div>
            </div>
            <div class="m-t-30">
                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal">Edit</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>


        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Employee Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Edit Form -->
                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role_id" id="role" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="bu-group">
                                <label for="bu_id">Select Business Unit:</label>
                                <select name="bu_id" id="bu_id" class="form-control">
                                    @foreach ($businessUnits as $bu)
                                        <option value="{{ $bu->id }}">{{ $bu->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="department-group">
                                <label for="department_id">Select Department:</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            @if ($user->evaluator && $department->id == $user->evaluator->department_id) selected @endif>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="password">Password (Leave blank to keep current password)</label>
                                <input type="hidden" name="current_password" id="current_password"
                                    value="{{ $user->password }}">

                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password (Optional)</label>
                                <input type="password" name="new_password" id="new_password" class="form-control">
                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
