@php($tableName = $this->getTableName())

<div>
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
                <x-livewire-tables::table.th.reorder x-cloak x-show="currentlyReorderingStatus" />
                <x-livewire-tables::table.th.bulk-actions :displayMinimisedOnReorder="true" />
                <x-livewire-tables::table.th.row-contents />

                @foreach($columns as $index => $column)
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                    @if($column->isReorderColumn())
                        <x-livewire-tables::table.th wire:key="{{ $tableName.'-table-head-'.$index }}" :displayMinimisedOnReorder="true" :column="$column" :index="$index" />
                    @else
                        <x-livewire-tables::table.th wire:key="{{ $tableName.'-table-head-'.$index }}" :column="$column" :index="$index" />
                    @endif
                @endforeach
            </x-slot>

            @if($this->secondaryHeaderIsEnabled() && $this->hasColumnsWithSecondaryHeader())
                <x-livewire-tables::table.tr.secondary-header :rows="$rows" />
            @endif

            <x-livewire-tables::table.tr.bulk-actions :rows="$rows" :displayMinimisedOnReorder="true" />

            @forelse ($rows as $rowIndex => $row)
                <x-livewire-tables::table.tr wire:key="{{ $tableName }}-row-wrap-{{ $row->{$this->getPrimaryKey()} }}" :row="$row" :rowIndex="$rowIndex">
                    <x-livewire-tables::table.td.reorder x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $tableName }}-row-reorder-{{ $row->{$this->getPrimaryKey()} }}" :rowID="$tableName.'-'.$row->{$this->getPrimaryKey()}" :rowIndex="$rowIndex" />
                    <x-livewire-tables::table.td.bulk-actions wire:key="{{ $tableName }}-row-bulk-act-{{ $row->{$this->getPrimaryKey()} }}" :row="$row" :rowIndex="$rowIndex"/>
                    <x-livewire-tables::table.td.row-contents wire:key="{{ $tableName }}-row-collapsed-{{ $row->{$this->getPrimaryKey()} }}" :rowIndex="$rowIndex" />

                    @foreach($columns as $colIndex => $column)
                        @continue($column->isHidden())
                        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                        @if($column->isReorderColumn())
                            <x-livewire-tables::table.td :displayMinimisedOnReorder="true"  wire:key="{{ $tableName . '-' . $row->{$this->getPrimaryKey()} . '-datatable-reorder-' . $column->getSlug() }}"  :column="$column" :colIndex="$colIndex">
                                {{ $column->renderContents($row) }}
                            </x-livewire-tables::table.td>
                        @else
                            <x-livewire-tables::table.td wire:key="{{ $tableName . '-' . $row->{$this->getPrimaryKey()} . '-datatable-td-' . $column->getSlug() }}"  :column="$column" :colIndex="$colIndex">
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

        @includeIf($customView)
    </x-livewire-tables::wrapper>
</div>
