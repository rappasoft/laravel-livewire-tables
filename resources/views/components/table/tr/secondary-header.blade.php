@aware(['component', 'tableName'])
@props(['rows'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getSecondaryHeaderTrAttributes($rows)"
    wire:key="{{ $tableName .'-secondary-header' }}"
>        
<x-livewire-tables::table.td.plain x-show="currentlyReorderingStatus" wire:key="{{ $tableName .'-header-test' }}" />

    @if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
        <x-livewire-tables::table.td.plain wire:key="{{ $tableName .'-header-hasBulkActions' }}" />
    @endif

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
            <x-livewire-tables::table.td.row-contents  wire:key="{{ $tableName .'header-collapsed-hide' }}" rowIndex="-1"  />

    @endif

    @foreach($this->getColumns() as $colIndex => $column)
        @continue($column->isHidden())
        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

        @if($column->isReorderColumn())
            <x-livewire-tables::table.td.plain :column="$column" x-show="currentlyReorderingStatus || !hideReorderColumnUnlessReorderingStatus" wire:key="{{ $tableName .'-secondaryheader-reorder-show' }}"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)" />                
        @else
            <x-livewire-tables::table.td.plain :column="$column" x-show="!currentlyReorderingStatus" wire:key="{{ $tableName .'-secondaryheader-show-'.$colIndex }}"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)">
                {{ $column->getSecondaryHeaderContents($rows) }}
            </x-livewire-tables::table.td.plain>
            <x-livewire-tables::table.td.plain :column="$column" x-show="currentlyReorderingStatus" wire:key="{{ $tableName .'-secondaryheader-blank-'.$colIndex }}" />                

        @endif
    @endforeach
</x-livewire-tables::table.tr.plain>
