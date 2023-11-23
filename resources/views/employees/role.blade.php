@extends('layouts.app')

@livewireScripts
@section('content')
    <div class="m-t-30">
        <livewire:role-selector :employee="$employee->id" />
    </div>
@endsection
