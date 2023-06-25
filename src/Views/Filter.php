<?php

namespace Rappasoft\LaravelLivewireTables\Views;

use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\FilterHelpers;

abstract class Filter
{
    use FilterConfiguration,
        FilterHelpers;

    protected string $name;

    protected string $key;

    protected bool $hiddenFromMenus = false;

    protected bool $hiddenFromPills = false;

    protected bool $hiddenFromFilterCount = false;

    protected bool $resetByClearButton = true;

    protected $filterCallback = null;

    protected array $config = [];

    protected ?string $filterPillTitle = null;

    protected array $filterPillValues = [];

    public ?string $filterPosition = null;

    protected ?string $filterCustomLabel = null;

    protected ?int $filterSlidedownRow = null;

    protected ?int $filterSlidedownColspan = null;

    protected ?string $filterCustomPillBlade = null;

    protected $filterDefaultValue;

    public function __construct(string $name, string $key = null)
    {
        $this->name = $name;

        if ($key) {
            $this->key = $key;
        } else {
            $this->key = Str::snake($name);
        }
    }

    /**
     * @return static
     */
    public static function make(string $name, string $key = null): Filter
    {
        return new static($name, $key);
    }

    abstract public function isEmpty(string $value): bool;

    abstract public function render(DataTableComponent $component);
}
