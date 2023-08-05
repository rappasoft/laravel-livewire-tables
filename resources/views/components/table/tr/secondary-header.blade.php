@aware(['component', 'tableName'])
@props(['rows'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getSecondaryHeaderTrAttributes($rows)"
    wire:key="{{ $tableName .'-secondary-header' }}"
>
    {{-- TODO: Remove --}}
    <x-livewire-tables::table.td.plain x-cloak x-show="currentlyReorderingStatus" :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-header-test' }}" />

    @if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
        <x-livewire-tables::table.td.plain :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-header-hasBulkActions' }}" />
    @endif

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
        <x-livewire-tables::table.td.row-contents :hidden=true :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'header-collapsed-hide' }}" rowIndex="-1"  />
    @endif

    @foreach($this->getColumns() as $colIndex => $column)
        @continue($column->isHidden())
        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

        @if($column->isReorderColumn())
            <x-livewire-tables::table.td.plain :column="$column" :displayMinimisedOnReorder="false"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)" />
        @else
            <x-livewire-tables::table.td.plain :column="$column" :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-secondary-header-show-'.$column->getSlug() }}"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)">
                {{ $column->getSecondaryHeaderContents($rows) }}
            </x-livewire-tables::table.td.plain>
        @endif
    @endforeach
</x-livewire-tables::table.tr.plain>
