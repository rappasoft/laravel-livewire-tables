@aware(['component'])
@props(['row'])

@if ($component->bulkActionsAreEnabled() && $component->hasBulkActions())
    @php
        $theme = $component->getTheme();
    @endphp

    @if ($theme === 'tailwind')
        <x-livewire-tables::table.td.plain>
            <div class="inline-flex rounded-md shadow-sm">
                <input
                    wire:model="selected.{{ $row->{$this->getPrimaryKey()} }}"
                    wire:loading.attr.delay="disabled"
                    value="true"
                    type="checkbox"
                    class="text-indigo-600 transition duration-150 ease-in-out border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600"
                />
            </div>
        </x-livewire-tables::table.td.plain>
    @elseif ($theme === 'bootstrap-4')
        <x-livewire-tables::table.td.plain>
            <input
                wire:model="selected.{{ $row->{$this->getPrimaryKey()} }}"
                wire:loading.attr.delay="disabled"
                value="true"
                type="checkbox"
            />
        </x-livewire-tables::table.td.plain>
    @elseif ($theme === 'bootstrap-5')
        <x-livewire-tables::table.td.plain>
            <div class="form-check">
                <input
                    wire:model="selected.{{ $row->{$this->getPrimaryKey()} }}"
                    wire:loading.attr.delay="disabled"
                    value="true"
                    type="checkbox"
                    class="form-check-input"
                />
            </div>
        </x-livewire-tables::table.td.plain>
    @endif
@endif
