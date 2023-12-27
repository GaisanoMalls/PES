@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('assets/img/profiles/logo.png') }}" width="50" height="70" alt="logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
