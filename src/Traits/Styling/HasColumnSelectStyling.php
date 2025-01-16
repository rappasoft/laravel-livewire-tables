<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\ColumnSelectStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\ColumnSelectStylingHelpers;

trait HasColumnSelectStyling
{
    use ColumnSelectStylingConfiguration,
        ColumnSelectStylingHelpers;

    protected array $columnSelectButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];
    protected array $columnSelectMenuOptionCheckboxAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];
}
