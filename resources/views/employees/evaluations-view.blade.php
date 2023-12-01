{{-- resources/views/your-view.blade.php --}}
{{-- resources/views/your-view.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="m-t-30">
        @livewire('employee-details', ['employeeId' => $selectedEmployeeId])
    </div>
@endsection
