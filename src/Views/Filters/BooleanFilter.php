<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;

class BooleanFilter extends Filter
{
    use HasWireables;

    public string $wireMethod = 'live';

    protected string $view = 'livewire-tables::components.tools.filters.boolean';

    public function validate(bool|int $value): bool
    {
        if (is_int($value) && ($value == 0 || $value == 1)) {
            $value = (bool) $value;
        }
        if (is_bool($value)) {
            return $value;
        }

        return false;
    }

    public function getFilterPillValue($value): array|string|bool|null
    {
        return $this->getCustomFilterPillValue($value);
    }

    public function isEmpty(bool|int|null $value): bool
    {
        return is_null($value);
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?bool
    {
        return $this->filterDefaultValue ?? null;
    }
}
