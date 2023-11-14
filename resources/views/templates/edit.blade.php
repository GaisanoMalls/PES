@extends('layouts.app')
@include('flatpickr::components.style')
@include('flatpickr::components.script')
@livewireScripts

@section('content')
    <div class="m-t-30">
        <div class="container">


            <livewire:evaluation-template-edit :templateId="$templateId" />

        </div>
    </div>
@endsection
