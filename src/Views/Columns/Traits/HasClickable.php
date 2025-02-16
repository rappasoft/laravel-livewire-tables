<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

trait HasClickable
{
    protected bool $clickable = true;

    protected bool $hasTableRowUrl = false;

    public function isClickable(): bool
    {
        return $this->clickable &&
            $this->getHasTableRowUrl() &&
            ! $this instanceof LinkColumn;
    }

    public function getHasTableRowUrl(): bool
    {
        return $this->hasTableRowUrl;
    }

    public function unclickable(): self
    {
        $this->clickable = false;

        return $this;
    }

    public function setHasTableRowUrl(bool $hasTableRowUrl): self
    {
        $this->hasTableRowUrl = $hasTableRowUrl;

        return $this;
    }
}
