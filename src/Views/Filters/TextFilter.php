<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;

class TextFilter extends Filter
{
    public string $view = 'livewire-tables::components.tools.filters.text-field';

    public function validate(string $value): string|bool
    {
        if ($this->hasConfig('maxlength')) {
            return strlen($value) <= $this->getConfig('maxlength') ? $value : false;
        }

        return strlen($value) ? $value : false;
    }

    public function isEmpty(?string $value): bool
    {
        return is_null($value) || $value === '';
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }
}
