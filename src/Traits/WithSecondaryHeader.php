<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\SecondaryHeaderConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\SecondaryHeaderHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasSecondaryHeaderStyling;

trait WithSecondaryHeader
{
    use SecondaryHeaderConfiguration,
        SecondaryHeaderHelpers,
        HasSecondaryHeaderStyling;

    protected bool $secondaryHeaderStatus = true;

    protected bool $columnsWithSecondaryHeader = false;
}
