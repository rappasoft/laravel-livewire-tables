@php($tableName = $this->getTableName())

<div>
    <x-livewire-tables::wrapper :component="$this" :tableName="$tableName">
        @if ($this->hasConfigurableAreaFor('before-tools'))
            @include($this->getConfigurableAreaFor('before-tools'), $this->getParametersForConfigurableArea('before-tools'))
        @endif

        <x-livewire-tables::tools>
            @if ($this->showSortPillsSection)
                <x-livewire-tables::tools.sorting-pills />
            @endif
            @if($this->showFilterPillsSection)
                <x-livewire-tables::tools.filter-pills />
            @endif
            <x-livewire-tables::tools.toolbar :$filterGenericData />
        </x-livewire-tables::tools>

        <x-livewire-tables::table>
            
            <x-slot name="thead">
                @if($this->getCurrentlyReorderingStatus)
                    <x-livewire-tables::table.th.reorder x-cloak x-show="currentlyReorderingStatus" />
                @endif
                @if($this->showBulkActionsSections)
                    <x-livewire-tables::table.th.bulk-actions :displayMinimisedOnReorder="true" />
                @endif
                @if ($this->showCollapsingColumnSections)
                    <x-livewire-tables::table.th.collapsed-columns />
                @endif

                @foreach($selectedVisibleColumns as $index => $column)
                    <x-livewire-tables::table.th wire:key="{{ $tableName.'-table-head-'.$index }}" :column="$column" :index="$index" />
                @endforeach
            </x-slot>

            @if($this->secondaryHeaderIsEnabled() && $this->hasColumnsWithSecondaryHeader())
                <x-livewire-tables::table.tr.secondary-header :rows="$rows" :$filterGenericData :$selectedVisibleColumns  />
            @endif
            @if($this->hasDisplayLoadingPlaceholder())
                <x-livewire-tables::includes.loading colCount="{{ $this->columns->count()+1 }}" />
            @endif


            @if($this->showBulkActionsSections)
                <x-livewire-tables::table.tr.bulk-actions :rows="$rows" :displayMinimisedOnReorder="true" />
            @endif

            @forelse ($rows as $rowIndex => $row)
                <x-livewire-tables::table.tr wire:key="{{ $tableName }}-row-wrap-{{ $row->{$this->getPrimaryKey()} }}" :row="$row" :rowIndex="$rowIndex">
                    @if($this->getCurrentlyReorderingStatus)
                        <x-livewire-tables::table.td.reorder x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $tableName }}-row-reorder-{{ $row->{$this->getPrimaryKey()} }}" :rowID="$tableName.'-'.$row->{$this->getPrimaryKey()}" :rowIndex="$rowIndex" />
                    @endif
                    @if($this->showBulkActionsSections)
                        <x-livewire-tables::table.td.bulk-actions wire:key="{{ $tableName }}-row-bulk-act-{{ $row->{$this->getPrimaryKey()} }}" :row="$row" :rowIndex="$rowIndex"/>
                    @endif
                    @if ($this->showCollapsingColumnSections)
                        <x-livewire-tables::table.td.collapsed-columns wire:key="{{ $tableName }}-row-collapsed-{{ $row->{$this->getPrimaryKey()} }}" :rowIndex="$rowIndex" />
                    @endif

                    @foreach($selectedVisibleColumns as $colIndex => $column)
                        <x-livewire-tables::table.td wire:key="{{ $tableName . '-' . $row->{$this->getPrimaryKey()} . '-datatable-td-' . $column->getSlug() }}"  :column="$column" :colIndex="$colIndex">
                            @if($column->isHtml())                            
                                {!! $column->renderContents($row) !!}
                            @else
                                {{ $column->renderContents($row) }}
                            @endif
                        </x-livewire-tables::table.td>
                    @endforeach
                </x-livewire-tables::table.tr>

                @if ($this->showCollapsingColumnSections)
                    <x-livewire-tables::table.collapsed-columns :row="$row" :rowIndex="$rowIndex" />
                @endif
            @empty
                <x-livewire-tables::table.empty />
            @endforelse

            @if ($this->footerIsEnabled() && $this->hasColumnsWithFooter())
                <x-slot name="tfoot">
                    @if ($this->useHeaderAsFooterIsEnabled())
                        <x-livewire-tables::table.tr.secondary-header :rows="$rows" :$filterGenericData />
                    @else
                        <x-livewire-tables::table.tr.footer :rows="$rows"  :$filterGenericData />
                    @endif
                </x-slot>
            @endif
        </x-livewire-tables::table>

        <x-livewire-tables::pagination :rows="$rows" />

        @includeIf($customView)
    </x-livewire-tables::wrapper>
</div>
