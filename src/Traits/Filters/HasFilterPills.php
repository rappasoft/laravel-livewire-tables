<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration\FilterPillsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers\FilterPillsHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\HasFilterPillsStyling;

trait HasFilterPills
{
    use FilterPillsConfiguration,
        FilterPillsHelpers,
        HasFilterPillsStyling;

    #[Locked]
    public bool $filterPillsStatus = true;

    public array $externalFilterPillsValues = [];

    public array $internalFilterPillsVals = ['name' => null];

    public array $externalFilterPillsLength = [];

    public array $internalFilterPillsLength = [];
}
