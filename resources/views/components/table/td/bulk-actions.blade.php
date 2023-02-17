@aware(['component'])
@props(['row'])

@if ($component->bulkActionsAreEnabled() && $component->hasBulkActions())
    @php
        $theme = $component->getTheme();
        $customAttributesTD = $this->getBulkSelectionsTdAttributes();
        $customAttributes['bulkcontainer'] = $this->getBulkSelectionsContainerAttributes();
        $customAttributes['bulkinput'] = $this->getBulkSelectionsInputAttributes();
    @endphp

    @if ($theme === 'tailwind')
        <x-livewire-tables::table.td.plain :customAttributes=$customAttributesTD>
            <div
                {{ $attributes->merge($customAttributes['bulkcontainer'])->class(['inline-flex rounded-md shadow-sm' => $customAttributes['bulkcontainer']['default'] ?? true])->except('default') }}>
                <input wire:model="selected" wire:loading.attr.delay="disabled"
                    value="{{ $row->{$this->getPrimaryKey()} }}" type="checkbox"
                    {{ $attributes->merge($customAttributes['bulkinput'])->class(['rounded border-gray-300 text-indigo-600 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600' => $customAttributes['bulkinput']['default'] ?? true])->except('default') }} />
            </div>
        </x-livewire-tables::table.td.plain>
    @elseif ($theme === 'bootstrap-4')
        <x-livewire-tables::table.td.plain :customAttributes=$customAttributesTD>
            <input wire:model="selected" wire:loading.attr.delay="disabled" value="{{ $row->{$this->getPrimaryKey()} }}"
                type="checkbox" />
        </x-livewire-tables::table.td.plain>
    @elseif ($theme === 'bootstrap-5')
        <x-livewire-tables::table.td.plain :customAttributes=$customAttributesTD>
            <div
                {{ $attributes->merge($customAttributes['bulkcontainer'])->class(['form-check' => $customAttributes['bulkcontainer']['default'] ?? true])->except('default') }}>
                <input wire:model="selected" wire:loading.attr.delay="disabled"
                    value="{{ $row->{$this->getPrimaryKey()} }}" type="checkbox"
                    {{ $attributes->merge($customAttributes['bulkinput'])->class(['form-check-input' => $customAttributes['bulkinput']['default'] ?? true])->except('default') }} />
                />
            </div>
        </x-livewire-tables::table.td.plain>
    @endif
@endif
