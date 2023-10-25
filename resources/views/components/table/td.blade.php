@aware(['component', 'row', 'rowIndex', 'tableName'])
@props(['column', 'colIndex'])

@php
    $customAttributes = $component->getTdAttributes($column, $row, $colIndex, $rowIndex)
@endphp

@if ($component->isTailwind())
    <td wire:key="{{ $tableName . '-table-td-'.$row->{$this->getPrimaryKey()}.'-'.$column->getSlug() }}"
        @if ($column->isClickable())
            @if($component->getTableRowUrlTarget($row) === "navigate")
                wire:navigate
                href="{{ $component->getTableRowUrl($row) }}"
            @else
                onclick="window.open('{{ $component->getTableRowUrl($row) }}', '{{ $component->getTableRowUrlTarget($row) ?? '_self' }}')"
            @endif
        @endif

        {{
            $attributes->merge($customAttributes)
                ->class(['px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $customAttributes['default'] ?? true])
                ->class(['hidden' => $column && $column->shouldCollapseAlways()])
                ->class(['hidden sm:table-cell' => $column && $column->shouldCollapseOnMobile()])
                ->class(['hidden md:table-cell' => $column && $column->shouldCollapseOnTablet()])
                ->except('default')
        }}
    >
        {{ $slot }}
    </td>
@elseif ($component->isBootstrap())
    <td wire:key="{{ $tableName . '-table-td-'.$row->{$this->getPrimaryKey()}.'-'.$column->getSlug() }}"
        @if ($column->isClickable())
            @if($component->getTableRowUrlTarget($row) === "navigate")
                wire:navigate
                href="{{ $component->getTableRowUrl($row) }}"
            @else
                onclick="window.open('{{ $component->getTableRowUrl($row) }}', '{{ $component->getTableRowUrlTarget($row) ?? '_self' }}')"
            @endif

            style="cursor:pointer"
        @endif


        {{
            $attributes->merge($customAttributes)
                ->class(['' => $customAttributes['default'] ?? true])
                ->class(['d-none' => $column && $column->shouldCollapseAlways()])
                ->class(['d-none d-sm-table-cell' => $column && $column->shouldCollapseOnMobile()])
                ->class(['d-none d-md-table-cell' => $column && $column->shouldCollapseOnTablet()])
                ->except('default')
        }}
    >
        {{ $slot }}
    </td>
@endif
