@props(['url' => null, 'reordering' => false, 'customAttributes' => []])

@if (!$reordering && $attributes->has('wire:sortable.item'))
    @php
        $attributes = $attributes->filter(fn ($value, $key) => $key !== 'wire:sortable.item');
    @endphp
@endif

<tr
    {{ $attributes->merge($customAttributes) }}

    @if ($url)
        onclick="window.location='{{ $url }}';"
        style="cursor:pointer"
    @endif
>
    {{ $slot }}
</tr>
