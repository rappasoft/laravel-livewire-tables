<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits;

use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasConfig,HasView};
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{HasCustomPosition,HasVisibility};
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\FilterHelpers;

trait IsFilter
{
    use FilterConfiguration,
        FilterHelpers,
        HasConfig,
        HasCustomPosition,
        HasVisibility,
        HasView;

    protected string $name;

    protected string $key;

    protected bool $resetByClearButton = true;

    protected mixed $filterCallback = null;

    protected ?string $filterPillTitle = null;

    protected array $filterPillValues = [];

    protected ?string $filterCustomLabel = null;

    protected array $filterLabelAttributes = [];

    protected ?string $filterCustomPillBlade = null;

    protected mixed $filterDefaultValue = null;

    public array $genericDisplayData = [];
}
