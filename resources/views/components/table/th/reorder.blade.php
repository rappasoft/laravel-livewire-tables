@aware(['component', 'tableName'])

<x-livewire-tables::table.th.plain wire:key="{{ $tableName }}-thead-reorder" :displayMinimisedOnReorder="false" >
<div x-show="currentlyReorderingStatus"></div>
</x-livewire-tables::table.th.plain>
