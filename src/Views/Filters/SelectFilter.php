<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;

class SelectFilter extends Filter
{
    public array $options = [];

    public function options(array $options = []): SelectFilter
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getKeys(): array
    {
        return collect($this->getOptions())
            ->map(fn ($value, $key) => is_iterable($value) ? collect($value)->keys() : $key)
            ->flatten()
            ->map(fn ($value) => (string) $value)
            ->filter(fn ($value) => strlen($value) > 0)
            ->values()
            ->toArray();
    }

    public function validate(string $value): array|string|bool
    {
        if (! in_array($value, $this->getKeys())) {
            return false;
        }

        return $value;
    }

    public function getFilterPillValue($value): ?string
    {
        return $this->getCustomFilterPillValue($value)
            ?? collect($this->getOptions())
                ->mapWithKeys(fn ($options, $optgroupLabel) => is_iterable($options) ? $options : [$optgroupLabel => $options])[$value]
            ?? null;
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
        return view('livewire-tables::components.tools.filters.select', [
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
