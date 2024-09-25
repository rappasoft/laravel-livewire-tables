<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Core\HasCustomAttributes;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasTheme;

trait HasAllTraits
{
    // Note Specific Order Below!
    use WithTableHooks;
    use WithLoadingPlaceholder;
    use HasTheme;
    use ComponentUtilities,
        WithActions,
        WithData,
        WithColumns,
        WithSorting,
        WithSearch,
        WithPagination;
    use WithBulkActions,
        HasCustomAttributes,
        WithCollapsingColumns,
        WithColumnSelect,
        WithConfigurableAreas,
        WithCustomisations,
        WithDebugging,
        WithEvents,
        WithFilters,
        WithFooter,
        WithQueryString,
        WithRefresh,
        WithReordering,
        WithSecondaryHeader,
        WithSessionStorage,
        WithTableAttributes,
        WithTools;
}
