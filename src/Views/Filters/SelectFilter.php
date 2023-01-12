<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class SelectFilter extends Filter
{
    protected array $options = [];

    protected string $firstOption = "";

    public function options(array $options = []): SelectFilter
    {
        $this->options = $options;

        return $this;
    }

    public function setFirstOption(string $firstOption): SelectFilter
    {
        $this->firstOption = $firstOption;

        return $this;
    }

    public function getFirstOption(): string
    {
        return $this->firstOption;
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
            ->map(fn ($value) => (string)$value)
            ->filter(fn ($value) => strlen($value) > 0)
            ->values()
            ->toArray();
    }

    public function validate($value)
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

    public function render(DataTableComponent $component)
    {
        return view('livewire-tables::components.tools.filters.select', [
            'component' => $component,
            'filter' => $this,
        ]);
    }
}
