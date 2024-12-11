<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\ActionsStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\ActionsStylingHelpers;

trait HasActionsStyling
{
    use ActionsStylingConfiguration,
        ActionsStylingHelpers;

    protected array $actionWrapperAttributes = ['class' => '', 'default-styling' => true, 'default-colors' => true];
}
