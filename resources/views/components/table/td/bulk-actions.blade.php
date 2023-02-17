@aware(['component', 'row', 'rowIndex'])
@props(['row'])

@if ($component->bulkActionsAreEnabled() && $component->hasBulkActions())
    @php
        $theme = $component->getTheme();
        $attributes = $attributes->merge(['wire:key' => 'cell-' . $rowIndex . '-0-' . $component->id]);
        $theme = $component->getTheme();
        $customAttributes['bulkactions'] = $this->getBulkSelectionsTdAttributes();
    @endphp

    @if ($theme === 'tailwind')
        <x-livewire-tables::table.td.plain
            {{ $attributes->merge($customAttributes['bulkactions'])->class(['' => $customAttributes['bulkactions']['default'] ?? true])->except('default') }}>
            <div class="inline-flex rounded-md shadow-sm">
                <input wire:model="selected" wire:loading.attr.delay="disabled"
                    value="{{ $row->{$this->getPrimaryKey()} }}" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600" />
            </div>
        </x-livewire-tables::table.td.plain>
    @elseif ($theme === 'bootstrap-4')
        <x-livewire-tables::table.td.plain
            {{ $attributes->merge($customAttributes['bulkactions'])->class(['' => $customAttributes['bulkactions']['default'] ?? true])->except('default') }}>

            <input wire:model="selected" wire:loading.attr.delay="disabled" value="{{ $row->{$this->getPrimaryKey()} }}"
                type="checkbox" />
        </x-livewire-tables::table.td.plain>
    @elseif ($theme === 'bootstrap-5')
        <x-livewire-tables::table.td.plain
            {{ $attributes->merge($customAttributes['bulkactions'])->class(['' => $customAttributes['bulkactions']['default'] ?? true])->except('default') }}>

            <div class="form-check">
                <input wire:model="selected" wire:loading.attr.delay="disabled"
                    value="{{ $row->{$this->getPrimaryKey()} }}" type="checkbox" class="form-check-input" />
            </div>
        </x-livewire-tables::table.td.plain>
    @endif
@endif
