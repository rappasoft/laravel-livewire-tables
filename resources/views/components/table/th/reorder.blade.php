@aware(['component', 'tableName'])

<x-livewire-tables::table.th.plain wire:key="{{ $tableName }}-thead-reorder" x-show="currentlyReorderingStatus" />
