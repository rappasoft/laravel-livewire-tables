@aware(['component'])
@props(['rows'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getSecondaryHeaderTrAttributes($rows)"
    :key="$this->getTableName().'-secondary-header'"
>        
<x-livewire-tables::table.td.plain x-show="currentlyReorderingStatus" :key="$this->getTableName().'-header-test'" />

    @if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
        <x-livewire-tables::table.td.plain :key="$this->getTableName().'-header-hasBulkActions'" />
    @endif

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
            <x-livewire-tables::table.td.row-contents  :key="$this->getTableName().'header-collapsed-hide'" rowIndex="-1"  />

    @endif

    @foreach($this->getColumns() as $colIndex => $column)
        @continue($column->isHidden())
        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

        @if($column->isReorderColumn())
            <x-livewire-tables::table.td.plain :column="$column" x-show="currentlyReorderingStatus || !hideReorderColumnUnlessReorderingStatus" :key="$this->getTableName().'-secondaryheader-reorder-show'"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)" />                
        @else
            <x-livewire-tables::table.td.plain :column="$column" x-show="!currentlyReorderingStatus" :key="$this->getTableName().'-secondaryheader-show-'.$colIndex"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)">
                {{ $column->getSecondaryHeaderContents($rows) }}
            </x-livewire-tables::table.td.plain>
            <x-livewire-tables::table.td.plain :column="$column" x-show="currentlyReorderingStatus" :key="$this->getTableName().'-secondaryheader-blank-'.$colIndex" />                

        @endif
    @endforeach
</x-livewire-tables::table.tr.plain>
