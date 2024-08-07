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

        return ($carbonDate === false) ? false : $carbonDate->format('Y-m-d\TH:i');
    }

    public function getFilterPillValue($value): array|string|bool|null
    {
        if ($this->validate($value)) {
            return $this->outputTranslatedDate($this->createCarbonDate($value));
        }

        return null;
    }
}
