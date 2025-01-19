<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Livewire\Attributes\Locked;
use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Traits\Filters\{Configuration\FilterConfiguration, Helpers\FilterHelpers};

trait HandlesFilterTraits
{
    use FilterConfiguration,
        FilterHelpers,
        HasFiltersStatus,
        HasFilterGenericData,
        HasFilterMenu,
        HasFilterPills,
        HasFilterQueryString,
        HasFiltersVisibility,
        ManagesFilters;

    // Set in JS
    public array $filterComponents = [];

    // Set in Frontend
    public array $appliedFilters = [];

    #[Locked]
    public int $filterCount;

    protected ?Collection $filterCollection;
}
