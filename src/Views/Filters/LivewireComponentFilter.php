<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\{HasWireables, IsLivewireComponentFilter};

class LivewireComponentFilter extends Filter
{
    use HasWireables;
    use IsLivewireComponentFilter;

    public string $wireMethod = 'blur';

    protected string $view = 'livewire-tables::components.tools.filters.livewire-component-filter';

    public function validate(string $value): string|bool
    {
        return $value;
    }

    public function isEmpty(?string $value): bool
    {
        return is_null($value) || $value === '';
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }
}
