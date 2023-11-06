@extends('layouts.app')
@include('flatpickr::components.style')
@include('flatpickr::components.script')

@section('content')
    <div class="m-t-30">
        <h1>Create User</h1>
        <livewire:create-employee :employee="$employee->id" />
    </div>
@endsection
