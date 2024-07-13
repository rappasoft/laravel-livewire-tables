<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{HasOptions,IsArrayFilter};

class MultiSelectFilter extends Filter
{
    use HasOptions,
        IsArrayFilter;
    use HasWireables;

    public string $wireMethod = 'live.debounce.250ms';

    protected string $view = 'livewire-tables::components.tools.filters.multi-select';

    protected string $configPath = 'livewire-tables.multiSelectFilter.defaultConfig';

    protected string $optionsPath = 'livewire-tables.multiSelectFilter.defaultOptions';

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

    public function getFilterPillValue($value): string|array|null
    {
        $values = [];

        foreach ($value as $item) {
            $found = $this->getCustomFilterPillValue($item) ?? $this->getOptions()[$item] ?? null;

            if ($found) {
                $values[] = $found;
            }
        }

        return $values;
    }
}
