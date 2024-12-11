<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{HasOptions, IsArrayFilter, IsLivewireComponentFilter};

class LivewireComponentArrayFilter extends Filter
{
    use HasWireables;
    use IsArrayFilter;
    use HasOptions;
    use IsLivewireComponentFilter;

    public string $wireMethod = 'blur';

    protected string $view = 'livewire-tables::components.tools.filters.livewire-component-array-filter';

    public function validate(array $value): array|bool
    {

        return $value;
    }

    public function isEmpty(array $value = []): bool
    {
        return empty($value);
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }

    public function getFilterPillValue($value): array|string|bool|null
    {
        $values = [];
        foreach ($value as $key => $item) {

            $found = $this->getCustomFilterPillValue($item) ?? ($this->options[$item] ?? $item);
            if ($found) {
                $values[] = $found;
            }
        }

        return $values;
    }

    public function getKeys(): array
    {
        return array_keys($this->options ?? []);
    }
}
