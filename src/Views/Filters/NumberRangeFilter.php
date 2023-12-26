<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{HasOptions};

class NumberRangeFilter extends Filter
{
    use HasOptions;

    protected string $view = 'livewire-tables::components.tools.filters.number-range';

    protected string $configPath = 'livewire-tables.numberRange.defaultConfig';

    public function options(array $options = []): NumberRangeFilter
    {
        $this->options = [...config('livewire-tables.numberRange.defaultOptions'), ...$options];

        return $this;
    }

    public function getOptions(): array
    {
        return ! empty($this->options) ? $this->options : $this->options = config('livewire-tables.numberRange.defaultOptions');
    }

    public function config(array $config = []): NumberRangeFilter
    {
        $this->config = [...config('livewire-tables.numberRange.defaultConfig'), ...$config];

        return $this;
    }

    public function getConfigs(): array
    {
        return ! empty($this->config) ? $this->config : $this->config = config('livewire-tables.numberRange.defaultConfig');
    }

    public function validate(array $values): array|bool
    {
        $values['min'] = isset($values['min']) ? intval($values['min']) : null;
        $values['max'] = isset($values['max']) ? intval($values['max']) : null;
        if ($values['min'] == 0 && $values['max'] == 0) {
            return false;
        }
        if ($values['max'] < $values['min']) {
            $tmpMin = $values['min'];
            $values['min'] = $values['max'];
            $values['max'] = $tmpMin;
        }

        if (! isset($values['min']) || ! is_numeric($values['min']) || $values['min'] < intval($this->getConfig('minRange')) || $values['min'] > intval($this->getConfig('maxRange'))) {
            return false;
        }
        if (! isset($values['max']) || ! is_numeric($values['max']) || $values['max'] > intval($this->getConfig('maxRange')) || $values['max'] < intval($this->getConfig('minRange'))) {
            return false;
        }

        return ['min' => $values['min'], 'max' => $values['max']];
    }

    public function isEmpty(array|string $value): bool
    {
        if (! is_array($value)) {
            return true;
        } else {
            if (! isset($value['min']) || ! isset($value['max']) || $value['min'] == '' || $value['max'] == '') {
                return true;
            }

            if (intval($value['min']) == intval($this->getConfig('minRange')) && intval($value['max']) == intval($this->getConfig('maxRange'))) {
                return true;
            }
        }

        return false;
    }

    public function getDefaultValue(): array|string
    {
        return [];
    }

    public function getFilterPillValue($values): ?string
    {
        if ($this->validate($values)) {
            return __('Min:').$values['min'].', '.__('Max:').$values['max'];
        }

        return '';
    }
}
