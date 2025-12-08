<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

trait HasAllTraits
{
    // Note Specific Order Below!
    use WithTableHooks;
    use WithLoadingPlaceholder;
    use ComponentUtilities,
        WithActions,
        WithData,
        WithColumns,
        WithSorting,
        WithSearch,
        WithPagination;
    use WithBulkActions,
        WithCollapsingColumns,
        WithColumnSelect,
        WithConfigurableAreas,
        WithCustomisations,
        WithDebugging,
        WithDeferredLoading,
        WithEvents,
        WithFilters,
        WithFooter,
        WithGrouping,
        WithQueryString,
        WithRefresh,
        WithReordering,
        WithSecondaryHeader,
        WithSummaries,
        WithTableAttributes;
}
