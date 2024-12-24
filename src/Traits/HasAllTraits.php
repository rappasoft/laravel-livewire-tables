<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Core\{HasCustomAttributes, HasLocalisations};
use Rappasoft\LaravelLivewireTables\Traits\Styling\Defaults\{HasDefaultFilterInputStyling};
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasTheme;

trait HasAllTraits
{
    // Note Specific Order Below!
    use WithTableHooks;
    use HasLocalisations;
    use WithLoadingPlaceholder;
    use HasTheme;
    use ComponentUtilities,
        HasDefaultFilterInputStyling,
        WithActions,
        WithData,
        WithQueryString,
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
        WithRefresh,
        WithReordering,
        WithSecondaryHeader,
        WithSessionStorage,
        WithTableAttributes,
        WithTools;
}
