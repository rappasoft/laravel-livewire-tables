@props(['url' => null, 'target' => '_self', 'reordering' => false, 'customAttributes' => []])

@if (!$reordering && $attributes->has('wire:sortable.item'))
    @php
        $attributes = $attributes->filter(fn ($value, $key) => $key !== 'wire:sortable.item');
    @endphp
@endif

<tr
    $attributes->merge($customAttributes)->class([
        'h-auto block border-t-4 md:border-t-0 py-4 px-2 md:p-0 md:table-row w-screen',
        'cursor-pointer' => $url
    ]) }}

    @if ($url)
        onclick="window.open('{{ $url }}', '{{ $target }}')"
    @endif
>
    {{ $slot }}
</tr>
