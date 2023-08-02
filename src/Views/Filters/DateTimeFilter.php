<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use DateTime;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class DateTimeFilter extends Filter
{
    protected array $options = ['dateFormat' => 'Y-m-d\TH:i'];

    public function options(array $options = []): DateTimeFilter
    {
        $this->options =  [...$this->options, ...$options];

        return $this;
    }

    public function validate($value): bool|string
    {
        if (DateTime::createFromFormat($this->options['dateFormat'], $value) === false) {
            return false;
        }

        return $value;
    }

    public function isEmpty($value): bool
    {
        return $value === '';
    }


    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }

    public function render(string $filterLayout, string $tableName, bool $isTailwind, bool $isBootstrap4, bool $isBootstrap5): \Illuminate\View\View|\Illuminate\View\Factory
    {
        return view('livewire-tables::components.tools.filters.datetime', [
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
