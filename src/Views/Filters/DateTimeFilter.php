<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use DateTime;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class DateTimeFilter extends Filter
{
    public string $viewPath = 'livewire-tables::components.tools.filters.datetime';

    public function config(array $config = []): DateTimeFilter
    {
        $this->config = [...config('livewire-tables.dateTimeFilter.defaultConfig'), ...$config];

        return $this;
    }

    public function validate(string $value): string|bool
    {
        if (DateTime::createFromFormat('Y-m-d\TH:i', $value) === false) {
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
            return DateTime::createFromFormat('Y-m-d\TH:i', $value)->format($this->getConfig('pillFormat'));
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
