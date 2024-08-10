@aware(['component', 'row', 'rowIndex', 'tableName', 'primaryKey','isTailwind','isBootstrap'])
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
                ->class(['px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true)])
                ->class(['hidden' =>  $isTailwind && $column && $column->shouldCollapseAlways()])
                ->class(['hidden md:table-cell' => $isTailwind && $column && $column->shouldCollapseOnMobile()])
                ->class(['hidden lg:table-cell' => $isTailwind && $column && $column->shouldCollapseOnTablet()])
                ->class(['' => $isBootstrap && ($customAttributes['default'] ?? true)])
                ->class(['d-none' => $isBootstrap && $column && $column->shouldCollapseAlways()])
                ->class(['d-none d-md-table-cell' => $isBootstrap && $column && $column->shouldCollapseOnMobile()])
                ->class(['d-none d-lg-table-cell' => $isBootstrap && $column && $column->shouldCollapseOnTablet()])
                ->class(['laravel-livewire-tables-cursor' => $isBootstrap && $column && $column->isClickable()])
                ->except('default')
        }}
    >
        {{ $slot }}
</td>
