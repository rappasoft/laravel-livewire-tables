<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{HasOptions,IsStringFilter};

class SelectFilter extends Filter
{
    use HasOptions,
        IsStringFilter;
    use HasWireables;

    public string $wireMethod = 'live';

    protected string $view = 'livewire-tables::components.tools.filters.select';

    protected string $configPath = 'livewire-tables.selectFilter.defaultConfig';

    protected string $optionsPath = 'livewire-tables.selectFilter.defaultOptions';

    public function getKeys(): array
    {
        return (new Collection($this->getOptions()))
            ->map(fn ($value, $key) => is_iterable($value) ? (new Collection($value))->keys() : $key)
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

    public function getFilterPillValue($value): string|array|null
    {

        return $this->getCustomFilterPillValue($value)
            ?? (new Collection($this->getOptions()))
                ->mapWithKeys(fn ($options, $optgroupLabel) => is_iterable($options) ? $options : [$optgroupLabel => $options])[$value]
            ?? null;
    }
}
