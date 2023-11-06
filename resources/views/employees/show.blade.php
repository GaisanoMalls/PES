@extends('layouts.app')

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Employee Details</h1>

    <p><strong>Name:</strong> {{ $employee->name }}</p>
    <!-- Display other employee details here -->

    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>

    <a href="{{ route('evaluations.create', [$employee->id]) }}" class="btn btn-primary">Add Evaluation</a>

    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
