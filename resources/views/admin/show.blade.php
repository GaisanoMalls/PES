@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>Employee Details</h1>
        <p>Employee ID: {{ $user->employee->employee_id }}</p>
        <p><strong>Department:</strong> {{ $departmentName }}</p>
        <p><strong>Name:</strong> {{ $user->employee->first_name . ' ' . $user->employee->last_name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role->name }}</p>
        <p><strong>Created At:</strong> {{ $user->created_at }}</p>
        <p><strong>Last Update:</strong> {{ $user->updated_at }}</p>

        <p><strong>Business Unit:</strong> {{ $businessUnitName }}</p>

        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal">Edit</button>



        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a>


    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
                            <label for="business_unit">Business Unit</label>
                            <select name="business_unit" id="business_unit" class="form-control">
                                @foreach ($businessUnits as $businessUnit)
                                    <option value="{{ $businessUnit->id }}"
                                        @if ($user->role_id == 2) {{ $businessUnit->id === $user->evaluator->bu_id ? 'selected' : '' }}
                                    @elseif ($user->role_id == 3)
                                        {{ $businessUnit->id === $user->approver->bu_id ? 'selected' : '' }}
                                    @else
                                        {{ $businessUnit->id === $user->approver->bu_id ? 'selected' : '' }} @endif>
                                        {{ $businessUnit->name }}
                                    </option>
                                @endforeach
                            </select>
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



                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
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
