@extends('layouts.app')

@livewireScripts

@section('content')
    <div class="m-t-30">
        <div class="container">
            <livewire:review-evaluation :evaluation="$evaluation->id" />
        </div>
    </div>
@endsection
