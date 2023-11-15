@extends('layouts.app')
@include('flatpickr::components.style')
@include('flatpickr::components.script')
@livewireScripts

@section('content')
    <div class="m-t-30">
        <div class="container">
            <livewire:edit-evaluation :evaluation="$evaluation->id" />
        </div>
    </div>
@endsection
