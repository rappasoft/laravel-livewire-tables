<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\FullPageComponentConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\FullPageComponentHelpers;

trait WithFullPageComponent
{
    use FullPageComponentConfiguration,
        FullPageComponentHelpers;

    protected ?string $layout = null;

    protected ?string $slot = null;

    protected ?string $extends = null;

    protected ?string $section = null;
}
