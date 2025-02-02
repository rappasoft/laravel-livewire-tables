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
                if ($filter->isEmpty($value)) {
                    continue;
                }
                $isAnExternalLivewireFilter = (method_exists($filter, 'isAnExternalLivewireFilter') && $filter->isAnExternalLivewireFilter());
                $separator = method_exists($filter, 'getPillsSeparator') ? $filter->getPillsSeparator() : ', ';

                $filterPillAttributes = $this->getFilterPillsItemAttributes();

                if ($filter->hasPillAttributes()) {
                    $filterPillAttributes = array_merge($filterPillAttributes, $filter->getPillAttributes());
                }
                $filters[$filter->getKey()] = FilterPillData::make($filter->getFilterPillTitle(), $filterSelectName, $filter->getFilterPillValue($value), $separator, $isAnExternalLivewireFilter, $filter->hasCustomPillBlade(), $filter->getCustomPillBlade(), $filterPillAttributes);
            }
        }

        return $filters;
    }
}
