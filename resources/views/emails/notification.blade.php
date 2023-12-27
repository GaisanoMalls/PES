@component('mail::message')
    Great Day! <br>
    <p>{{ $body }}</p>
    @component('mail::button', ['url' => $link])
        More Details
    @endcomponent
@endcomponent
