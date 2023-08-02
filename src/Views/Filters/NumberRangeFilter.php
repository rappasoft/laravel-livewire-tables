<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;

class NumberRangeFilter extends Filter
{
    protected array $options;

    protected array $config;

    public function options(array $options = []): NumberRangeFilter
    {
        $this->options = [...config('livewire-tables.numberRange.defaultOptions'), ...$options];
        /*\Illuminate\Support\Arr::map(\Illuminate\Support\Arr::dot($options), function (string $value, string $key) {
            \Illuminate\Support\Arr::set($this->options, $key, $value);

            return true;
        });*/

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function config(array $config = []): NumberRangeFilter
    {
        $this->config = [...config('livewire-tables.numberRange.defaultConfig'), ...$config];

        return $this;
    }

    public function validate(array $values): array|bool
    {
        if (! isset($values['min']) || ! is_numeric($values['min']) || $values['min'] < intval($this->getConfig('minRange')) || $values['min'] > intval($this->getConfig('maxRange'))) {
            $values['min'] = intval($this->getConfig('minRange'));
        }
        if (! isset($values['max']) || ! is_numeric($values['max']) || $values['max'] > intval($this->getConfig('maxRange')) || $values['max'] < intval($this->getConfig('minRange'))) {
            $values['max'] = intval($this->getConfig('maxRange'));
        }

        if ($values['max'] < $values['min']) {
            $tmpMin = $values['min'];
            $values['min'] = $values['max'];
            $values['max'] = $tmpMin;
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

    public function getDefaultValue(): array
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

    public function render(string $filterLayout, string $tableName, bool $isTailwind, bool $isBootstrap4, bool $isBootstrap5): \Illuminate\View\View|\Illuminate\View\Factory
    {

        return view('livewire-tables::components.tools.filters.number-range', [
            'filterLayout' => $filterLayout,
            'tableName' => $tableName,
            'isTailwind' => $isTailwind,
            'isBootstrap' => ($isBootstrap4 || $isBootstrap5),
            'isBootstrap4' => $isBootstrap4,
            'isBootstrap5' => $isBootstrap5,
            'filter' => $this,
        ]);
    }
}
