<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;

class NumberRangeFilter extends Filter
{
    /**
     * @var array<mixed>
     */
    protected array $options = [];

    public function __construct(string $name, string $key = null)
    {
        parent::__construct($name, (isset($key) ? $key : null));
        $this->config = config('livewire-tables.numberRange');

        $this->options = config('livewire-tables.numberRange.defaults');
    }

    /**
     * @param  array<mixed>  $options
     * @return $this
     */
    public function options($options = []): NumberRangeFilter
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * @return array<mixed>
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param  array<mixed>  $config
     * @return $this
     */
    public function config($config = []): NumberRangeFilter
    {

        \Illuminate\Support\Arr::map(\Illuminate\Support\Arr::dot($config), function (string $value, string $key) {
            \Illuminate\Support\Arr::set($this->config, $key, $value);

            return true;
        });

        return $this;
    }

    public function validate(array $values): array|bool
    {
        if (!isset($values['min']) || !is_numeric($values['min']) || $values['min'] < intval($this->getConfig('minRange')) || $values['min'] > intval($this->getConfig('maxRange')))
        {
            $values['min'] = intval($this->getConfig('minRange'));
        }
        if (!isset($values['max']) || !is_numeric($values['max']) || $values['max'] > intval($this->getConfig('maxRange')) || $values['max'] < intval($this->getConfig('minRange')))
        {
            $values['max'] = intval($this->getConfig('maxRange'));
        }

        if ($values['max'] < $values['min']) {
            $tmpMin = $values['min'];
            $values['min'] = $values['max'];
            $values['max'] = $tmpMin;
        }

        return ['min' => $values['min'], 'max' => $values['max']];
    }

    /**
     * @param  array<mixed>|string  $value
     */
    public function isEmpty($value): bool
    {
        if (! is_array($value)) {
            return true;
        } else {
            if (! isset($value['min']) || ! isset($value['max'])) {
                return true;
            }

            if ($value['min'] == '' || $value['max'] == '') {
                return true;
            }
            if (intval($value['min']) == intval($this->getConfig('minRange')) && intval($value['max']) == intval($this->getConfig('maxRange'))) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array<mixed>
     */
    public function getDefaultValue(): array
    {
        return [];
    }

    /**
     * @param  mixed  $values
     */
    public function getFilterPillValue($values): ?string
    {
        if ($this->validate($values)) {
            return __('Min:').$values['min'].', '.__('Max:').$values['max'];
        }

        return '';
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\View\Factory
     */
    public function render(string $filterLayout, string $tableName, bool $isTailwind, bool $isBootstrap4, bool $isBootstrap5)
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
