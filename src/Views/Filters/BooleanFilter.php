<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\HasWireables;

class BooleanFilter extends Filter
{
    use HasWireables;

    public string $wireMethod = 'live';

    protected string $view = 'livewire-tables::components.tools.filters.boolean';

    public function validate(bool|int|string|null $value): bool
    {
        if ($value === null) {
            return false;
        } elseif (is_string($value)) {
            if ($value == '0' || $value == '1') {
                $value = (int) $value;
            } else {
                return false;
            }
        }
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

    public function isEmpty(bool|int|string|null $value): bool
    {
        if (is_null($value)) {
            return true;
        } elseif (is_string($value)) {
            return $value != '0' && $value != '1';
        } elseif (is_int($value)) {
            return $value != 0 && $value != 1;
        } elseif (is_bool($value)) {
            return false;
        }

        return true;
    }

    protected function getCoreInputAttributes(): array
    {
        $attributes = array_merge(parent::getCoreInputAttributes(),
            [
                '@click' => 'toggleStatusWithUpdate',
                'activeColor' => 'bg-blue-600',
                'blobColor' => 'bg-white',
                'inactiveColor' => 'bg-neutral-200',
                'type' => 'button',
                'x-ref' => 'switchButton',
            ]);
        ksort($attributes);

        return $attributes;
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?bool
    {
        return $this->filterDefaultValue ?? null;
    }
}
