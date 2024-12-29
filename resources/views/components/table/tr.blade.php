@aware([ 'tableName','primaryKey','isTailwind','isBootstrap'])
@props(['row', 'rowIndex'])

@php
    $customAttributes = $this->getTrAttributesBag($row, $rowIndex);
@endphp

<tr {{
        $customAttributes->merge()
                ->class(['bg-white dark:bg-gray-700 dark:text-white rappasoft-striped-row' => ($isTailwind && ($customAttributes['default'] ?? true) && $rowIndex % 2 === 0)])
                ->class(['bg-gray-50 dark:bg-gray-800 dark:text-white rappasoft-striped-row' => ($isTailwind && ($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0)])
                ->class(['cursor-pointer' => ($isTailwind && $this->hasTableRowUrl() && ($customAttributes['default'] ?? true))])
                ->class(['bg-light rappasoft-striped-row' => ($isBootstrap && $rowIndex % 2 === 0 && ($customAttributes['default'] ?? true))])
                ->class(['bg-white rappasoft-striped-row' => ($isBootstrap && $rowIndex % 2 !== 0 && ($customAttributes['default'] ?? true))])
                ->except(['default','default-styling','default-colors'])
    }}>
    {{ $slot }}
</tr>
