@extends('layouts.app')
@include('flatpickr::components.style')
@include('flatpickr::components.script')
@livewireScripts
@section('content')
    <div class="m-t-30">
        <livewire:role-selector :employee="$employee->id" />
    </div>
@endsection
