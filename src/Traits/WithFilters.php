<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\FilterHelpers;

trait WithFilters
{
    use FilterConfiguration,
        FilterHelpers;

    public bool $filtersStatus = true;

    public bool $filtersVisibilityStatus = true;

    public bool $filterPillsStatus = true;

    public bool $filterSlideDownDefaultVisible = false;

    public string $filterLayout = 'popover';

    public int $filterCount;

    protected $filterCollection;

    public array $filterComponents = [];

    public array $appliedFilters = [];

    public array $filterGenericData = [];

    public function filters(): array
    {
        return [];
    }

    protected function queryStringWithFilters(): array
    {
        if ($this->queryStringIsEnabled() && $this->filtersAreEnabled()) {
            return [
                'appliedFilters' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias().'-filters'],
            ];
        }

        return [];
    }

    public function applyFilters(): Builder
    {
        if ($this->filtersAreEnabled() && $this->hasFilters() && $this->hasAppliedFiltersWithValues()) {

            // Get Applied Filters With Values
            $appliedFilters = $this->getAppliedFiltersWithValues();

            // For Each Filter
            foreach ($this->getFilters() as $filter) {

                // If Filter is Applied
                if (isset($appliedFilters[$filter->getKey()])) {
                    // Validate The Filter, Unsetting If It Fails Validation
                    $value = $this->validateFilter($filter, $appliedFilters[$filter->getKey()]);
                    if ($value && $filter->hasFilterCallback()) {
                        ($filter->getFilterCallback())($this->getBuilder(), $value);
                    }
                }
            }
        }

        return $this->getBuilder();
    }
}
