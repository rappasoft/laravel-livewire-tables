<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\ToolsStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\ToolsStylingHelpers;

trait HasToolsStyling
{
    use ToolsStylingConfiguration,
        ToolsStylingHelpers;

    protected array $toolsAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    protected array $toolBarAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];
}
