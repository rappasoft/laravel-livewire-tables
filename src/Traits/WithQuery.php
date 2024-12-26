<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\QueryConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\QueryHelpers;

trait WithQuery
{
    use QueryConfiguration,
        QueryHelpers;

    protected Builder $builder;

    protected ?string $primaryKey;

    protected array $relationships = [];

    protected array $additionalSelects = [];

    protected array $extraWiths = [];

    protected array $extraWithCounts = [];

    protected array $extraWithSums = [];

    protected array $extraWithAvgs = [];

    protected bool $eagerLoadAllRelationsStatus = false;
}
