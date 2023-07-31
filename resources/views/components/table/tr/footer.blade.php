@aware(['component'])
@props(['rows'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getFooterTrAttributes($rows)"
    wire:key="footer-{{ $this->getTableName() }}"

>
    <x-livewire-tables::table.td.plain x-show="reorderCurrentStatus" />

    @if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
        <x-livewire-tables::table.td.plain x-show="!reorderCurrentStatus" />
    @endif

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
        <x-livewire-tables::table.td.row-contents x-show="!reorderCurrentStatus" rowIndex="-1" :hidden="true" />
    @endif

    @foreach($this->getColumns() as $colIndex => $column)
        @continue($column->isHidden())
        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))
        <x-livewire-tables::table.td.plain x-show="reorderCurrentStatus" />

        <x-livewire-tables::table.td.plain x-show="!reorderCurrentStatus" :column="$column" :customAttributes="$this->getFooterTdAttributes($column, $rows, $colIndex)">
            {{ $column->getFooterContents($rows) }}
        </x-livewire-tables::table.td.plain>
    @endforeach
</x-livewire-tables::table.tr.plain>
