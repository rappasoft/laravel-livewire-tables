<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\AggregateColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\AggregateColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn;

class AvgColumn extends AggregateColumn
{
    use IsColumn,
        AggregateColumnHelpers,
        AggregateColumnConfiguration { AggregateColumnConfiguration::sortable insteadof IsColumn; }

    public string $aggregateMethod = 'avg';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }
    }
}
