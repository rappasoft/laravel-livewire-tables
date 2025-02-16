<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Rappasoft\LaravelLivewireTables\DataTableComponent;

trait HasDataTableComponent
{
    protected ?DataTableComponent $component = null;

    public function setComponent(DataTableComponent $component): self
    {
        $this->component = $component;

        return $this;
    }

    public function getComponent(): ?DataTableComponent
    {
        return $this->component;
    }
}