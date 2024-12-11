<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\SecondaryHeaderStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\SecondaryHeaderStylingHelpers;
use Closure;

trait HasSecondaryHeaderStyling
{
    use SecondaryHeaderStylingConfiguration,
        SecondaryHeaderStylingHelpers;

        protected ?Closure $secondaryHeaderTrAttributesCallback;

        protected ?Closure $secondaryHeaderTdAttributesCallback;
    
}