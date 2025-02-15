<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\AggregateColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\AggregateColumnHelpers;

trait IsAggregateColumn
{
    use IsColumn,
        AggregateColumnHelpers,
        AggregateColumnConfiguration { AggregateColumnHelpers::getContents insteadof IsColumn;
            AggregateColumnConfiguration::sortable insteadof IsColumn; }
}
