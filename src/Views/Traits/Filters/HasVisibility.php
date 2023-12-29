<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait HasVisibility
{
    protected bool $hiddenFromMenus = false;

    protected bool $hiddenFromPills = false;

    protected bool $hiddenFromFilterCount = false;

    public function isHiddenFromMenus(): bool
    {
        return $this->hiddenFromMenus === true;
    }

    public function isVisibleInMenus(): bool
    {
        return $this->hiddenFromMenus === false;
    }

    public function isHiddenFromPills(): bool
    {
        return $this->hiddenFromPills === true;
    }

    public function isVisibleInPills(): bool
    {
        return $this->hiddenFromPills === false;
    }

    public function isHiddenFromFilterCount(): bool
    {
        return $this->hiddenFromFilterCount === true;
    }

    public function isVisibleInFilterCount(): bool
    {
        return $this->hiddenFromFilterCount === false;
    }

    public function hiddenFromMenus(): self
    {
        $this->hiddenFromMenus = true;

        return $this;
    }

    public function hiddenFromPills(): self
    {
        $this->hiddenFromPills = true;

        return $this;
    }

    public function hiddenFromFilterCount(): self
    {
        $this->hiddenFromFilterCount = true;

        return $this;
    }

    public function hiddenFromAll(): self
    {
        $this->hiddenFromMenus = true;
        $this->hiddenFromPills = true;
        $this->hiddenFromFilterCount = true;

        return $this;
    }
}
