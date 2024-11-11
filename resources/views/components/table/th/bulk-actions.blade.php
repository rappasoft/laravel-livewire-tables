@aware(['component', 'tableName'])
@php
    $customAttributes = $this->hasBulkActionsThAttributes ? $this->getBulkActionsThAttributes : $this->getAllThAttributes($this->getBulkActionsColumn())['customAttributes'];

    $bulkActionsThCheckboxAttributes = $this->getBulkActionsThCheckboxAttributes();
    $theme = $this->getTheme();
@endphp

@if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
    <x-livewire-tables::table.th.plain wire:key="{{ $tableName }}-thead-bulk-actions" :displayMinimisedOnReorder="true" :$customAttributes>
        <div
            x-data="{newSelectCount: 0, indeterminateCheckbox: false, bulkActionHeaderChecked: false}"
            x-init="$watch('selectedItems', value => indeterminateCheckbox = (value.length > 0 && value.length < paginationTotalItemCount))"
            x-cloak x-show="currentlyReorderingStatus !== true"
            @class([
                'inline-flex rounded-md shadow-sm' => $theme === 'tailwind',
                'form-check' => $theme === 'bootstrap-5',
            ])
        >
            <input
                x-init="$watch('indeterminateCheckbox', value => $el.indeterminate = value); $watch('selectedItems', value => newSelectCount = value.length);"
                x-on:click="if(selectedItems.length == paginationTotalItemCount) { $el.indeterminate = false; $wire.clearSelected(); bulkActionHeaderChecked = false; } else { bulkActionHeaderChecked = true; $el.indeterminate = false; $wire.setAllSelected(); }"
                type="checkbox"
                :checked="selectedItems.length == paginationTotalItemCount"
                {{
                    $attributes->merge($bulkActionsThCheckboxAttributes)->class([
                        'text-indigo-600 transition duration-150 ease-in-out border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:checked:bg-indigo-500 dark:border-gray-600' => ($theme === 'tailwind') && ($bulkActionsThCheckboxAttributes['default'] ?? true),
                        'form-check-input' => ($theme === 'bootstrap-5') && ($bulkActionsThCheckboxAttributes['default'] ?? true),
                    ])->except(['default','default-styling','default-colors'])
                }}
            />
        </div>
    </x-livewire-tables::table.th.plain>
@endif
