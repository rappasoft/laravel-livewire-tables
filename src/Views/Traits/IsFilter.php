<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasConfig, HasLabelAttributes, HasView};
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{HasCustomPosition, HasVisibility};
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\FilterHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\Styling\{HandlesFilterInputAttributes, HandlesFilterLabelAttributes};

trait IsFilter
{
    use HasLocalisations,
        FilterConfiguration,
        FilterHelpers,
        HasConfig,
        HasCustomPosition,
        HasLabelAttributes,
        HasVisibility,
        HasView,
        HandlesFilterInputAttributes,
        HandlesFilterLabelAttributes;

    protected string $name;

    protected string $key;

    protected bool $resetByClearButton = true;

    protected mixed $filterCallback = null;

    protected ?string $filterPillTitle = null;

    protected array $filterPillValues = [];

    protected ?string $filterCustomLabel = null;

    protected ?string $filterCustomPillBlade = null;

    protected mixed $filterDefaultValue = null;

    public array $genericDisplayData = [];
}
