<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\ArrayColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\ArrayColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn;

class ArrayColumn extends Column
{
    use IsColumn,
        ArrayColumnConfiguration,
        ArrayColumnHelpers { ArrayColumnHelpers::getContents insteadof IsColumn; }

    public string $separator = '<br />';

    public string $emptyValue = '';

    protected mixed $dataCallback = null;

    protected mixed $outputFormat = null;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }
    }
}
