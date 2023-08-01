@aware(['component', 'tableName'])
@props(['row', 'rowIndex'])

@php
    $attributes = $attributes->merge(['wire:key' => 'row-'.$rowIndex.'-'.$component->getId()]);
    $customAttributes = $this->getTrAttributes($row, $rowIndex);
@endphp

<tr
    rowpk='{{ $row->{$this->getPrimaryKey()} }}'
    x-on:dragstart.self="reorderCurrentStatus && dragStart(event)"
    x-on:drop.prevent="reorderCurrentStatus && dropEvent(event)"
    x-on:dragover.prevent.throttle.250ms="reorderCurrentStatus && dragOverEvent(event)"
    wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
    id="{{ $tableName }}-row-{{ $row->{$this->getPrimaryKey()} }}"
    :draggable="reorderCurrentStatus"

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
