<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Closure;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\ThemeConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ThemeHelpers;

trait WithTheme
{
    use ThemeConfiguration,
        ThemeHelpers;

    public ?string $theme = null;
}
