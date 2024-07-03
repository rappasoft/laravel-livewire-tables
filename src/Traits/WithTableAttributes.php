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

    protected ?object $thAttributesCallback;

    protected ?object $thSortButtonAttributesCallback;

    protected ?object $trAttributesCallback;

    protected ?object $tdAttributesCallback;

    protected ?object $trUrlCallback;

    protected ?object $trUrlTargetCallback;
}
