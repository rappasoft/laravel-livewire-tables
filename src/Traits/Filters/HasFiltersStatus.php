<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration\FilterStatusConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers\FilterStatusHelpers;

trait HasFiltersStatus
{
    use FilterStatusConfiguration,
        FilterStatusHelpers;

    #[Locked]
    public bool $filtersStatus = true;
}
