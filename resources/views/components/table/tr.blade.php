@aware(['primaryKey'])
@props(['row', 'rowIndex'])

@php
    $customAttributes = $this->getTrAttributes($row, $rowIndex);
@endphp

<tr
    rowpk='{{ $row->{$primaryKey} }}'
    x-on:dragstart.self="currentlyReorderingStatus && dragStart(event)"
    x-on:drop.prevent="currentlyReorderingStatus && dropEvent(event)"
    x-on:dragover.prevent.throttle.500ms="currentlyReorderingStatus && dragOverEvent(event)"
    x-on:dragleave.prevent.throttle.500ms="currentlyReorderingStatus && dragLeaveEvent(event)"
    @if($this->hasDisplayLoadingPlaceholder) 
    wire:loading.remove
    @else
    wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
    @endif
    id="{{ $this->getTableName }}-row-{{ $row->{$primaryKey} }}"
    :draggable="currentlyReorderingStatus"
    wire:key="{{ $this->getTableName }}-tablerow-tr-{{ $row->{$primaryKey} }}"
    loopType="{{ ($rowIndex % 2 === 0) ? 'even' : 'odd' }}"
    {{
        $attributes->merge($customAttributes)
                ->class(['bg-white dark:bg-gray-700 dark:text-white rappasoft-striped-row' => ($this->isTailwind && ($customAttributes['default'] ?? true) && $rowIndex % 2 === 0)])
                ->class(['bg-gray-50 dark:bg-gray-800 dark:text-white rappasoft-striped-row' => ($this->isTailwind && ($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0)])
                ->class(['cursor-pointer' => ($this->isTailwind && $this->hasTableRowUrl && ($customAttributes['default'] ?? true))])
                ->class(['bg-light rappasoft-striped-row' => ($this->isBootstrap && $rowIndex % 2 === 0 && ($customAttributes['default'] ?? true))])
                ->class(['bg-white rappasoft-striped-row' => ($this->isBootstrap && $rowIndex % 2 !== 0 && ($customAttributes['default'] ?? true))])
                ->except(['default'])
    }}

>
    {{ $slot }}
</tr>
