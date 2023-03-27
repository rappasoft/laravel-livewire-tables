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
    public $theme = null;
    protected Builder $builder;
    protected $model;
    protected $primaryKey;
    protected string $tableName = 'table';
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
    protected $collapsingColumnsStatus = true;
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

    /**
     * Set the custom query string array for this specific table
     *
     * @return array|\null[][]
     */
    public function queryString(): array
    {
        if ($this->queryStringIsEnabled()) {
            return [
                $this->getTableName() => ['except' => null, 'as' => $this->getQueryStringAlias()],
            ];
        }

        return [];
    }

    /**
     * Keep track of any properties on the custom query string key for this specific table
     *
     * @param $name
     * @param $value
     */
    public function updated($name, $value): void
    {
        if ($name === $this->getTableName().'.search') {
            $this->resetComputedPage();

            // Clear bulk actions on search
            $this->clearSelected();
            $this->setSelectAllDisabled();

            if ($value === '') {
                $this->clearSearch();
            }
        }

        if (Str::contains($name, $this->getTableName().'.filters')) {
            $this->resetComputedPage();

            // Clear bulk actions on filter
            $this->clearSelected();
            $this->setSelectAllDisabled();

            // Clear filters on empty value
            $filterName = Str::after($name, $this->getTableName().'.filters.');
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
