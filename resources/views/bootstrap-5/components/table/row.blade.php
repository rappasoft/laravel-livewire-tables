@props(['url' => null])

<tr
    {{ $attributes }}

    @if ($url)
        onclick="window.location='{{ $url }}';"
        style="cursor:pointer"
    @endif
>
    {{ $slot }}
</tr>
