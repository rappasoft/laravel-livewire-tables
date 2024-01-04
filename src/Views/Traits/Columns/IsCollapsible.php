<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Columns;

use Closure;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait IsCollapsible
{
    protected bool $collapseOnMobile = false;

    protected bool $collapseOnTablet = false;

    protected bool $collapseAlways = false;

    public function collapseOnMobile(): self
    {
        $this->collapseOnMobile = true;

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

        return $this;
    }

    public function shouldCollapseOnTablet(): bool
    {
        return $this->collapseOnTablet;
    }

    public function collapseAlways(): self
    {
        $this->collapseAlways = true;

        return $this;
    }

    public function shouldCollapseAlways(): bool
    {
        return $this->collapseAlways;
    }
}
