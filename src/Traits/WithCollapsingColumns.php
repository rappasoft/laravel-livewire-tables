<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\CollapsingColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\CollapsingColumnHelpers;

trait WithCollapsingColumns
{
    use CollapsingColumnConfiguration;
    use CollapsingColumnHelpers;

    protected bool $collapsingColumnsStatus = true;

    protected array $collapsingColumnButtonCollapseAttributes = ['default-styling' => true, 'default-colors' => true];

    protected array $collapsingColumnButtonExpandAttributes = ['default-styling' => true, 'default-colors' => true];
}
