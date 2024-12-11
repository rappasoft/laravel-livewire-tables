<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\CollapsingColumnsStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\CollapsingColumnsStylingHelpers;

trait HasCollapsingColumnsStyling
{
    use CollapsingColumnsStylingConfiguration,
        CollapsingColumnsStylingHelpers;

    protected array $collapsingColumnButtonCollapseAttributes = ['default-styling' => true, 'default-colors' => true];

    protected array $collapsingColumnButtonExpandAttributes = ['default-styling' => true, 'default-colors' => true];
}
