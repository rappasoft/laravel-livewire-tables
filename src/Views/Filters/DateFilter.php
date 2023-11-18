<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use DateTime;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class DateFilter extends Filter
{
    public string $viewPath = 'livewire-tables::components.tools.filters.date';

    public function config(array $config = []): DateFilter
    {
        $this->config = [...config('livewire-tables.dateFilter.defaultConfig'), ...$config];

        return $this;
    }

    public function validate(string $value): string|bool
    {
        if (DateTime::createFromFormat('Y-m-d', $value) === false) {
            return false;
        }

        return $value;
    }

    public function isEmpty($value): bool
    {
        return $value === '';
    }

    public function getFilterPillValue($value): ?string
    {
        if ($this->validate($value)) {
            return DateTime::createFromFormat('Y-m-d', $value)->format($this->getConfig('pillFormat'));
        }

        return null;
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }

    public function render(): string|\Illuminate\Contracts\Foundation\Application|\Illuminate\View\View|\Illuminate\View\Factory
    {
        return view($this->getViewPath(), $this->getFilterDisplayData());
    }
}
