<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Core\Filters\HandlesFilterTraits;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\FilterHelpers;

trait WithFilters
{
    use FilterConfiguration,
        FilterHelpers;
    use HandlesFilterTraits;

    #[Locked]
    public int $filterCount;

    protected ?Collection $filterCollection;

    public function filters(): array
    {
        return [];
    }
}
