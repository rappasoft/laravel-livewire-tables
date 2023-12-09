@aware(['component', 'isTailwind', 'tableName'])

@php($emptyRowAttributes = $attributes->merge(['wire:key' => 'empty-table-row-'.$component->getId(), 'class' => 'livewire-tables-empty-row', 'default' => false])->getAttributes())

<x-livewire-tables::table.tr.plain :customAttributes="$emptyRowAttributes">
    <x-livewire-tables::table.td.plain colspan="{{ $this->getColspanCount() }}">
        <div @class(["flex justify-center items-center space-x-2 dark:bg-gray-800" => $isTailwind])>
            <span @class(["font-medium py-8 text-gray-400 text-lg dark:text-white" => $isTailwind])>
                {{ $this->getEmptyMessage() }}
            </span>
        </div>
    </x-livewire-tables::table.td.plain>
</x-livewire-tables::table.tr.plain>
