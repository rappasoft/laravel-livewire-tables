@aware(['component', 'tableName'])

<x-livewire-tables::table.th.plain
    x-show="currentlyReorderingStatus"
    wire:key="{{ $tableName }}-thead-reorder"
/>
