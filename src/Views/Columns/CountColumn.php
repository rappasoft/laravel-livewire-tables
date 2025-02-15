<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\IsAggregateColumn;

class CountColumn extends AggregateColumn
{
    use IsAggregateColumn;

    public string $aggregateMethod = 'count';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }
}
