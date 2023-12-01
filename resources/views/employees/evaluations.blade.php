@extends('layouts.app')

@section('content')
    {{-- @livewire('employee-index') --}}
    <div class="m-t-30">
        <livewire:employee-evaluation-table />
    </div>
@endsection
