<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\ToolsStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\ToolsStylingHelpers;

trait HasToolsStyling
{
    use ToolsStylingConfiguration,
        ToolsStylingHelpers;

    protected array $toolsAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $toolBarAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];
    
}
