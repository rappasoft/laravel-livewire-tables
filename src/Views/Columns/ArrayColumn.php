<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\ArrayColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\ArrayColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\IsColumn;

class ArrayColumn extends Column
{
    use IsColumn,
        ArrayColumnConfiguration,
        ArrayColumnHelpers;

    public string $separator = '<br />';

    public string $emptyValue = '';

    protected mixed $dataCallback = null;

    protected mixed $outputFormat = null;

    public ?string $outputWrapperStart = null;

    public ?string $outputWrapperEnd = null;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }
    }
}
