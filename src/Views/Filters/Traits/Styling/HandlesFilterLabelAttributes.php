<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;

trait HandlesFilterLabelAttributes
{
    protected array $filterLabelAttributes = [];

    public function getFilterLabelAttributes(): array
    {
        return [...['default' => true], ...$this->filterLabelAttributes];
    }

    public function hasFilterLabelAttributes(): bool
    {
        return $this->getFilterLabelAttributes() != ['default' => true] && $this->getFilterLabelAttributes() != ['default' => false];
    }

    public function setFilterLabelAttributes(array $filterLabelAttributes): self
    {
        $this->filterLabelAttributes = [...['default' => false], ...$filterLabelAttributes];

        return $this;
    }
}
