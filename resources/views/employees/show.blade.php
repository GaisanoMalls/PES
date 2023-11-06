@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>Employee Details</h1>
        <p>Employee ID: {{ $employee->id }}</p>
        <p><strong>Name:</strong> {{ $employee->first_name . ' ' . $employee->last_name }}</p>
        <!-- Display other employee details here -->
        <a href="{{ route('employees.create', ['id' => $employee->id]) }}">
            <button class="btn btn-primary">Create User</button>
        </a>

        <a href="{{ route('employees.role', ['id' => $employee->id]) }}">
            <button class="btn btn-primary">Set Role</button>
        </a>

        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>



        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a>


    </div>
@endsection
