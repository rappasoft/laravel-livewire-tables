<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

trait HasAllTraits
{
    // Note Specific Order Below!
    use ComponentUtilities,
        WithData,
        WithColumns,
        WithCollapsingColumns,
        WithColumnSelect,
        WithSecondaryHeader,
        WithFooter,
        WithBulkActions,
        WithFilters,
        WithLoadingPlaceholder,
        WithConfigurableAreas,
        WithCustomisations,
        WithDebugging,
        WithEvents,
        WithPagination,
        WithQueryString,
        WithRefresh,
        WithReordering,
        WithSearch,
        WithSorting,
        WithTableAttributes,
        WithTableHooks;
}
