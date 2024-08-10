@aware(['component', 'row', 'rowIndex', 'tableName', 'primaryKey'])
@props(['column', 'colIndex'])

@php
    $customAttributes = $component->getTdAttributes($column, $row, $colIndex, $rowIndex)
@endphp

<td wire:key="{{ $tableName . '-table-td-'.$row->{$primaryKey}.'-'.$column->getSlug() }}"
    @if ($column->isClickable())
        @if($component->getTableRowUrlTarget($row) === "navigate") wire:navigate href="{{ $component->getTableRowUrl($row) }}"
        @else onclick="window.open('{{ $component->getTableRowUrl($row) }}', '{{ $component->getTableRowUrlTarget($row) ?? '_self' }}')"
        @endif
    @endif
        {{
            $attributes->merge($customAttributes)
                ->class(['px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $component->isTailwind() && ($customAttributes['default'] ?? true)])
                ->class(['hidden' =>  $component->isTailwind() && $column && $column->shouldCollapseAlways()])
                ->class(['hidden md:table-cell' => $component->isTailwind() && $column && $column->shouldCollapseOnMobile()])
                ->class(['hidden lg:table-cell' => $component->isTailwind() && $column && $column->shouldCollapseOnTablet()])
                ->class(['' => $component->isBootstrap() && ($customAttributes['default'] ?? true)])
                ->class(['d-none' => $component->isBootstrap() && $column && $column->shouldCollapseAlways()])
                ->class(['d-none d-md-table-cell' => $component->isBootstrap() && $column && $column->shouldCollapseOnMobile()])
                ->class(['d-none d-lg-table-cell' => $component->isBootstrap() && $column && $column->shouldCollapseOnTablet()])
                ->class(['laravel-livewire-tables-cursor' => $component->isBootstrap() && $column && $column->isClickable()])
                ->except('default')
        }}
    >
        {{ $slot }}
</td>
