@props(['url' => null, 'customAttributes' => []])

<tr
    {{ $attributes->merge($customAttributes) }}

    @if ($url)
        onclick="window.location='{{ $url }}';"
        style="cursor:pointer"
    @endif
>
    {{ $slot }}
</tr>
