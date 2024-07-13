<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{HasOptions,IsArrayFilter};

class MultiSelectDropdownFilter extends Filter
{
    use HasOptions,
        IsArrayFilter;
    use HasWireables;

    public string $wireMethod = 'live.debounce.250ms';

    protected string $view = 'livewire-tables::components.tools.filters.multi-select-dropdown';

    protected string $configPath = 'livewire-tables.multiSelectDropdownFilter.defaultConfig';

    protected string $optionsPath = 'livewire-tables.multiSelectDropdownFilter.defaultOptions';

    public function validate(int|string|array $value): array|int|string|bool
    {
        if (is_array($value)) {
            foreach ($value as $index => $val) {
                // Remove the bad value
                if (! in_array($val, $this->getKeys())) {
                    unset($value[$index]);
                }
            }

            return $value;
        }

        return (is_string($value) || is_numeric($value)) ? $value : false;
    }

    public function getFilterPillValue($value): string|array|null
    {
        $values = [];

        foreach ($value as $item) {
            $found = $this->getCustomFilterPillValue($item)
                        ?? (new Collection($this->getOptions()))
                            ->mapWithKeys(fn ($options, $optgroupLabel) => is_iterable($options) ? $options : [$optgroupLabel => $options])[$item]
                        ?? null;

            if ($found) {
                $values[] = $found;
            }
        }

        return $values;
    }

    public function isEmpty(mixed $value): bool
    {
        if (! is_array($value)) {
            return true;
        } elseif (in_array('all', $value)) {
            return true;
        }

        return false;
    }
}
