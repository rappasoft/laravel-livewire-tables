<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration\FilterVisibilityConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers\FilterVisibilityHelpers;

trait HasFiltersVisibility
{
    use FilterVisibilityConfiguration,
        FilterVisibilityHelpers;

    #[Locked]
    public bool $filtersVisibilityStatus = true;
}
