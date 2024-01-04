<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{HasConfig,HasOptions};

class DateRangeFilter extends Filter
{
    use HasOptions,
        HasConfig;

    protected string $view = 'livewire-tables::components.tools.filters.date-range';

    protected string $configPath = 'livewire-tables.dateRange.defaultConfig';

    protected string $optionsPath = 'livewire-tables.dateRange.defaultOptions';

    public function getKeys(): array
    {
        return ['minDate' => '', 'maxDate' => ''];
    }

    public function validate(array|string $values): array|bool
    {
        $this->getOptions();
        $this->getConfigs();

        $returnedValues = ['minDate' => '', 'maxDate' => ''];
        if (is_array($values)) {
            if (! isset($values['minDate']) || ! isset($values['maxDate'])) {
                foreach ($values as $index => $value) {
                    if ($index === 0 || $index == '0' || strtolower($index) == 'mindate') {
                        $returnedValues['minDate'] = $value;
                    }
                    if ($index == 1 || $index == '1' || strtolower($index) == 'maxdate') {
                        $returnedValues['maxDate'] = $value;
                    }
                }
            } else {
                $returnedValues['minDate'] = $values['minDate'];
                $returnedValues['maxDate'] = $values['maxDate'];
            }
        } else {
            $valueArray = explode(' ', $values);
            $returnedValues['minDate'] = $valueArray[0];
            $returnedValues['maxDate'] = ((isset($valueArray[1]) && $valueArray[1] != 'to') ? $valueArray[1] : (isset($valueArray[2]) ? $valueArray[2] : ''));
        }

        if ($returnedValues['minDate'] == '' || $returnedValues['maxDate'] == '') {
            return false;
        }

        $dateFormat = $this->getConfigs()['dateFormat'];

        $validator = \Illuminate\Support\Facades\Validator::make($returnedValues, [
            'minDate' => 'required|date_format:'.$dateFormat,
            'maxDate' => 'required|date_format:'.$dateFormat,
        ]);
        if ($validator->fails()) {
            return false;
        }
        $startDate = \Carbon\Carbon::createFromFormat($dateFormat, $returnedValues['minDate']);
        $endDate = \Carbon\Carbon::createFromFormat($dateFormat, $returnedValues['maxDate']);

        if (! ($startDate instanceof \Carbon\Carbon) || ! ($endDate instanceof \Carbon\Carbon)) {
            return false;
        }
        if ($startDate->gt($endDate)) {
            return false;
        }

        $earliestDateString = ($this->getConfig('earliestDate') != '') ? $this->getConfig('earliestDate') : null;
        $latestDateString = ($this->getConfig('latestDate') != '') ? $this->getConfig('latestDate') : null;

        if ($earliestDateString != '' && ! is_null($earliestDateString) && $latestDateString != '' && ! is_null($latestDateString)) {
            $dateLimits = ['earliest' => $earliestDateString, 'latest' => $latestDateString];
            $earlyLateValidator = \Illuminate\Support\Facades\Validator::make($dateLimits, [
                'earliest' => 'date_format:'.$dateFormat,
                'latest' => 'date_format:'.$dateFormat,
            ]);
            if (! $earlyLateValidator->fails()) {
                $earliestDate = \Carbon\Carbon::createFromFormat($dateFormat, $earliestDateString);
                $latestDate = \Carbon\Carbon::createFromFormat($dateFormat, $latestDateString);

                if ($earliestDate instanceof \Carbon\Carbon) {
                    if ($startDate->lt($earliestDate)) {
                        return false;
                    }
                }
                if ($latestDate instanceof \Carbon\Carbon) {
                    if ($endDate->gt($latestDate)) {
                        return false;
                    }
                }
            }
        }

        return $returnedValues;
    }

    public function getDefaultValue(): array
    {
        return [];
    }

    public function getFilterPillValue($value): ?string
    {
        $validatedValue = $this->validate($value);

        if (is_array($validatedValue)) {
            $dateFormat = $this->getConfig('dateFormat');
            $ariaDateFormat = $this->getConfig('ariaDateFormat');

            $minDateCarbon = \Carbon\Carbon::createFromFormat($dateFormat, $validatedValue['minDate']);
            $maxDateCarbon = \Carbon\Carbon::createFromFormat($dateFormat, $validatedValue['maxDate']);

            if (($minDateCarbon instanceof \Carbon\Carbon) && $maxDateCarbon instanceof \Carbon\Carbon) {
                $minDate = $minDateCarbon->format($ariaDateFormat);
                $maxDate = $maxDateCarbon->format($ariaDateFormat);

                return $minDate.' '.__('to').' '.$maxDate;
            }
        }

        return '';
    }

    public function isEmpty(array|string $value): bool
    {
        $values = [];
        if (is_array($value)) {
            if (! isset($value['minDate']) || ! isset($value['maxDate'])) {
                if (isset($value[0])) {
                    $values['minDate'] = $value[0];
                } else {
                    return true;
                }

                if (isset($value[1])) {
                    $values['maxDate'] = $value[1];
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return true;
        }

        return false;
    }

    public function getDateString(string|array $dateInput): string
    {
        if ($dateInput != '') {
            if (is_array($dateInput)) {
                $startDate = isset($dateInput['minDate']) ? $dateInput['minDate'] : (isset($dateInput[1]) ? $dateInput[1] : date('Y-m-d'));
                $endDate = isset($dateInput['maxDate']) ? $dateInput['maxDate'] : (isset($dateInput[0]) ? $dateInput[0] : date('Y-m-d'));
            } else {
                $dateArray = explode(',', $dateInput);
                $startDate = isset($dateArray[0]) ? $dateArray[0] : date('Y-m-d');
                $endDate = isset($dateArray[2]) ? $dateArray[2] : date('Y-m-d');
            }

            return $startDate.' to '.$endDate;
        }

        return '';
    }
}
