<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{HandlesDates, HasConfig, IsStringFilter};

class DateTimeFilter extends Filter
{
    use HandlesDates,
        HasConfig,
        IsStringFilter;
    use HasWireables;

    public string $wireMethod = 'live';

    protected string $view = 'livewire-tables::components.tools.filters.datetime';

    protected string $configPath = 'livewire-tables.dateTimeFilter.defaultConfig';

    public function validate(string $value): string|bool
    {
        $this->setInputDateFormat('Y-m-d\TH:i')->setOutputDateFormat($this->getConfig('pillFormat'));

        $carbonDate = $this->createCarbonDate($value);
        if ($carbonDate instanceof \Carbon\Carbon) {
            return $carbonDate->format('Y-m-d\TH:i');
        }

        return false;
    }

    public function getFilterPillValue($value): ?string
    {
        if ($this->validate($value)) {
            $carbonDate = $this->createCarbonDate($value);
            if ($carbonDate && $carbonDate instanceof \Carbon\Carbon) {
                return $this->outputTranslatedDate($carbonDate);
            }
        }

        return null;
    }
}
