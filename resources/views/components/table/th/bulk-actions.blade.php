@aware(['component'])

@if ($component->bulkActionsAreEnabled() && $component->hasBulkActions())
    @php
        $theme = $component->getTheme();
    @endphp

    <x-livewire-tables::table.th.plain>
        <div
            x-data="{ bulkActionHeaderChecked: false}"  
            x-init="$watch('selectedItems', value => bulkActionHeaderChecked = (value.length === totalItemCount))"
            @class([
                'inline-flex rounded-md shadow-sm' => $theme === 'tailwind',
                'form-check' => $theme === 'bootstrap-5',
                ])
        >
            <input 
                x-model="bulkActionHeaderChecked"
                x-on:click="toggleSelectAll"
                type="checkbox"
                @class([
                    'rounded border-gray-300 text-indigo-600 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600' => $theme === 'tailwind',
                    'form-check-input' => $theme === 'bootstrap-5',
                ])
            />
        </div>
    </x-livewire-tables::table.th.plain>
@endif
