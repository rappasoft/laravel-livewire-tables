<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use DateTime;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{HasConfig, IsStringFilter};

class DateTimeFilter extends Filter
{
    use HasConfig,
        IsStringFilter;
    use HasWireables;

    public string $wireMethod = 'live';

    protected string $view = 'livewire-tables::components.tools.filters.datetime';

    protected string $configPath = 'livewire-tables.dateTimeFilter.defaultConfig';

    public function validate(string $value): string|bool
    {
        if (DateTime::createFromFormat('Y-m-d\TH:i', $value) === false) {
            return false;
        }

        return $value;
    }

    public function getFilterPillValue($value): string|array|null
    {
        if ($this->validate($value)) {
            return DateTime::createFromFormat('Y-m-d\TH:i', $value)->format($this->getConfig('pillFormat'));
        }

        return null;
    }
}
