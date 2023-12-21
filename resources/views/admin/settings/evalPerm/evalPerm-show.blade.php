@extends('layouts.app')

@section('content')
    <div class="m-t-30">
        @livewire('evaluation-permission-show', ['employeeId' => $evalPerm->employee_id])
    </div>
@endsection
