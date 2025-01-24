<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Configuration;

use Closure;

trait FilterMenuStylingConfiguration
{
    /**
     * Used to set attributes for the Filter Popover
     */
    public function setFilterPopoverAttributes(array $attributes): self
    {
        return $this->mergeCustomAttributes(propertyName: 'filterPopoverAttributes', customAttributes: $attributes);
    }

    /**
     * Used to set attributes for the Filter Slidedown Wrapper
     */
    public function setFilterSlidedownWrapperAttributes(array $attributes): self
    {
        return $this->mergeCustomAttributes(propertyName: 'filterSlidedownWrapperAttributes', customAttributes: $attributes);
    }

    /**
     * Set a list of attributes to override on the th sort button elements
     */
    public function setFilterSlidedownRowAttributes(Closure $callback): self
    {
        $this->filterSlidedownRowCallback = $callback;

        return $this;
    }
}
