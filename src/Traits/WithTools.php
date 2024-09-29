<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\ToolsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ToolsHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasToolsStyling;

trait WithTools
{
    use ToolsConfiguration,
        ToolsHelpers,
        HasToolsStyling;

    protected bool $toolsStatus = true;

    protected bool $toolBarStatus = true;
}
