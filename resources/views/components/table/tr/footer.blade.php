@aware(['component'])
@props(['rows'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getFooterTrAttributes($rows)"
    :key="$this->getTableName().'-footer'"

>
<x-livewire-tables::table.td.plain  :key="$this->getTableName().'-footer-hidden-test'"  />

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
            <x-livewire-tables::table.td.row-contents x-show="!currentlyReorderingStatus" rowIndex="-1" :hidden="true" :key="$this->getTableName().'-footer-collapse'" />
            <x-livewire-tables::table.td.plain x-show="currentlyReorderingStatus" :key="$this->getTableName().'-footer-collapse-reorder'"  />
    @endif

    @foreach($this->getColumns() as $colIndex => $column)
        @continue($column->isHidden())
        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))
        @if($column->isReorderColumn())
            <x-livewire-tables::table.td.plain :column="$column" x-show="currentlyReorderingStatus || !hideReorderColumnUnlessReorderingStatus" :key="$this->getTableName().'-footer-'.$colIndex.'-show'"   :customAttributes="$this->getFooterTdAttributes($column, $rows, $colIndex)" />                

        @else

            <x-livewire-tables::table.td.plain x-show="!currentlyReorderingStatus" :key="$this->getTableName().'-footer-shown-'.$colIndex" :column="$column" :customAttributes="$this->getFooterTdAttributes($column, $rows, $colIndex)">
                {{ $column->getFooterContents($rows) }}
            </x-livewire-tables::table.td.plain>
            <x-livewire-tables::table.td.plain x-show="currentlyReorderingStatus" :key="$this->getTableName().'-footer-hidden-'.$colIndex"  />
        @endif


    @endforeach
</x-livewire-tables::table.tr.plain>
