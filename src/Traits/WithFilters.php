<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Filters\{HandlesLivewireComponentFilters, HandlesPillsData, HasFilterGenericData, HasFilterMenu, HasFilterPills, HasFilterQueryString, HasFiltersCore, HasFiltersStatus, HasFiltersVisibility};

trait WithFilters
{
    use HasFiltersStatus,
        HasFilterGenericData,
        HasFilterMenu,
        HandlesPillsData,
        HasFilterPills,
        HasFilterQueryString,
        HasFiltersVisibility,
        HasFiltersCore,
        HandlesLivewireComponentFilters;

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
