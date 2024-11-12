<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings\HasQueryStringForFilter;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\FilterHelpers;

trait WithFilters
{
    use FilterConfiguration,
        FilterHelpers;
    use HasQueryStringForFilter;

    #[Locked]
    public bool $filtersStatus = true;

    #[Locked]
    public bool $filtersVisibilityStatus = true;

    #[Locked]
    public bool $filterPillsStatus = true;

    // Entangled in JS
    public bool $filterSlideDownDefaultVisible = false;

    #[Locked]
    public string $filterLayout = 'popover';

    #[Locked]
    public int $filterCount;

    // Set in JS
    public array $filterComponents = [];

    // Set in Frontend
    public array $appliedFilters = [];

    public array $filterGenericData = [];

    protected ?Collection $filterCollection;

    public function filters(): array
    {
        return [];
    }
}
