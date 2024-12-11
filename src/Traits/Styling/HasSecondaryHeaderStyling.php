<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Closure;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\SecondaryHeaderStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\SecondaryHeaderStylingHelpers;

trait HasSecondaryHeaderStyling
{
    use SecondaryHeaderStylingConfiguration,
        SecondaryHeaderStylingHelpers;

    protected ?Closure $secondaryHeaderTrAttributesCallback;

    protected ?Closure $secondaryHeaderTdAttributesCallback;
}
