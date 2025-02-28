<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Livewire\Attributes\On;

trait HandlesLivewireComponentFilters
{
    protected bool $hasExternalFilters = false;

    public function tableHasExternalFilters(): bool
    {
        return $this->hasExternalFilters;
    }

    #[On('livewireArrayFilterUpdateValues')]
    public function updateLivewireArrayFilterValues(string $filterKey, string $tableName, array $values): void
    {
        if ($this->getTableName() == $tableName) {
            $filter = $this->getFilterByKey($filterKey);
            $filter->options($values);
        }
    }

    #[On('livewireArrayFilterUpdateValuesNew')]
    public function updateLivewireArrayFilterValuesNew(string $filterKey, string $tableName, array $values): void
    {
        $setup = ['original' => null, 'new' => null];

        if ($this->getTableName() == $tableName) {

            $setup['original'] = $this->getFilters();
            $filterArray = $this->filterCollection->toArray();
            foreach ($filterArray as $index => $filter) {
                if ($filter->getKey() == $filterKey) {
                    $options = collect($values)->pluck('value', 'id')->toArray();
                    $filter->options($options);
                    $filterArray[$index] = $filter;
                }
            }
            $this->filterCollection = collect($filterArray);
        }
    }
}
