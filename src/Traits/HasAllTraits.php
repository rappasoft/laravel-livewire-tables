<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

trait HasAllTraits
{
    use ComponentUtilities;
    use WithBulkActions,
        WithCollapsingColumns,
        WithColumnSelect,
        WithConfigurableAreas,
        WithCustomisations,
        WithDebugging,
        WithEvents,
        WithFilters,
        WithFooter,
        WithPagination,
        WithQueryString,
        WithRefresh,
        WithReordering,
        WithSearch,
        WithSecondaryHeader,
        WithSorting,
        WithTableAttributes;
    use WithColumns;
    use WithData;
    use WithLoadingPlaceholder;
    // Note Specific Order Below!
    use WithTableHooks;
}
