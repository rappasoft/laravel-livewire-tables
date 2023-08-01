@php
$tableName = $this->getTableName();
@endphp
<x-livewire-tables::wrapper :component="$this" :tableName="$tableName">
    @if ($this->hasConfigurableAreaFor('before-tools'))
        @include($this->getConfigurableAreaFor('before-tools'), $this->getParametersForConfigurableArea('before-tools'))
    @endif

    <x-livewire-tables::tools>
        <x-livewire-tables::tools.sorting-pills />
        <x-livewire-tables::tools.filter-pills />
        <x-livewire-tables::tools.toolbar />
    </x-livewire-tables::tools>

    <x-livewire-tables::table>
        <x-slot name="thead">
            <x-livewire-tables::table.th.reorder />
            <x-livewire-tables::table.th.bulk-actions />
            <x-livewire-tables::table.th.row-contents />

            @foreach($columns as $index => $column)
                @continue($column->isHidden())
                @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                @if($column->isReorderColumn())
                    <x-livewire-tables::table.th wire:key="{{ $tableName.'-tablehead-'.$index }}" x-show="currentlyReorderingStatus || !hideReorderColumnUnlessReorderingStatus"  :column="$column" :index="$index" />
                @else
                    <x-livewire-tables::table.th wire:key="{{ $tableName.'-tablehead-'.$index }}" :column="$column" :index="$index" />
                @endif
            @endforeach
        </x-slot>

        @if($this->secondaryHeaderIsEnabled() && $this->hasColumnsWithSecondaryHeader())
            <x-livewire-tables::table.tr.secondary-header :rows="$rows" />
        @endif

        <x-livewire-tables::table.tr.bulk-actions :rows="$rows" />

        @forelse ($rows as $rowIndex => $row)
            <x-livewire-tables::table.tr wire:key="{{ $tableName }}-rowwrap-{{ $rowIndex }}" :row="$row" :rowIndex="$rowIndex">
                <x-livewire-tables::table.td.reorder :rowID="$tableName.'-'.$row->{$this->getPrimaryKey()}" :rowIndex="$rowIndex" />
                <x-livewire-tables::table.td.bulk-actions :row="$row" />
                <x-livewire-tables::table.td.row-contents :rowIndex="$rowIndex" />

                @foreach($columns as $colIndex => $column)
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                    @if($column->isReorderColumn())
                        <x-livewire-tables::table.td x-show="currentlyReorderingStatus || !hideReorderColumnUnlessReorderingStatus"  wire:key="{{ $tableName . '-' . $rowIndex . '-' . $colIndex }}"  :column="$column" :colIndex="$colIndex">
                            {{ $column->renderContents($row) }}
                        </x-livewire-tables::table.td>
                    @else
                        <x-livewire-tables::table.td wire:key="{{ $tableName . '-' . $row->{$this->getPrimaryKey()} . '-' . $colIndex }}"  :column="$column" :colIndex="$colIndex">
                            {{ $column->renderContents($row) }}
                        </x-livewire-tables::table.td>
                    @endif
                @endforeach
            </x-livewire-tables::table.tr>

            <x-livewire-tables::table.row-contents :row="$row" :rowIndex="$rowIndex" />
        @empty
            <x-livewire-tables::table.empty />
        @endforelse

        @if ($this->footerIsEnabled() && $this->hasColumnsWithFooter())
            <x-slot name="tfoot">
                @if ($this->useHeaderAsFooterIsEnabled())
                    <x-livewire-tables::table.tr.secondary-header :rows="$rows" />
                @else
                    <x-livewire-tables::table.tr.footer :rows="$rows" />
                @endif
            </x-slot>
        @endif
    </x-livewire-tables::table>

    <x-livewire-tables::pagination :rows="$rows" />

    @isset($customView)
        @include($customView)
    @endisset
</x-livewire-tables::wrapper>
