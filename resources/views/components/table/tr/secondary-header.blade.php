@aware(['component'])
@props(['rows'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getSecondaryHeaderTrAttributes($rows)"
    wire:key="secondary-header-{{ $this->getTableName() }}"
>        
    <template x-if="reorderDisplayColumn && reorderCurrentStatus">
        <x-livewire-tables::table.td.plain />
    </template>

    @if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
        <template x-if="!reorderCurrentStatus">
            <x-livewire-tables::table.td.plain />
        </template>

    @endif

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
        <template x-if="!reorderCurrentStatus">

            <x-livewire-tables::table.td.row-contents rowIndex="-1" :hidden="true" />
        </template>

    @endif

    @foreach($this->getColumns() as $colIndex => $column)
        @continue($column->isHidden())
        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

        @if($column->isReorderColumn())
        <template x-if="reorderDisplayColumn">
            <x-livewire-tables::table.td.plain :column="$column" :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)">
                {{ $column->getSecondaryHeaderContents($rows) }}
            </x-livewire-tables::table.td.plain>
        </template>
        @else
            <x-livewire-tables::table.td.plain :column="$column" :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)">
                {{ $column->getSecondaryHeaderContents($rows) }}
            </x-livewire-tables::table.td.plain>
        @endif
    @endforeach
</x-livewire-tables::table.tr.plain>
