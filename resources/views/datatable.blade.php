@php($tableId = $this->getTableId)
@php($primaryKey = $this->getPrimaryKey)

<div x-data="laravellivewiretable($wire, '{{ $this->showBulkActionsDropdownAlpine() }}', '{{ $tableId }}', '{{ $primaryKey }}')">
    <x-livewire-tables::wrapper :tableName="$this->getTableName" :$primaryKey>
        @if($this->hasActions && !$this->showActionsInToolbar)
            <x-livewire-tables::includes.actions/>    
        @endif
    

        @if ($this->hasConfigurableAreaFor('before-tools'))
            @include($this->getConfigurableAreaFor('before-tools'), $this->getParametersForConfigurableArea('before-tools'))
        @endif

        @if($this->shouldShowTools)
        <x-livewire-tables::tools>
            @if ($this->showSortPillsSection)
                <x-livewire-tables::tools.sorting-pills />
            @endif
            @if($this->showFilterPillsSection)
                <x-livewire-tables::tools.filter-pills />
            @endif

            @includeWhen($this->hasConfigurableAreaFor('before-toolbar'), $this->getConfigurableAreaFor('before-toolbar'), $this->getParametersForConfigurableArea('before-toolbar'))
            @if($this->shouldShowToolBar)
                <x-livewire-tables::tools.toolbar />
            @endif
            @includeWhen($this->hasConfigurableAreaFor('after-toolbar'), $this->getConfigurableAreaFor('after-toolbar'), $this->getParametersForConfigurableArea('after-toolbar'))
            
        </x-livewire-tables::tools>
        @endif

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

                @foreach($this->selectedVisibleColumns as $index => $column)
                    <x-livewire-tables::table.th wire:key="{{ $this->getTableName.'-table-head-'.$index }}" :$column :$index />
                @endforeach
            </x-slot>

            @if($this->secondaryHeaderIsEnabled() && $this->hasColumnsWithSecondaryHeader())
                <x-livewire-tables::table.tr.secondary-header  />
            @endif
            @if($this->hasDisplayLoadingPlaceholder)
                <x-livewire-tables::includes.loading colCount="{{ $this->columns->count()+1 }}" />
            @endif


            @if($this->showBulkActionsSections)
                <x-livewire-tables::table.tr.bulk-actions  :displayMinimisedOnReorder="true" />
            @endif

            @forelse ($this->getRows as $rowIndex => $row)
                @php($rowPrimaryKey = $row->{$primaryKey})
                <x-livewire-tables::table.tr wire:key="{{ $this->getTableName }}-row-wrap-{{ $rowPrimaryKey }}" :$row :$rowIndex>
                    @if($this->getCurrentlyReorderingStatus)
                        <x-livewire-tables::table.td.reorder x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $this->getTableName }}-row-reorder-{{ $rowPrimaryKey }}" :rowID="$this->getTableName.'-'.$rowPrimaryKey" :$rowIndex />
                    @endif
                    @if($this->showBulkActionsSections)
                        <x-livewire-tables::table.td.bulk-actions wire:key="{{ $this->getTableName }}-row-bulk-act-{{ $rowPrimaryKey }}" :$row :$rowIndex/>
                    @endif
                    @if ($this->showCollapsingColumnSections)
                        <x-livewire-tables::table.td.collapsed-columns wire:key="{{ $this->getTableName }}-row-collapsed-{{ $rowPrimaryKey }}" :$rowIndex />
                    @endif

                    @foreach($this->selectedVisibleColumns as $colIndex => $column)
                        <x-livewire-tables::table.td wire:key="{{ $this->getTableName . '-' . $rowPrimaryKey . '-datatable-td-' . $column->getSlug() }}"  :$column :$colIndex>
                            @if($column->isHtml())                            
                                {!! $column->renderContents($row) !!}
                            @else
                                {{ $column->renderContents($row) }}
                            @endif
                        </x-livewire-tables::table.td>
                    @endforeach
                </x-livewire-tables::table.tr>

                @if ($this->showCollapsingColumnSections)
                    <x-livewire-tables::table.collapsed-columns :$row :$rowIndex />
                @endif
            @empty
                <x-livewire-tables::table.empty />
            @endforelse

            @if ($this->footerIsEnabled() && $this->hasColumnsWithFooter())
                <x-slot name="tfoot">
                    @if ($this->useHeaderAsFooterIsEnabled())
                        <x-livewire-tables::table.tr.secondary-header  />
                    @else
                        <x-livewire-tables::table.tr.footer  />
                    @endif
                </x-slot>
            @endif
        </x-livewire-tables::table>

        <x-livewire-tables::pagination  />

        @includeIf($customView)
    </x-livewire-tables::wrapper>
</div>
