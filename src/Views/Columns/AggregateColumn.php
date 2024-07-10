<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\AggregateColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\AggregateColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn;

class AggregateColumn extends Column
{
    use IsColumn,
        AggregateColumnHelpers,
        AggregateColumnConfiguration { AggregateColumnConfiguration::sortable insteadof IsColumn; }

    public ?string $dataSource;

    public string $aggregateMethod = 'count';

    public ?string $foreignColumn;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }

}
