<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\{HandlesDates, HasConfig, HasWireables, IsStringFilter};

class DateFilter extends Filter
{
    use HandlesDates,
        HasConfig,
        IsStringFilter;
    use HasWireables;

    public string $wireMethod = 'live';

    protected string $view = 'livewire-tables::components.tools.filters.date';

    protected string $configPath = 'livewire-tables.dateFilter.defaultConfig';

    public function validate(string $value): string|bool
    {
        $this->setInputDateFormat('Y-m-d')->setOutputDateFormat($this->getConfig('pillFormat') ?? 'Y-m-d');
        $carbonDate = $this->createCarbonDate($value);
        if ($carbonDate instanceof \Carbon\Carbon) {
            return $carbonDate->format('Y-m-d');
        }

        return false;
    }

    public function getFilterPillValue($value): ?string
    {
        if ($this->validate($value)) {
            $carbonDate = $this->createCarbonDate($value);
            if ($carbonDate instanceof \Carbon\Carbon) {
                return $this->outputTranslatedDate($carbonDate);
            }
        }

        return null;
    }

    protected function getCoreInputAttributes(): array
    {
        $attributes = array_merge(parent::getCoreInputAttributes(),
            [
                'min' => $this->hasConfig('min') ? $this->getConfig('min') : null,
                'max' => $this->hasConfig('max') ? $this->getConfig('max') : null,
                'placeholder' => $this->hasConfig('placeholder') ? $this->getConfig('placeholder') : null,
                'type' => 'date',
                'wire:key' => $this->generateWireKey($this->getGenericDisplayData()['tableName'], 'date'),
            ]);
        ksort($attributes);

        return $attributes;
    }
}
