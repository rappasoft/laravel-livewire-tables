<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

trait HandlesPillsData
{
    public function getPillDataForFilter(): array
    {
        $filters = [];

        foreach ($this->getAppliedFiltersWithValuesForPills() as $filterSelectName => $value) {
            if (! is_null($filter = $this->getFilterByKey($filterSelectName))) {
                if ($filter->isEmpty($value)) {
                    continue;
                }
                $filterPillValue = $filter->getFilterPillValue($value);
                $filterPillTitle = $filter->getFilterPillTitle();

                $filters[$filter->getKey()] = [
                    'filter' => $filter,
                    'isAnExternalLivewireFilter' => (method_exists($filter, 'isAnExternalLivewireFilter') && $filter->isAnExternalLivewireFilter()),
                    'filterSelectName' => $filterSelectName,
                    'filterPillTitle' => $filterPillTitle,
                    'filterPillValue' => $filterPillValue,
                    'separator' => method_exists($filter, 'getPillsSeparator') ? $filter->getPillsSeparator() : ', ',
                ];
            }
        }

        return $filters;
    }
}
