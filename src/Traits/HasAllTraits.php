<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

trait HasAllTraits
{
    // Note Specific Order Below!
    use WithTableHooks;
    use WithLoadingPlaceholder;
    use ComponentUtilities,
        WithCustomisations,
        WithData,
        WithColumns,
        WithSorting,
        WithSearch,
        WithPagination,
        WithTableAttributes;
        
    use WithBulkActions,
        WithCollapsingColumns,
        WithColumnSelect,
        WithConfigurableAreas,
        WithDebugging,
        WithEvents,
        WithFilters,
        WithFooter,
        WithQueryString,
        WithRefresh,
        WithReordering,
        WithSecondaryHeader;
}
