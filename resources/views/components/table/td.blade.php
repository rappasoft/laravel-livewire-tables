@aware(['row', 'rowIndex', 'primaryKey'])
@props(['column', 'colIndex'])

@php
    $customAttributes = $this->getTdAttributes($column, $row, $colIndex, $rowIndex)
@endphp

<td wire:key="{{ $this->getTableName . '-table-td-'.$row->{$primaryKey}.'-'.$column->getSlug() }}"
    @if ($column->isClickable())
        @if($this->getTableRowUrlTarget($row) === "navigate") wire:navigate href="{{ $this->getTableRowUrl($row) }}"
        @else onclick="window.open('{{ $this->getTableRowUrl($row) }}', '{{ $this->getTableRowUrlTarget($row) ?? '_self' }}')"
        @endif
    @endif
        {{
            $attributes->merge($customAttributes)
                ->class(['px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $this->isTailwind && ($customAttributes['default'] ?? true)])
                ->class(['hidden' =>  $this->isTailwind && $column && $column->shouldCollapseAlways()])
                ->class(['hidden md:table-cell' => $this->isTailwind && $column && $column->shouldCollapseOnMobile()])
                ->class(['hidden lg:table-cell' => $this->isTailwind && $column && $column->shouldCollapseOnTablet()])
                ->class(['' => $this->isBootstrap && ($customAttributes['default'] ?? true)])
                ->class(['d-none' => $this->isBootstrap && $column && $column->shouldCollapseAlways()])
                ->class(['d-none d-md-table-cell' => $this->isBootstrap && $column && $column->shouldCollapseOnMobile()])
                ->class(['d-none d-lg-table-cell' => $this->isBootstrap && $column && $column->shouldCollapseOnTablet()])
                ->class(['laravel-livewire-tables-cursor' => $this->isBootstrap && $column && $column->isClickable()])
                ->except('default')
        }}
    >
        {{ $slot }}
</td>
