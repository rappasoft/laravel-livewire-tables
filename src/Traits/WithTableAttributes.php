<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Closure;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\TableAttributeConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\TableAttributeHelpers;

trait WithTableAttributes
{
    use TableAttributeConfiguration,
        TableAttributeHelpers;

    protected array $componentWrapperAttributes = [];

    protected array $tableWrapperAttributes = [];

    protected array $tableAttributes = [];

    protected array $theadAttributes = [];

    protected array $tbodyAttributes = [];

    protected ?Closure $thAttributesCallback;

    protected ?Closure $thSortButtonAttributesCallback;

    protected ?Closure $thSortIconAttributesCallback;

    protected ?Closure $trAttributesCallback;

    protected ?Closure $tdAttributesCallback;

    protected ?Closure $trUrlCallback;

    protected ?Closure $trUrlTargetCallback;

    public bool $shouldBeDisplayed = true;
}
