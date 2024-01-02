@extends('layouts.app')

@section('content')
    <div class="m-t-30">
        <h1>Create User</h1>
        <livewire:employee-registration :employee="$employee->employee_id" />
    </div>
@endsection
