<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits;

use Closure;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\AttributesConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\AttributesHelpers;

trait HasAttributes
{
    use AttributesConfiguration,
        AttributesHelpers;

    protected ?Closure $attributesCallback = null;
}
