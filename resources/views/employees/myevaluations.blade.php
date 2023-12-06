@extends('layouts.app')

@section('content')
    <div class="m-t-30">
        @php
            // Assuming $user is the authenticated user
            $employeeId = \App\Models\User::find(auth()->user()->id)->employee->id;
        @endphp
        @livewire('employee-details', ['employeeId' => $employeeId])
    </div>
@endsection
