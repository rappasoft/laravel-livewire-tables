<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters\FilterPillData;

trait HandlesPillsData
{
    public function getPillDataForFilter(): array
    {
        $filters = [];

        foreach ($this->getAppliedFiltersWithValuesForPills() as $filterSelectName => $value) {
            if (! is_null($filter = $this->getFilterByKey($filterSelectName))) {
                // if ($filter->isEmpty($value)) {
                //     continue;
                // }
                $customPillBlade = null;
                $hasCustomPillBlade = $filter->hasCustomPillBlade();
                $isAnExternalLivewireFilter = (method_exists($filter, 'isAnExternalLivewireFilter') && $filter->isAnExternalLivewireFilter());
                $separator = method_exists($filter, 'getPillsSeparator') ? $filter->getPillsSeparator() : ', ';
                $separatedValues = null;

                //  dd($value);

                if ($hasCustomPillBlade) {
                    $customPillBlade = $filter->getCustomPillBlade();
                }

                if (is_array($value) && ! empty($value)) {
                    $separatedValues = implode($separator, $filter->getFilterPillValue($value));
                }

                $filters[$filter->getKey()] = FilterPillData::make(
                    customPillBlade: $customPillBlade,
                    filterPillsItemAttributes: array_merge($this->getFilterPillsItemAttributes(), ($filter->hasPillAttributes() ? $filter->getPillAttributes() : [])),

                    filterPillTitle: $filter->getFilterPillTitle(),
                    filterPillValue: $filter->getFilterPillValue($value),

                    filterSelectName: $filterSelectName,

                    hasCustomPillBlade: $hasCustomPillBlade,
                    isAnExternalLivewireFilter: $isAnExternalLivewireFilter,
                    separatedValues: $separatedValues,
                    separator: method_exists($filter, 'getPillsSeparator') ? $filter->getPillsSeparator() : ', ',
                    renderPillsAsHtml: $filter->getPillsAreHtml() ?? false,
                    customResetButtonAttributes: $filter->getPillResetButtonAttributes(),

                );
            }
        }

        return $filters;
    }
}
