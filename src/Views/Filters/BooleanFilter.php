<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;

class BooleanFilter extends Filter
{
    use HasWireables;

    public string $wireMethod = 'live';

    protected string $view = 'livewire-tables::components.tools.filters.boolean';

    public function validate(bool $value): bool
    {
       return is_bool($value);
    }

    public function getFilterPillValue($value): array|string|bool|null
    {
        return $this->getCustomFilterPillValue($value);
    }
    
    public function isEmpty(?string $value): bool
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
