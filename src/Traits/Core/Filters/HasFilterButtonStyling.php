<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Filters;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\FilterButtonStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\FilterButtonStylingHelpers;

trait HasFilterButtonStyling
{
    use FilterButtonStylingConfiguration,
        FilterButtonStylingHelpers;

    protected array $filterButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $filterButtonBadgeAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];
}
