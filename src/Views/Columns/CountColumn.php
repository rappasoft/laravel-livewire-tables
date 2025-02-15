<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;


class CountColumn extends AggregateColumn
{

    public string $aggregateMethod = 'count';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }
}
