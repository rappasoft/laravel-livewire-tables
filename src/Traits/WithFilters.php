<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Filters\{HasFiltersStatus, HasFilterGenericData, HasFilterMenu, HasFilterPills, HasFilterQueryString, HasFiltersVisibility, ManagesFilters,Configuration\FilterConfiguration, Helpers\FilterHelpers};

trait WithFilters
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

    public function filters(): array
    {
        return [];
    }
}
