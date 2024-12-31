@php($tableName = $this->getTableName)
@php($tableId = $this->getTableId)
@php($primaryKey = $this->getPrimaryKey)
@php($isTailwind = $this->isTailwind)
@php($isBootstrap = $this->isBootstrap)
@php($isBootstrap4 = $this->isBootstrap4)
@php($isBootstrap5 = $this->isBootstrap5)

<div>
    <div {{ $this->getTopLevelAttributes() }}>

        @includeWhen(
            $this->hasConfigurableAreaFor('before-wrapper'),
            $this->getConfigurableAreaFor('before-wrapper'),
            $this->getParametersForConfigurableArea('before-wrapper')
        )

        <x-livewire-tables::wrapper :component="$this" :tableName="$tableName" :$primaryKey :$isTailwind :$isBootstrap :$isBootstrap4 :$isBootstrap5>
            @if($this->hasActions && !$this->showActionsInToolbar)
                <x-livewire-tables::includes.actions/>
            @endif

            @includeWhen(
                $this->hasConfigurableAreaFor('before-tools'),
                $this->getConfigurableAreaFor('before-tools'),
                $this->getParametersForConfigurableArea('before-tools')
            )

            @if($this->shouldShowTools)
            <x-livewire-tables::tools>
                @if ($this->showSortPillsSection)
                    <x-livewire-tables::tools.sorting-pills />
                @endif
                @if($this->showFilterPillsSection)
                    <x-livewire-tables::tools.filter-pills />
                @endif

                @includeWhen(
                    $this->hasConfigurableAreaFor('before-toolbar'),
                    $this->getConfigurableAreaFor('before-toolbar'),
                    $this->getParametersForConfigurableArea('before-toolbar')
                )

                @if($this->shouldShowToolBar)
                    <x-livewire-tables::tools.toolbar />
                @endif

                @includeWhen(
                    $this->hasConfigurableAreaFor('after-toolbar'),
                    $this->getConfigurableAreaFor('after-toolbar'),
                    $this->getParametersForConfigurableArea('after-toolbar')
                )

            </x-livewire-tables::tools>
            @endif

            <x-livewire-tables::table>

                <x-slot name="thead">
                    @if($this->getCurrentlyReorderingStatus)
                        <x-livewire-tables::table.th.reorder x-cloak x-show="currentlyReorderingStatus"  />
                    @endif
                    @if($this->showBulkActionsSections)
                        <x-livewire-tables::table.th.bulk-actions :displayMinimisedOnReorder="true" />
                    @endif
                    @if ($this->showCollapsingColumnSections)
                        <x-livewire-tables::table.th.collapsed-columns />
                    @endif

                    @foreach($this->selectedVisibleColumns as $index => $column)
                        <x-livewire-tables::table.th wire:key="{{ $tableName.'-table-head-'.$index }}" :$column :$index />
                    @endforeach
                </x-slot>

                @if($this->secondaryHeaderIsEnabled() && $this->hasColumnsWithSecondaryHeader())
                    <x-livewire-tables::table.tr.secondary-header  />
                @endif
                @if($this->hasDisplayLoadingPlaceholder())
                    <x-livewire-tables::includes.loading colCount="{{ $this->columns->count()+1 }}" />
                @endif

                @if($this->showBulkActionsSections)
                    <x-livewire-tables::table.tr.bulk-actions  :displayMinimisedOnReorder="true" />
                @endif

                @forelse ($this->getRows as $rowIndex => $row)
                    <x-livewire-tables::table.tr wire:key="{{ $tableName }}-row-wrap-{{ $row->{$primaryKey} }}" :$row :$rowIndex>
                        @if($this->getCurrentlyReorderingStatus)
                            <x-livewire-tables::table.td.reorder x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $tableName }}-row-reorder-{{ $row->{$primaryKey} }}" :rowID="$tableName.'-'.$row->{$this->getPrimaryKey()}" :$rowIndex />
                        @endif
                        @if($this->showBulkActionsSections)
                            <x-livewire-tables::table.td.bulk-actions wire:key="{{ $tableName }}-row-bulk-act-{{ $row->{$primaryKey} }}" :$row :$rowIndex />
                        @endif
                        @if ($this->showCollapsingColumnSections)
                            <x-livewire-tables::table.td.collapsed-columns wire:key="{{ $tableName }}-row-collapsed-{{ $row->{$primaryKey} }}" :$rowIndex />
                        @endif

                        @foreach($this->selectedVisibleColumns as $colIndex => $column)
                            <x-livewire-tables::table.td wire:key="{{ $tableName . '-' . $row->{$primaryKey} . '-datatable-td-' . $column->getSlug() }}"  :$column :$colIndex>
                                @if($column->isHtml())
                                    {!! $column->setIndexes($rowIndex, $colIndex)->renderContents($row) !!}
                                @else
                                    {{ $column->setIndexes($rowIndex, $colIndex)->renderContents($row) }}
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

        @includeWhen(
            $this->hasConfigurableAreaFor('after-wrapper'),
            $this->getConfigurableAreaFor('after-wrapper'),
            $this->getParametersForConfigurableArea('after-wrapper')
        )

    </div>
</div>
