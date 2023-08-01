@aware(['component', 'tableName'])
@props(['rows'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getSecondaryHeaderTrAttributes($rows)"
    wire:key="{{ $tableName .'-secondary-header' }}"
>
    {{-- TODO: Remove --}}
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
            <x-livewire-tables::table.td.plain :column="$column" x-show="currentlyReorderingStatus || !hideReorderColumnUnlessReorderingStatus" wire:key="{{ $tableName .'-secondaryheader-reorder-show' . $column->getSlug() }}"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)" />
        @else
            <x-livewire-tables::table.td.plain :column="$column" x-show="!currentlyReorderingStatus" wire:key="{{ $tableName .'-secondaryheader-show-'.$column->getSlug() }}"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $rows, $colIndex)">
                {{ $column->getSecondaryHeaderContents($rows) }}
            </x-livewire-tables::table.td.plain>
            <x-livewire-tables::table.td.plain :column="$column" x-show="currentlyReorderingStatus" wire:key="{{ $tableName .'-secondaryheader-blank-'.$column->getSlug() }}" />
        @endif
    @endforeach
</x-livewire-tables::table.tr.plain>
