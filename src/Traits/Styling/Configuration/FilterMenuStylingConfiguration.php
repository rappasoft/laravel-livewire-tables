<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

use Closure;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait FilterMenuStylingConfiguration
{
    /**
     * Used to set attributes for the Filter Popover
     */
    public function setFilterPopoverAttributes(array $filterPopoverAttributes): self
    {
        $this->filterPopoverAttributes = array_merge($this->filterPopoverAttributes, $filterPopoverAttributes);

        return $this;
    }

    /**
     * Used to set attributes for the Filter Slidedown Wrapper
     */
    public function setFilterSlidedownWrapperAttributes(array $filterSlidedownWrapperAttributes): self
    {
        $this->filterSlidedownWrapperAttributes = array_merge($this->filterSlidedownWrapperAttributes, $filterSlidedownWrapperAttributes);

        return $this;
    }

    /**
     * Set a list of attributes to override on the th sort button elements
     */
    public function setFilterSlidedownRowAttributes(Closure $callback): self
    {
        $this->filterSlidedownRowCallback = $callback;

        return $this;
    }

    public function setFilterLayout(string $type): self
    {
        if (! in_array($type, ['popover', 'slide-down'], true)) {
            throw new DataTableConfigurationException('Invalid filter layout type');
        }

        $this->filterLayout = $type;

        return $this;
    }

    public function setFilterLayoutPopover(): self
    {
        $this->setFilterLayout('popover');

        return $this;
    }

    public function setFilterLayoutSlideDown(): self
    {
        $this->setFilterLayout('slide-down');

        return $this;
    }

    public function setFilterSlideDownDefaultStatus(bool $status): self
    {
        $this->filterSlideDownDefaultVisible = $status;

        return $this;
    }

    public function setFilterSlideDownDefaultStatusDisabled(): self
    {
        $this->setFilterSlideDownDefaultStatus(false);

        return $this;
    }

    public function setFilterSlideDownDefaultStatusEnabled(): self
    {
        $this->setFilterSlideDownDefaultStatus(true);

        return $this;
    }
}
