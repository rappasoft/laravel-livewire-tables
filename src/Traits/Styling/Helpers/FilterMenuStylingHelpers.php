<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Illuminate\Support\Arr;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterMenuStylingHelpers
{
    /**
     * Used to get attributes for the Filter Popover
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getFilterPopoverAttributes(): array
    {
        return $this->filterPopoverAttributes;

    }

    /**
     * Used to get attributes for the Filter Slidedown Wrapper
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getFilterSlidedownWrapperAttributes(): array
    {
        return $this->filterSlidedownWrapperAttributes;

    }

    /**
     * Used to get attributes for the Filter Slidedown Row
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getFilterSlidedownRowAttributes(string $rowIndex): array
    {

        if (isset($this->filterSlidedownRowCallback)) {
            return array_merge(['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => (int) $rowIndex], call_user_func($this->filterSlidedownRowCallback, (int) $rowIndex));
        }

        return ['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => (int) $rowIndex];
    }

    public function getFilterSlideDownDefaultStatus(): bool
    {
        return $this->filterSlideDownDefaultVisible;
    }

    public function filtersSlideDownIsDefaultVisible(): bool
    {
        return $this->getFilterSlideDownDefaultStatus() === true;
    }

    public function filtersSlideDownIsDefaultHidden(): bool
    {
        return $this->getFilterSlideDownDefaultStatus() === false;
    }

    public function getFilterLayout(): string
    {
        return $this->filterLayout;
    }

    public function isFilterLayoutPopover(): bool
    {
        return $this->getFilterLayout() === 'popover';
    }

    public function isFilterLayoutSlideDown(): bool
    {
        return $this->getFilterLayout() === 'slide-down';
    }

    /**
     * Get whether any filter has a configured slide down row.
     */
    public function hasFiltersWithSlidedownRows(): bool
    {
        return $this->getFilters()
            ->reject(fn (Filter $filter) => ! $filter->hasFilterSlidedownRow())
            ->count() > 0;
    }

    /**
     * Get filters sorted by row
     *
     * @return array<mixed>
     */
    public function getFiltersByRow(): array
    {
        $orderedFilters = [];
        $filterList = ($this->hasFiltersWithSlidedownRows()) ? $this->getVisibleFilters()->sortBy('filterSlidedownRow') : $this->getVisibleFilters();
        if ($this->hasFiltersWithSlidedownRows()) {
            foreach ($filterList as $filter) {
                $orderedFilters[(string) $filter->getFilterSlidedownRow()][] = $filter;
            }

            if (empty($orderedFilters['1'])) {
                $orderedFilters['1'] = (isset($orderedFilters['99']) ? $orderedFilters['99'] : []);
                if (isset($orderedFilters['99'])) {
                    unset($orderedFilters['99']);
                }
            }
        } else {
            $orderedFilters = Arr::wrap($filterList);
            $orderedFilters['1'] = $orderedFilters['0'] ?? [];
            if (isset($orderedFilters['0'])) {
                unset($orderedFilters['0']);
            }
        }
        ksort($orderedFilters);

        return $orderedFilters;
    }
}
