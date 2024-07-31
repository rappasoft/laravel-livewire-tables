@aware(['component', 'tableName'])
@props(['rows', 'filterGenericData', 'selectedVisibleColumns'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getSecondaryHeaderTrAttributes($rows)"
    wire:key="{{ $tableName .'-secondary-header' }}"
>
    {{-- TODO: Remove --}}
    <x-livewire-tables::table.td.plain x-cloak x-show="currentlyReorderingStatus" :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-header-test' }}" />

    @if ($this->showBulkActionsSections)
        <x-livewire-tables::table.td.plain :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-header-hasBulkActions' }}" />
    @endif

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
        <x-livewire-tables::table.td.collapsed-columns :hidden=true :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'header-collapsed-hide' }}" rowIndex="-1"  />
    @endif

    @foreach($selectedVisibleColumns as $colIndex => $column)
        <x-livewire-tables::table.td.plain :column="$column" :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-secondary-header-show-'.$column->getSlug() }}"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)">
            {{ $column->getSecondaryHeaderContents($rows, $filterGenericData) }}
        </x-livewire-tables::table.td.plain>
    @endforeach
</x-livewire-tables::table.tr.plain>
