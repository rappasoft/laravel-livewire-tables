@props(['url' => null])

<tr
    {{ $attributes->merge(['class' => 'bg-white']) }}

    @if ($url)
        onclick="window.location='{{ $url }}';"
        style="cursor:pointer"
    @endif
>
    {{ $slot }}
</tr>
