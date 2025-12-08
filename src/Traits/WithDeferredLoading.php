<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\DeferredLoadingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\DeferredLoadingHelpers;

trait WithDeferredLoading
{
    use DeferredLoadingConfiguration,
        DeferredLoadingHelpers;

    protected bool $deferLoading = false;
}



