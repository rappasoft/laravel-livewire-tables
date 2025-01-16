<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\CollapsingColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\CollapsingColumnHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Columns\HasCollapsingColumnsStyling;

trait WithCollapsingColumns
{
    use CollapsingColumnConfiguration,
        CollapsingColumnHelpers,
        HasCollapsingColumnsStyling;

    protected bool $collapsingColumnsStatus = true;

    protected ?bool $shouldAlwaysCollapse;

    protected ?bool $shouldMobileCollapse;

    protected ?bool $shouldTabletCollapse;
}
