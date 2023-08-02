@aware(['component', 'tableName'])
@props(['row', 'rowIndex'])

@php
    $customAttributes = $this->getTrAttributes($row, $rowIndex);
@endphp

<tr
    rowpk='{{ $row->{$this->getPrimaryKey()} }}'
    x-on:dragstart.self="currentlyReorderingStatus && dragStart(event)"
    x-on:drop.prevent="currentlyReorderingStatus && dropEvent(event)"
    x-on:dragover.prevent.throttle.500ms="currentlyReorderingStatus && dragOverEvent(event)"
    x-on:dragleave.prevent.throttle.500ms="currentlyReorderingStatus && dragLeaveEvent(event)"
    wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
    id="{{ $tableName }}-row-{{ $row->{$this->getPrimaryKey()} }}"
    :draggable="currentlyReorderingStatus"
    wire:key="{{ $tableName }}-tablerow-tr-{{ $row->{$this->getPrimaryKey()} }}"
    loopType="{{ ($rowIndex % 2 === 0) ? 'even' : 'odd' }}"

    @class([
        'bg-white dark:bg-gray-700 dark:text-white rappasoft-striped-row' => ($component->isTailwind() && ($customAttributes['default'] ?? true) && $rowIndex % 2 === 0),
        'bg-gray-50 dark:bg-gray-800 dark:text-white rappasoft-striped-row' => ($component->isTailwind() && ($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0),
        'cursor-pointer' => ($component->isTailwind() && $component->hasTableRowUrl()),
        'bg-light rappasoft-striped-row' => ($component->isBootstrap() && $rowIndex % 2 === 0),
        'bg-white rappasoft-striped-row' => ($component->isBootstrap() && $rowIndex % 2 !== 0),
    ])
>
    {{ $slot }}
</tr>
