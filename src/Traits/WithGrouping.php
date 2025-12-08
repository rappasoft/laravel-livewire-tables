<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\GroupingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\GroupingHelpers;

trait WithGrouping
{
    use GroupingConfiguration,
        GroupingHelpers;

    protected bool $groupingStatus = false;

    protected ?string $groupByColumn = null;

    protected bool $groupsCollapsed = false;

    protected array $expandedGroups = [];
}

