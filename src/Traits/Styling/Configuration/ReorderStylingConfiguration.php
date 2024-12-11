<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait ReorderStylingConfiguration
{
    /**
     * Used to set attributes for the <th> for Reorder Column
     */
    public function setReorderThAttributes(array $reorderThAttributes): self
    {
        $this->reorderThAttributes = [...$this->reorderThAttributes, ...$reorderThAttributes];

        return $this;
    }
}
