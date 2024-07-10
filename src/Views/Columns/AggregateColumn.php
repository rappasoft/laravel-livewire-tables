<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsAggregateColumn;

class AggregateColumn extends Column
{
    use IsAggregateColumn;

    public ?string $dataSource;

    public string $aggregateMethod = 'count';

    public ?string $foreignColumn;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }
}
