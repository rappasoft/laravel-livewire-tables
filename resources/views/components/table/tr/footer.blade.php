@aware(['component'])
@props(['rows'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getFooterTrAttributes($rows)"
    wire:key="footer-{{ $this->getTableName() }}"

>
    <template x-if="reorderCurrentStatus">
        <x-livewire-tables::table.td.plain  />
    </template>


    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
        <template x-if="!reorderCurrentStatus">
            <x-livewire-tables::table.td.row-contents  rowIndex="-1" :hidden="true" />
        </template>

    @endif

    @foreach($this->getColumns() as $colIndex => $column)
        @continue($column->isHidden())
        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))
        <template x-if="reorderCurrentStatus">
            <x-livewire-tables::table.td.plain  />
        </template>
        <template x-if="!reorderCurrentStatus">

            <x-livewire-tables::table.td.plain :column="$column" :customAttributes="$this->getFooterTdAttributes($column, $rows, $colIndex)">
                {{ $column->getFooterContents($rows) }}
            </x-livewire-tables::table.td.plain>
        </template>

    @endforeach
</x-livewire-tables::table.tr.plain>
