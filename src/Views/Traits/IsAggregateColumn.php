<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits;

use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\IsColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\IsAggregateColumn as BaseIsAggregateColumn;

// No Longer Used - present for reference only
trait IsAggregateColumn
{
    use IsColumn,
        BaseIsAggregateColumn;
}
