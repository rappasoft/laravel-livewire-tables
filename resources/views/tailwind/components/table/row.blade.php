@props(['url' => null, 'target' => '_self', 'reordering' => false, 'customAttributes' => []])

@if (!$reordering && $attributes->has('wire:sortable.item'))
    @php
        $attributes = $attributes->filter(fn ($value, $key) => $key !== 'wire:sortable.item');
    @endphp
@endif

<tr
    {{ $attributes->merge($customAttributes)->class(['cursor-pointer' => $url]) }}

    @if ($url)
        onclick="window.open('{{ $url }}', '{{ $target }}')"
    @endif
>
    {{ $slot }}
</tr>
