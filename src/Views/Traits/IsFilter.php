<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits;

use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\FilterHelpers;

trait IsFilter
{
    use FilterConfiguration,
        FilterHelpers;

    protected string $name;

    protected string $key;

    protected bool $hiddenFromMenus = false;

    protected bool $hiddenFromPills = false;

    protected bool $hiddenFromFilterCount = false;

    protected bool $resetByClearButton = true;

    protected mixed $filterCallback = null;

    public array $config = [];

    protected ?string $filterPillTitle = null;

    protected array $filterPillValues = [];

    public ?string $filterPosition = null;

    protected ?string $filterCustomLabel = null;

    protected array $filterLabelAttributes = [];

    protected ?int $filterSlidedownRow = null;

    protected ?int $filterSlidedownColspan = null;

    protected ?string $filterCustomPillBlade = null;

    protected mixed $filterDefaultValue = null;

    public string $viewPath;

    public array $genericDisplayData = [];
}
