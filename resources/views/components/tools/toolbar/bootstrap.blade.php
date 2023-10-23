<div @class([
    'd-md-flex justify-content-between mb-3' => $component->isBootstrap(),
])>
    <div @class([
        'd-md-flex' => $component->isBootstrap(),
    ])>
        @if ($component->hasConfigurableAreaFor('toolbar-left-start'))
            <div x-show="!currentlyReorderingStatus">
                @include($component->getConfigurableAreaFor('toolbar-left-start'), $component->getParametersForConfigurableArea('toolbar-left-start'))
            </div>
        @endif

        @if ($component->reorderIsEnabled())
            <x-livewire-tables::tools.toolbar.items.bs.reorder />
        @endif


        @if ($component->searchIsEnabled() && $component->searchVisibilityIsEnabled())
            <x-livewire-tables::tools.toolbar.items.bs.search />
        @endif


        @if ($component->filtersAreEnabled() && $component->filtersVisibilityIsEnabled() && $component->hasVisibleFilters())
        <x-livewire-tables::tools.toolbar.items.bs.filter-button />

        @endif

        @if ($component->hasConfigurableAreaFor('toolbar-left-end'))
            <div x-show="!currentlyReorderingStatus">
                @include($component->getConfigurableAreaFor('toolbar-left-end'), $component->getParametersForConfigurableArea('toolbar-left-end'))
            </div>
        @endif
    </div>

    <div
        x-show="!currentlyReorderingStatus"
        @class([
            'd-md-flex' => $component->isBootstrap(),
        ])
    >
        @if ($component->hasConfigurableAreaFor('toolbar-right-start'))
            @include($component->getConfigurableAreaFor('toolbar-right-start'), $component->getParametersForConfigurableArea('toolbar-right-start'))
        @endif

        @if ($component->showBulkActionsDropdownAlpine())
        <x-livewire-tables::tools.toolbar.items.bs.bulk-actions />
        @endif


        @if ($component->columnSelectIsEnabled())
            <x-livewire-tables::tools.toolbar.items.bs.column-select /> 
        @endif


        @if ($component->paginationIsEnabled() && $component->perPageVisibilityIsEnabled())
        <x-livewire-tables::tools.toolbar.items.bs.pagination-perpage /> 
        @endif


        @if ($component->hasConfigurableAreaFor('toolbar-right-end'))
            <div x-show="!currentlyReorderingStatus">
                @include($component->getConfigurableAreaFor('toolbar-right-end'), $component->getParametersForConfigurableArea('toolbar-right-end'))
            </div>
        @endif
    </div>
</div>


@if (
    $component->filtersAreEnabled() &&
    $component->filtersVisibilityIsEnabled() &&
    $component->hasVisibleFilters() &&
    $component->isFilterLayoutSlideDown()
)
    <x-livewire-tables::tools.toolbar.items.bs.filter-slidedown /> 
@endif
