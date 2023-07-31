@aware(['component'])
@props(['row', 'rowIndex'])

@php
    $attributes = $attributes->merge(['wire:key' => 'row-'.$rowIndex.'-'.$component->getId()]);
    $customAttributes = $this->getTrAttributes($row, $rowIndex);
@endphp

<tr
    rowpk='{{ $row->{$this->getPrimaryKey()} }}'
    x-on:dragstart.self="dragStart(event)"
    x-on:drop="dropEvent(event)"
    x-on:drop.prevent="dropPreventEvent(event)"
    x-on:dragover.prevent="removing = true"
    x-on:dragleave.prevent="removing = false"
    wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
    id="{{ $component->getTableName() .'-row-'.$row->{$this->getPrimaryKey()} }}"
    draggable="true"

    @class([
        'bg-white dark:bg-gray-700 dark:text-white' => ($component->isTailwind() &&
        ($customAttributes['default'] ?? true) && $rowIndex % 2 === 0),
        'bg-gray-50 dark:bg-gray-800 dark:text-white' => ($component->isTailwind() && ($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0),
        'cursor-pointer' => ($component->isTailwind() && $component->hasTableRowUrl()),
        'bg-light' => ($component->isBootstrap() && $rowIndex % 2 === 0),
        'bg-white' => ($component->isBootstrap() && $rowIndex % 2 !== 0),
    ])
>
    {{ $slot }}
</tr>
