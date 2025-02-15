<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

trait IsCollapsible
{
    protected bool $collapseOnMobile = false;

    protected bool $collapseOnTablet = false;

    protected bool $collapseAlways = false;

    protected bool $collapseSometimes = false;

    public function collapseOnMobile(): self
    {
        $this->collapseOnMobile = true;
        $this->collapseSometimes = true;

        return $this;
    }

    public function shouldCollapseOnMobile(): bool
    {
        return $this->collapseOnMobile;
    }

    /**
     * @return $this
     */
    public function collapseOnTablet(): self
    {
        $this->collapseOnTablet = true;
        $this->collapseSometimes = true;

        return $this;
    }

    public function shouldCollapseOnTablet(): bool
    {
        return $this->collapseOnTablet;
    }

    public function collapseAlways(): self
    {
        $this->collapseAlways = true;
        $this->collapseSometimes = true;

        return $this;
    }

    public function shouldCollapseAlways(): bool
    {
        return $this->collapseAlways;
    }

    public function shouldCollapseSometimes(): bool
    {
        return $this->collapseSometimes;
    }

    public function shouldNeverCollapse(): bool
    {
        return $this->collapseSometimes === false;
    }

    public function shouldCollapseNever(): bool
    {
        return ($this->shouldCollapseOnMobile() === false) && ($this->shouldCollapseOnTablet() === false) && ($this->shouldCollapseAlways() === false);
    }
}
