@aware(['component'])
@props(['rows'])


<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getSecondaryHeaderTrAttributes($rows)"
    wire:key="secondary-header-{{ $this->getTableName() }}"
>

    @if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
        <x-livewire-tables::table.td.plain />
    @endif

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
        <x-livewire-tables::table.td.row-contents rowIndex="-1" :hidden="true" />
    @endif

    @foreach($this->getColumns() as $colIndex => $column)
        @continue($column->isHidden())
        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))
        @if($column->isReorderColumn())
        <x-livewire-tables::table.td.plain :column="$column" x-show="reorderDisplayColumn" :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)">
            {{ $column->getSecondaryHeaderContents($rows) }}
        </x-livewire-tables::table.td.plain>
        @else
        <x-livewire-tables::table.td.plain :column="$column" :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)">
            {{ $column->getSecondaryHeaderContents($rows) }}
        </x-livewire-tables::table.td.plain>
        @endif

    @endforeach
</x-livewire-tables::table.tr.plain>
