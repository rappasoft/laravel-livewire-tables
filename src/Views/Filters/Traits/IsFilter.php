<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling\{HandlesFilterInputAttributes};
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasConfig, HasLabelAttributes, HasView};

trait IsFilter
{
    use HasLocalisations,
        HasFilterPills,
        HasFilterLabel,
        FilterConfiguration,
        FilterHelpers,
        HasConfig,
        HasCustomPosition,
        HasLabelAttributes,
        HasVisibility,
        HasView,
        HandlesFilterInputAttributes;

    protected string $name;

    protected string $key;

    protected bool $resetByClearButton = true;

    protected mixed $filterCallback = null;

    protected mixed $filterDefaultValue = null;

    public array $genericDisplayData = [];
}
