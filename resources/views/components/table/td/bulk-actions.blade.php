@aware([ 'tableName','primaryKey', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5'])
@props(['row', 'rowIndex'])

@php
    $customAttributes = $this->getBulkActionsTdAttributes();
    $bulkActionsTdCheckboxAttributes = $this->getBulkActionsTdCheckboxAttributes();
@endphp

@if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
    <x-livewire-tables::table.td.plain wire:key="{{ $tableName }}-tbody-td-bulk-actions-td-{{ $row->{$primaryKey} }}" :displayMinimisedOnReorder="true"  :$customAttributes>
        <div @class([
            'inline-flex rounded-md shadow-sm' => $isTailwind,
            'form-check' => $isBootstrap5,
        ])>
            <input wire:key="{{ $tableName . 'selectedItems-'.$row->{$primaryKey} }}" 
                value="{{ $row->{$primaryKey} }}"
                {{
                    $attributes->merge($bulkActionsTdCheckboxAttributes)->class([
                        'border-gray-300 text-indigo-600 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600' => ($isTailwind) && (($bulkActionsTdCheckboxAttributes['default'] ?? true) || ($bulkActionsTdCheckboxAttributes['default-colors'] ?? true)),
                        'rounded shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50' => ($isTailwind) && (($bulkActionsTdCheckboxAttributes['default'] ?? true) || ($bulkActionsTdCheckboxAttributes['default-styling'] ?? true)),
                        'form-check-input' => ($isBootstrap5) && ($bulkActionsTdCheckboxAttributes['default'] ?? true),
                    ])->except(['default','default-styling','default-colors'])
                }}
            />
        </div>
    </x-livewire-tables::table.td.plain>
@endif
