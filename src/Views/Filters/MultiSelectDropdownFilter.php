<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class MultiSelectDropdownFilter extends Filter
{
    protected array $options = [];
    protected string $firstOption = "";

    public function options(array $options = []): MultiSelectDropdownFilter
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setFirstOption(string $firstOption): MultiSelectDropdownFilter
    {
        $this->firstOption = $firstOption;

        return $this;
    }

    public function getFirstOption(): string
    {
        return $this->firstOption;
    }

    public function getKeys(): array
    {
        return collect($this->getOptions())
            ->keys()
            ->map(fn ($value) => (string)$value)
            ->filter(fn ($value) => strlen($value))
            ->values()
            ->toArray();
    }

    public function validate($value)
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

    public function getDefaultValue()
    {
        return [];
    }

    public function getFilterPillValue($value): ?string
    {
        $values = [];

        foreach ($value as $item) {
            $found = $this->getCustomFilterPillValue($item)
                        ?? collect($this->getOptions())
                            ->mapWithKeys(fn ($options, $optgroupLabel) => is_iterable($options) ? $options : [$optgroupLabel => $options])[$item]
                        ?? null;

            if ($found) {
                $values[] = $found;
            }
        }

        return implode(', ', $values);
    }

    public function isEmpty($value): bool
    {
        if (! is_array($value)) {
            return true;
        } elseif (in_array("all", $value)) {
            return true;
        }

        return false;
    }

    public function render(DataTableComponent $component)
    {
        return view('livewire-tables::components.tools.filters.multi-select-dropdown', [
            'component' => $component,
            'filter' => $this,
        ]);
    }
}
