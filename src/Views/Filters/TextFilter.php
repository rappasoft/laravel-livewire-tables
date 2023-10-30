<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;

class TextFilter extends Filter
{
    public function validate(string $value): string|bool
    {
        if ($this->hasConfig('maxlength')) {
            return strlen($value) <= $this->getConfig('maxlength') ? $value : false;
        }

        return strlen($value) ? $value : false;
    }

    public function isEmpty($value): bool
    {
        return $value === '';
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }

    public function render(array $filterGenericData): string|\Illuminate\Contracts\Foundation\Application|\Illuminate\View\View|\Illuminate\View\Factory
    {
        return view('livewire-tables::components.tools.filters.text-field', [
            'filterLayout' => $filterGenericData['filterLayout'],
            'tableName' => $filterGenericData['tableName'],
            'isTailwind' => $filterGenericData['isTailwind'],
            'isBootstrap' => ($filterGenericData['isBootstrap4'] || $filterGenericData['isBootstrap5']),
            'isBootstrap4' => $filterGenericData['isBootstrap4'],
            'isBootstrap5' => $filterGenericData['isBootstrap5'],
            'filter' => $this,
        ]);
    }
}
