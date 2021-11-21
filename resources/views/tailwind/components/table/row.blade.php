@props(['url' => null, 'target' => '_self', 'reordering' => false, 'customAttributes' => []])

@if (!$reordering && (method_exists($attributes, 'has') ? $attributes->has('wire:sortable.item') : array_key_exists('wire:sortable.item', $attributes->getAttributes())))
    @php
        $attributes = $attributes->filter(fn ($value, $key) => $key !== 'wire:sortable.item');
    @endphp
@endif

<tr
    {{ $attributes->merge($customAttributes)->merge(['class' => $url ? 'cursor-pointer' : '']) }}

    @if ($url)
        onclick="window.open('{{ $url }}', '{{ $target }}')"
    @endif
>
    {{ $slot }}
</tr>
