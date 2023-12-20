@extends('layouts.app')

@section('content')
    @livewire('dept-config-show', ['id' => $config->id])
@endsection
