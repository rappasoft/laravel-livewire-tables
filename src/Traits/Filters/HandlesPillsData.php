<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters\FilterPillData;

trait HandlesPillsData
{
    public function getPillDataForFilter(): array
    {
        $filters = [];

        foreach ($this->getAppliedFiltersWithValuesForPills() as $filterKey => $value) {
            if (! is_null($filter = $this->getFilterByKey($filterKey)) && ! $filter->isEmpty($filter->validate($value))) {
                $filters[$filter->getKey()] = FilterPillData::make(
                    filterKey: $filter->getKey(),
                    customPillBlade: $filter->getCustomPillBlade() ?? null,
                    filterPillsItemAttributes: array_merge($this->getFilterPillsItemAttributes(), ($filter->hasPillAttributes() ? $filter->getPillAttributes() : [])),

                    filterPillTitle: $filter->getFilterPillTitle(),
                    filterPillValue: $filter->getFilterPillValue($value),

                    hasCustomPillBlade: $filter->hasCustomPillBlade(),
                    isAnExternalLivewireFilter: (method_exists($filter, 'isAnExternalLivewireFilter') && $filter->isAnExternalLivewireFilter()),
                    separator: method_exists($filter, 'getPillsSeparator') ? $filter->getPillsSeparator() : ', ',
                    renderPillsAsHtml: $filter->getPillsAreHtml() ?? false,
                    renderPillsTitleAsHtml: $filter->getFilterPillTitleAsHtml() ?? false,
                    customResetButtonAttributes: $filter->getPillResetButtonAttributes(),

                );
            }
        }

        return $filters;
    }
}
