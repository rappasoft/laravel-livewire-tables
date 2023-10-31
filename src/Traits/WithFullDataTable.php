<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

trait WithFullDataTable
{
    use ComponentUtilities,
        WithBulkActions,
        WithColumns,
        WithColumnSelect,
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
        WithSorting;
}
