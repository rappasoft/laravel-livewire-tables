<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling\HandlesFilterLabelAttributes;

trait HasFilterLabel
{
    use HandlesFilterLabelAttributes;

    protected ?string $filterCustomLabel = null;

    public function setCustomFilterLabel(string $filterCustomLabel): self
    {
        $this->filterCustomLabel = $filterCustomLabel;

        return $this;
    }

    /**
     * Returns whether the filter has a custom label blade
     */
    public function hasCustomFilterLabel(): bool
    {
        return ! is_null($this->filterCustomLabel);
    }

    /**
     * Returns the path to the custom filter label blade
     */
    public function getCustomFilterLabel(): string
    {
        return $this->filterCustomLabel ?? '';
    }
}
