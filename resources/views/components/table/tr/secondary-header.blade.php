@aware(['component'])
@props(['rows'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getSecondaryHeaderTrAttributes($rows)"
    wire:key="secondary-header-{{ $this->getTableName() }}"
>        

    @if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
        <x-livewire-tables::table.td.plain x-show="!reorderCurrentStatus" :key="'header-'.$this->getTableName().'-hasBulkActions'" />
    @endif

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
            <x-livewire-tables::table.td.row-contents x-show="!reorderCurrentStatus" :key="'header-'.$this->getTableName().'-collapsed'" rowIndex="-1"  />

    @endif

    @foreach($this->getColumns() as $colIndex => $column)
        @continue($column->isHidden())
        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

        @if($column->isReorderColumn())
            <x-livewire-tables::table.td.plain :column="$column" x-show="reorderDisplayColumn" :key="'secondaryheader-reorder'.$this->getTableName().'-'.$colIndex"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)" />                
        @else
            <x-livewire-tables::table.td.plain :column="$column" x-show="!reorderCurrentStatus" :key="'secondaryheader-show'.$this->getTableName().'-'.$colIndex"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)">
                {{ $column->getSecondaryHeaderContents($rows) }}
            </x-livewire-tables::table.td.plain>
            <x-livewire-tables::table.td.plain :column="$column" x-show="reorderCurrentStatus" :key="'secondaryheader-blank'.$this->getTableName().'-'.$colIndex" />                

        @endif
    @endforeach
</x-livewire-tables::table.tr.plain>
