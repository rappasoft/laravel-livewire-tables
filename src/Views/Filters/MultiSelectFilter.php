<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;

class MultiSelectFilter extends Filter
{
    public array $options = [];

    protected string $firstOption = '';

    public function setFirstOption(string $firstOption): MultiSelectFilter
    {
        $this->firstOption = $firstOption;

        return $this;
    }

    public function getFirstOption(): string
    {
        return $this->firstOption;
    }

    public function options(array $options = []): MultiSelectFilter
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
            ->keys()
            ->map(fn ($value) => (string) $value)
            ->filter(fn ($value) => strlen($value))
            ->values()
            ->toArray();
    }

    public function validate(int|string|array $value): array|int|string|bool
    {
        if (is_array($value)) {
            foreach ($value as $index => $val) {
                // Remove the bad value
                if (! in_array($val, $this->getKeys())) {
                    unset($value[$index]);
                }
            }
        }

        return $value;
    }

    /**
     * Get the filter default options.
     */
    public function getDefaultValue(): array
    {
        return [];
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): array
    {
        return $this->filterDefaultValue ?? [];
    }

    public function getFilterPillValue($value): ?string
    {
        $values = [];

        foreach ($value as $item) {
            $found = $this->getCustomFilterPillValue($item) ?? $this->getOptions()[$item] ?? null;

            if ($found) {
                $values[] = $found;
            }
        }

        return implode(', ', $values);
    }

    public function isEmpty($value): bool
    {
        return ! is_array($value);
    }

    public function render(string $filterLayout, string $tableName, bool $isTailwind, bool $isBootstrap4, bool $isBootstrap5): string|\Illuminate\Contracts\Foundation\Application|\Illuminate\View\View|\Illuminate\View\Factory
    {
        return view('livewire-tables::components.tools.filters.multi-select', [
            'filterLayout' => $filterLayout,
            'tableName' => $tableName,
            'isTailwind' => $isTailwind,
            'isBootstrap' => ($isBootstrap4 || $isBootstrap5),
            'isBootstrap4' => $isBootstrap4,
            'isBootstrap5' => $isBootstrap5,
            'filter' => $this,
        ]);
    }
}
