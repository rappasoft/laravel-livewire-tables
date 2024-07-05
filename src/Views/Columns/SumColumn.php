<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\SumColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\SumColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn;

class SumColumn extends Column
{
    use IsColumn,
        SumColumnHelpers,
        SumColumnConfiguration { SumColumnConfiguration::sortable insteadof IsColumn; }

    public ?string $dataSource;
    
    public ?string $sumColumn;

    public string $aggregateMethod = 'sum';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }
    }
}
