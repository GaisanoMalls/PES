@extends('layouts.app')

@section('content')
    <div class="m-t-30">
        @php
            $employeeId = \App\Models\User::find(auth()->user()->id)->employee->employee_id;
        @endphp
        @livewire('employee-details', ['employeeId' => $employeeId])
    </div>
@endsection
