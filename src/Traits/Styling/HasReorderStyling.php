<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\ReorderStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\ReorderStylingHelpers;

trait HasReorderStyling
{
    use ReorderStylingConfiguration,
        ReorderStylingHelpers;

    protected array $reorderThAttributes = ['default' => true];
}
