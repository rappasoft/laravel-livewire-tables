<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{IsStringFilter};

class TextFilter extends Filter
{
    use IsStringFilter;

    protected string $view = 'livewire-tables::components.tools.filters.text-field';

    public function validate(string $value): string|bool
    {
        if ($this->hasConfig('maxlength')) {
            return strlen($value) <= $this->getConfig('maxlength') ? $value : false;
        }

        return strlen($value) ? $value : false;
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }
}
