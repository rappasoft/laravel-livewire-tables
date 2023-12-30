<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasVisibility as HasCoreVisibility;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait HasVisibility
{
    use HasCoreVisibility;

    protected bool $hiddenFromFilterCount = false;

    public function isHiddenFromFilterCount(): bool
    {
        return $this->hiddenFromFilterCount === true;
    }

    public function isVisibleInFilterCount(): bool
    {
        return $this->hiddenFromFilterCount === false;
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
