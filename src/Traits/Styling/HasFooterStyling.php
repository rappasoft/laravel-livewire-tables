<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Closure;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\FooterStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\FooterStylingHelpers;

trait HasFooterStyling
{
    use FooterStylingConfiguration,
        FooterStylingHelpers;

    protected ?Closure $footerTrAttributesCallback;

    protected ?Closure $footerTdAttributesCallback;
}
