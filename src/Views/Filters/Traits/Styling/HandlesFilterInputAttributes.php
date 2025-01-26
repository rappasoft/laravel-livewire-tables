<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;

trait HandlesFilterInputAttributes
{
    protected array $filterInputAttributes = [];

    public function getInputAttributesBag(): ComponentAttributeBag
    {
        $attributes = array_merge($this->getCoreInputAttributes(), $this->getInputAttributes());
        ksort($attributes);

        return new ComponentAttributeBag($attributes);
    }

    protected function getInputAttributes(): array
    {
        return $this->filterInputAttributes;
    }

    protected function getCoreInputAttributes(): array
    {
        return [
            'id' => $this->getGenericDisplayData()['tableName'].'-filter-'.$this->getKey().($this->hasCustomPosition() ? '-'.$this->getCustomPosition() : ''),
            'default-styling' => true,
            'default-colors' => true,
        ];
    }

    public function setInputAttributes(array $filterInputAttributes): self
    {
        $this->filterInputAttributes = array_merge([
            'default-styling' => false,
            'default-colors' => false,
        ], $filterInputAttributes);

        return $this;
    }
}
