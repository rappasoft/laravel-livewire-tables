<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use DateTime;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{HasConfig, IsStringFilter};

class DateFilter extends Filter
{
    use HasConfig,
        IsStringFilter;
    use HasWireables;

    public string $wireMethod = 'live';

    protected string $view = 'livewire-tables::components.tools.filters.date';

    protected string $configPath = 'livewire-tables.dateFilter.defaultConfig';

    public function validate(string $value): string|bool
    {
        if (DateTime::createFromFormat('Y-m-d', $value) === false) {
            return false;
        }

        return $value;
    }

    public function getFilterPillValue($value): string|array|null
    {
        if ($this->validate($value)) {
            return DateTime::createFromFormat('Y-m-d', $value)->format($this->getConfig('pillFormat'));
        }

        return null;
    }
}
