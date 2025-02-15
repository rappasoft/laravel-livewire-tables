<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

class SumColumn extends AggregateColumn
{
    public string $aggregateMethod = 'sum';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }
}
