<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits;

use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\AggregateColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\AggregateColumnHelpers;

trait IsAggregateColumn
{
    use IsColumn,
        AggregateColumnHelpers,
        AggregateColumnConfiguration { AggregateColumnHelpers::getContents insteadof IsColumn;
            AggregateColumnConfiguration::sortable insteadof IsColumn; }
}
