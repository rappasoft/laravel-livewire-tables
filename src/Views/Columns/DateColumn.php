<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\DateColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\{HasInputOutputFormat, IsColumn};
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\DateColumnHelpers;

class DateColumn extends Column
{
    use IsColumn,
        HasInputOutputFormat,
        DateColumnConfiguration,
        DateColumnHelpers { DateColumnHelpers::getValue insteadof IsColumn; }

    public string $inputFormat = 'Y-m-d';

    public string $outputFormat = 'Y-m-d';

    public string $emptyValue = '';

    protected string $view = 'livewire-tables::includes.columns.date';

    public function getContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        try {
            $dateTime = $this->getValue($row);
            if ($dateTime != '' && $dateTime != null) {
                if ($dateTime instanceof DateTime) {
                    return $dateTime->format($this->getOutputFormat());
                } else {
                    // Check if format matches what is expected and return Carbon instance if so, otherwise emptyValue
                    return Carbon::canBeCreatedFromFormat($dateTime, $this->getInputFormat()) ? Carbon::createFromFormat($this->getInputFormat(), $dateTime)->format($this->getOutputFormat()) : $this->getEmptyValue();
                }
            }
        } catch (\Exception $exception) {
            return $this->getEmptyValue();
        }

        return $this->getEmptyValue();
    }
}
