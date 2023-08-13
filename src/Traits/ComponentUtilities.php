<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\ComponentConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ComponentHelpers;

trait ComponentUtilities
{
    use ComponentConfiguration,
        ComponentHelpers;

    public array $table = [];

    public ?string $theme = null;

    protected Builder $builder;

    protected $model;

    protected ?string $primaryKey;

    protected array $relationships = [];

    protected string $tableName = 'table';

    protected ?string $dataTableFingerprint;

    protected ?string $queryStringAlias;

    protected bool $queryStringStatus = true;

    protected bool $offlineIndicatorStatus = true;

    protected bool $eagerLoadAllRelationsStatus = false;

    protected array $componentWrapperAttributes = [];

    protected array $tableWrapperAttributes = [];

    protected array $tableAttributes = [];

    protected array $theadAttributes = [];

    protected array $tbodyAttributes = [];

    protected $thAttributesCallback;

    protected $thSortButtonAttributesCallback;

    protected $trAttributesCallback;

    protected $trUrlCallback;

    protected $trUrlTargetCallback;

    protected $tdAttributesCallback;

    protected bool $collapsingColumnsStatus = true;

    protected string $emptyMessage = 'No items found. Try to broaden your search.';

    protected array $additionalSelects = [];

    protected bool $hideConfigurableAreasWhenReorderingStatus = true;

    protected array $configurableAreas = [
        'before-tools' => null,
        'toolbar-left-start' => null,
        'toolbar-left-end' => null,
        'toolbar-right-start' => null,
        'toolbar-right-end' => null,
        'before-toolbar' => null,
        'after-toolbar' => null,
        'before-pagination' => null,
        'after-pagination' => null,
    ];

    // Sets the Theme If Not Already Set
    public function mountComponentUtilities(): void
    {
        // Sets the Theme - tailwind/bootstrap
        if (is_null($this->theme)) {
            $this->setTheme();
        }
    }

    /**
     * Set the custom query string array for this specific table
     *
     * @return array<mixed>
     */
    protected function queryString(): array
    {
        if ($this->queryStringIsEnabled()) {
            return [
                $this->getTableName() => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias()],
                'appliedFilters' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias().'-filters'],
                'search' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias().'-search'],
                'columns' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias().'-columns'],
                'sorts' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias().'-sorts'],
            ];
        }

        return [];
    }

    /**
     * Keep track of any properties on the custom query string key for this specific table
     */
    public function updated(string $name, string|array $value): void
    {
        if ($name === 'search') {
            $this->resetComputedPage();

            // Clear bulk actions on search
            $this->clearSelected();
            $this->setSelectAllDisabled();

            if ($value === '') {
                $this->clearSearch();
            }
        }

        if (Str::contains($name, 'filterComponents')) {
            $this->resetComputedPage();

            // Clear bulk actions on filter
            $this->clearSelected();
            $this->setSelectAllDisabled();

            // Clear filters on empty value
            $filterName = Str::after($name, 'filterComponents.');
            $filter = $this->getFilterByKey($filterName);

            if ($filter && $filter->isEmpty($value)) {
                $this->resetFilter($filterName);
            }
        }
    }

    /**
     * 1. After the sorting method is hit we need to tell the table to go back into reordering mode
     */
    public function hydrate(): void
    {
        $this->restartReorderingIfNecessary();
    }
}
