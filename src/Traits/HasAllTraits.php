<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

trait HasAllTraits
{
    use ComponentUtilities,
        WithBulkActions,
        WithCollapsingColumns,
        WithColumns,
        WithColumnSelect,
        WithConfigurableAreas,
        WithData,
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
