<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\AggregateColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\AggregateColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn;

class SumColumn extends AggregateColumn
{
    use IsColumn,
        AggregateColumnHelpers,
        AggregateColumnConfiguration { AggregateColumnConfiguration::sortable insteadof IsColumn; }

    public string $aggregateMethod = 'sum';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
    }
}
