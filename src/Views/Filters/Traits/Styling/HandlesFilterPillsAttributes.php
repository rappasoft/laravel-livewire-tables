<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;

trait HandlesFilterPillsAttributes
{
    protected array $pillAttributes = [];

    public function getPillAttributesBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getPillAttributes());
    }

    public function hasPillAttributes(): bool
    {
        return !empty($this->pillAttributes);
    }

    public function getPillAttributes(): array
    {
        $attributes = array_merge(['default-colors' => true, 'default-styling' => true], $this->pillAttributes);
        ksort($attributes);
        return $attributes;
    }

    public function setPillAttributes(array $pillAttributes): self
    {
        $this->pillAttributes = array_merge([
            'default-colors' => true,
            'default-styling' => true,
        ], $pillAttributes);

        return $this;
    }

}
