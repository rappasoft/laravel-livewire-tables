@aware([ 'row', 'rowIndex', 'tableName', 'primaryKey','isTailwind','isBootstrap'])
@props(['column', 'colIndex'])

@php
    $customAttributes = $this->getTdAttributesBag($column, $row, $colIndex, $rowIndex)
@endphp

<td {{
            $customAttributes->merge()
                ->class(['px-6 py-4 whitespace-nowrap text-sm font-medium' => $isTailwind && ($customAttributes['default-styling'] ?? ($customAttributes['default'] ?? true))])
                ->class(['dark:text-white' => $isTailwind && ($customAttributes['default-colors'] ?? ($customAttributes['default'] ?? true))])
                ->class(['hidden' =>  $isTailwind && $column && $column->shouldCollapseAlways()])
                ->class(['hidden md:table-cell' => $isTailwind && $column && $column->shouldCollapseOnMobile()])
                ->class(['hidden lg:table-cell' => $isTailwind && $column && $column->shouldCollapseOnTablet()])
                ->class(['' => $isBootstrap && ($customAttributes['default'] ?? true)])
                ->class(['d-none' => $isBootstrap && $column && $column->shouldCollapseAlways()])
                ->class(['d-none d-md-table-cell' => $isBootstrap && $column && $column->shouldCollapseOnMobile()])
                ->class(['d-none d-lg-table-cell' => $isBootstrap && $column && $column->shouldCollapseOnTablet()])
                ->class(['laravel-livewire-tables-cursor' => $isBootstrap && $column && $column->isClickable()])
                ->except(['default','default-styling','default-colors'])
        }}>
    {{ $slot }}
</td>
