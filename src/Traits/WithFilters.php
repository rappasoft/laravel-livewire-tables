<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\FilterHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Core\Filters\HandlesFilterTraits;

trait WithFilters
{
    use FilterConfiguration,
        FilterHelpers;
    use HandlesFilterTraits;

    #[Locked]
    public bool $filtersStatus = true;

    #[Locked]
    public int $filterCount;

    protected ?Collection $filterCollection;

    public function filters(): array
    {
        return [];
    }

}
