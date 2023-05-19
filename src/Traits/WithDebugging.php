<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\DebuggingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\DebugHelpers;

trait WithDebugging
{
    use DebuggingConfiguration,
        DebugHelpers;

    /**
     * Dump table properties for debugging
     */
    protected bool $debugStatus = false;
}
