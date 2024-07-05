<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\{Builder, Model};
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\CountColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\CountColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn;

class CountColumn extends Column
{
    use IsColumn,
        CountColumnHelpers,
        CountColumnConfiguration { CountColumnConfiguration::sortable insteadof IsColumn; }

    public ?string $countSource;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }
    }
}
