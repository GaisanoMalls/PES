@extends('layouts.app')

@livewireScripts

@section('content')
    <div class="m-t-30">
        <div class="container">

            <livewire:evaluation-form :employee="$employee->id" :templateName="$templateName" :templateId="$template->id" />
        </div>

    </div>
@endsection
