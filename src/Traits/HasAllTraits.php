<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

trait HasAllTraits
{
    // Note Specific Order Below!
    use ComponentUtilities;
    use WithData;
    use WithColumns;
    use WithBulkActions,
        WithCollapsingColumns,
        WithColumnSelect,
        WithConfigurableAreas,
        WithCustomisations,
        WithDebugging,
        WithEvents,
        WithFilters,
        WithFooter,
        WithLoadingPlaceholder,
        WithPagination,
        WithQueryString,
        WithRefresh,
        WithReordering,
        WithSearch,
        WithSecondaryHeader,
        WithSorting,
        WithTableAttributes,
        WithTableHooks;
}
