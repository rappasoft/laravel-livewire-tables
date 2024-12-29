@aware([ 'tableName','primaryKey'])
@props(['row', 'rowIndex'])

@php
    $customAttributes = $this->getBulkActionsTdAttributesNew($row->{$primaryKey});
    $bulkActionsTdCheckboxAttributes = $this->getBulkActionsTdCheckboxAttributesNew($row->{$primaryKey});
@endphp

@if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
    <x-livewire-tables::table.td.plain  :$customAttributes>
        <div @class([
            'inline-flex rounded-md shadow-sm' => $this->isTailwind,
            'form-check' => $this->isBootstrap,
        ])>
            <input {{
                    $attributes->merge($bulkActionsTdCheckboxAttributes)->class([
                        'rounded shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50' => $this->isTailwind && (($bulkActionsTdCheckboxAttributes['default'] ?? true) || ($bulkActionsTdCheckboxAttributes['default-styling'] ?? true)),
                        'border-gray-300 text-indigo-600 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600' => $this->isTailwind && (($bulkActionsTdCheckboxAttributes['default'] ?? true) || ($bulkActionsTdCheckboxAttributes['default-colors'] ?? true)),
                        'form-check-input' => $this->isBootstrap && ($bulkActionsTdCheckboxAttributes['default'] ?? true),
                    ])->except(['default','default-styling','default-colors'])
                }} />
        </div>
    </x-livewire-tables::table.td.plain>
@endif
