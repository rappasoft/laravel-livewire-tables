<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;

class DateRangeFilter extends Filter
{
    protected array $options = [];

    protected array $config = [];

    public function config(array $config = []): DateRangeFilter
    {
        $this->config = [...['earliestDate' => null, 'latestDate' => null, 'allowInput' => true, 'altFormat' => 'F j, Y', 'ariaDateFormat' => 'F j, Y', 'dateFormat' => 'Y-m-d'], ...$config];

        return $this;
    }

    public function getKeys(): array
    {
        return ['minDate' => '', 'maxDate' => ''];
    }

    public function options(array $options = []): DateRangeFilter
    {
        $this->options = [...$this->options, ...$options];

        return $this;
    }

    public function getConfigs(): array
    {
        if (empty($this->config)) { $this->config(); }
        return $this->config;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function validate(array|string $values): array|bool
    {
        if (empty($this->config)) { $this->config(); }
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

        $earliestDateString = ($this->getConfigs()['earliestDate'] != '') ? $this->getConfigs()['earliestDate'] : null;
        $latestDateString = ($this->getConfigs()['latestDate'] != '') ? $this->getConfigs()['latestDate'] : null;

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
            $dateFormat = $this->getConfigs()['dateFormat'] ?? $this->getConfigs()['dateFormat'];
            $ariaDateFormat = $this->getConfigs()['ariaDateFormat'] ?? $this->getConfigs()['ariaDateFormat'];

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

    public function render(string $filterLayout, string $tableName, bool $isTailwind, bool $isBootstrap4, bool $isBootstrap5): \Illuminate\View\View|\Illuminate\View\Factory
    {
        if (empty($this->getConfigs()))
        {
            $this->config();
        }
        return view('livewire-tables::components.tools.filters.date-range', [
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
