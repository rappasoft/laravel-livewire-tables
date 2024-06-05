<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\DateColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\DateColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn;

class DateColumn extends Column
{
    use IsColumn;
    use DateColumnConfiguration,
        DateColumnHelpers;

    public string $inputFormat = 'Y-m-d';

    public string $outputFormat = 'Y-m-d';

    public string $emptyValue = '';

    protected string $view = 'livewire-tables::includes.columns.date';

    public function getContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {

        $dateTime = $this->getValue($row);

        if ($dateTime != '' && $dateTime != null) {
            if ($dateTime instanceof DateTime) {
                return $dateTime->format($this->getOutputFormat());
            } else {
                try {
                    // Check if format matches what is expected
                    if (Carbon::canBeCreatedFromFormat($dateTime, $this->getInputFormat())) {
                        return Carbon::createFromFormat($this->getInputFormat(), $dateTime)->format($this->getOutputFormat());
                    }
                } catch (\Exception $exception) {
                    report($exception);

                    // Return Null
                    return $this->getEmptyValue();
                }

            }
        }

        return $this->getEmptyValue();
    }
}
