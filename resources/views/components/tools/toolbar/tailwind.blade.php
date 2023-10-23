<div class="md:flex md:justify-between mb-4 px-4 md:p-0">
    <div class="w-full mb-4 md:mb-0 md:w-2/4 md:flex space-y-4 md:space-y-0 md:space-x-2">
        <div x-show="!currentlyReorderingStatus">
            @if ($component->hasConfigurableAreaFor('toolbar-left-start'))
                @include($component->getConfigurableAreaFor('toolbar-left-start'), $component->getParametersForConfigurableArea('toolbar-left-start'))
            @endif
        </div>
        
        @if ($component->reorderIsEnabled())
            <x-livewire-tables::tools.toolbar.items.reorder-buttons />
        @endif
        
        @if ($component->searchIsEnabled() && $component->searchVisibilityIsEnabled())
            <x-livewire-tables::tools.toolbar.items.search-field />
        @endif

        @if ($component->filtersAreEnabled() && $component->filtersVisibilityIsEnabled() && $component->hasVisibleFilters())
            <x-livewire-tables::tools.toolbar.items.tw.filter-button />
        @endif

        @if ($component->hasConfigurableAreaFor('toolbar-left-end'))
            <div x-show="!currentlyReorderingStatus">
                @include($component->getConfigurableAreaFor('toolbar-left-end'), $component->getParametersForConfigurableArea('toolbar-left-end'))
            </div>
        @endif
    </div>

    <div x-show="!currentlyReorderingStatus" class="md:flex md:items-center space-y-4 md:space-y-0 md:space-x-2">
        @if ($component->hasConfigurableAreaFor('toolbar-right-start'))
            @include($component->getConfigurableAreaFor('toolbar-right-start'), $component->getParametersForConfigurableArea('toolbar-right-start'))
        @endif

        @if ($component->showBulkActionsDropdownAlpine())
        <x-livewire-tables::tools.toolbar.items.tw.bulk-actions />
        @endif

        @if ($component->columnSelectIsEnabled())
            <x-livewire-tables::tools.toolbar.items.tw.column-select /> 
        @endif

        @if ($component->paginationIsEnabled() && $component->perPageVisibilityIsEnabled())
        <x-livewire-tables::tools.toolbar.items.pagination-dropdown /> 
        @endif

        @if ($component->hasConfigurableAreaFor('toolbar-right-end'))
            @include($component->getConfigurableAreaFor('toolbar-right-end'), $component->getParametersForConfigurableArea('toolbar-right-end'))
        @endif
    </div>
</div>
@if (
    $component->filtersAreEnabled() &&
    $component->filtersVisibilityIsEnabled() &&
    $component->hasVisibleFilters() &&
    $component->isFilterLayoutSlideDown()
)
    <x-livewire-tables::tools.toolbar.items.tw.filter-slidedown />
@endif
