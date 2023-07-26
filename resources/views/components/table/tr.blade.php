@aware(['component'])
@props(['row', 'rowIndex'])

@php
    $attributes = $attributes->merge(['wire:key' => 'row-'.$rowIndex.'-'.$component->getId()]);
    $theme = $component->getTheme();
    $customAttributes = $this->getTrAttributes($row, $rowIndex);
@endphp

<tr
    wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"

    @if ($component->reorderIsEnabled() && $component->currentlyReorderingIsEnabled())
        wire:sortable.item="{{ $row->getKey() }}"
    @endif

    @class([
        'bg-white dark:bg-gray-700 dark:text-white' => $theme === 'tailwind' && ($customAttributes['default'] ?? true) && $rowIndex % 2 === 0,
        'bg-gray-50 dark:bg-gray-800 dark:text-white' => $theme === 'tailwind' && ($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0,
        'cursor-pointer' => $theme === 'tailwind' && $component->hasTableRowUrl(),
        'bg-white' => ($theme === 'bootstrap-4' || $theme === 'bootstrap-5') && ($customAttributes['default'] ?? true) && $rowIndex % 2 === 0,
        'bg-gray-700' => ($theme === 'bootstrap-4' || $theme === 'bootstrap-5') && ($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0,

    ])
>
    {{ $slot }}
</tr>
