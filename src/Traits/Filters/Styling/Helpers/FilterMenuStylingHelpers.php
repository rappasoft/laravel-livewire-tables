<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Helpers;

use Livewire\Attributes\Computed;

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
}
