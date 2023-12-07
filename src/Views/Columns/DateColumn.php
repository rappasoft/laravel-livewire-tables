<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\DateColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\DateColumnHelpers;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use \DateTime;

class DateColumn extends Column
{
    use IsColumn;
    use DateColumnConfiguration,
        DateColumnHelpers;

    protected string $dateFormat = 'Y-m-d';

    protected string $view = 'livewire-tables::includes.columns.date';

    protected mixed $callback = null;

    public function getContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $dateTime = false;
        try {
            $dateTime = $this->getValue($row);
        }
        catch (\Exception $exception)
        {
            report($exception);
            return '';
        }
        if ($dateTime != false)
        {
            return $dateTime->format($this->getDateFormat());
        }
        return '';

        
    }
}
