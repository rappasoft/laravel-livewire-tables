<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

class AvgColumn extends AggregateColumn
{

    public string $aggregateMethod = 'avg';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }
}
