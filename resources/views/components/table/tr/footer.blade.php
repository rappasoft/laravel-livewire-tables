@aware(['component', 'tableName'])
@props(['rows'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getFooterTrAttributes($rows)"
    wire:key="{{ $tableName .'-footer' }}"
>
    {{-- TODO: Remove --}}
    <x-livewire-tables::table.td.plain x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $tableName . '-footer-hidden-test' }}" />

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
        <x-livewire-tables::table.td.row-contents :displayMinimisedOnReorder="true" rowIndex="-1" :hidden="true" wire:key="{{ $tableName.'-footer-collapse' }}" />
    @endif

    {{-- TODO: Remove --}}
    <x-livewire-tables::table.td.plain wire:key="{{ $tableName . '-footer-hidden-tes2t' }}" />

    @foreach($this->getColumns() as $colIndex => $column)
        @continue($column->isHidden())
        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

        @if($column->isReorderColumn())
            <x-livewire-tables::table.td.plain :column="$column" :displayMinimisedOnReorder="false"  wire:key="{{ $tableName .'-footer-'.$colIndex.'-show' }}"   :customAttributes="$this->getFooterTdAttributes($column, $rows, $colIndex)" />
        @else
            <x-livewire-tables::table.td.plain :displayMinimisedOnReorder="true"  wire:key="{{ $tableName .'-footer-shown-'.$colIndex }}" :column="$column" :customAttributes="$this->getFooterTdAttributes($column, $rows, $colIndex)">
                {{ $column->getFooterContents($rows) }}
            </x-livewire-tables::table.td.plain>
        @endif
    @endforeach
</x-livewire-tables::table.tr.plain>
