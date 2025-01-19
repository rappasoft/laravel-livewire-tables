<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration\FilterGenericDataConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers\FilterGenericDataHelpers;

trait HasFilterGenericData
{
    use FilterGenericDataConfiguration,
        FilterGenericDataHelpers;

    public array $filterGenericData = [];
}
