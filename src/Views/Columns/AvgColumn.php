<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Rappasoft\LaravelLivewireTables\Views\Traits\IsAggregateColumn;

class AvgColumn extends AggregateColumn
{
    use IsAggregateColumn;

    public string $aggregateMethod = 'avg';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }
}
