<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\ConfigurableAreasConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ConfigurableAreasHelpers;

trait WithConfigurableAreas
{
    use ConfigurableAreasConfiguration,
        ConfigurableAreasHelpers;

    protected bool $hideConfigurableAreasWhenReorderingStatus = true;

    protected array $configurableAreas = [
        'before-tools' => null,
        'toolbar-left-start' => null,
        'toolbar-left-end' => null,
        'toolbar-right-start' => null,
        'toolbar-right-end' => null,
        'before-toolbar' => null,
        'after-toolbar' => null,
        'before-pagination' => null,
        'after-pagination' => null,
    ];
}
