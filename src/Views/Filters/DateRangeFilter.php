<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\{HandlesDates, HasConfig, HasOptions, HasWireables};

class DateRangeFilter extends Filter
{
    use HandlesDates,
        HasOptions,
        HasConfig;
    use HasWireables;

    public string $wireMethod = 'blur';

    protected string $view = 'livewire-tables::components.tools.filters.date-range';

    protected string $configPath = 'livewire-tables.dateRange.defaultConfig';

    protected string $optionsPath = 'livewire-tables.dateRange.defaultOptions';

    public function getKeys(): array
    {
        return ['minDate' => '', 'maxDate' => ''];
    }

    public function validate(array|string|null $values): array|bool
    {
        $this->getOptions();
        $this->getConfigs();
        $this->setInputDateFormat($this->getConfig('dateFormat'))->setOutputDateFormat($this->getConfig('ariaDateFormat'));
        $dateFormat = $this->getConfigs()['dateFormat'];

        $returnedValues = $this->populateReturnedValues($values);

        if ($returnedValues['minDate'] == '' || $returnedValues['maxDate'] == '' || ! $this->validateDateFormat($returnedValues, $dateFormat)) {
            return false;
        }

        if (! (($startDate = $this->createCarbonDate($returnedValues['minDate'])) instanceof Carbon) || ! (($endDate = $this->createCarbonDate($returnedValues['maxDate'])) instanceof Carbon)) {
            return false;
        }

        if ($startDate->gt($endDate)) {
            return false;
        }

        $earlyLate = $this->setupEarlyLateDates($dateFormat);

        $earliestDate = $earlyLate['earliest'] ?? null;
        $latestDate = $earlyLate['latest'] ?? null;

        if ($earliestDate instanceof Carbon) {
            if ($startDate->lt($earliestDate)) {
                return false;
            }
        }
        if ($latestDate instanceof Carbon) {
            if ($endDate->gt($latestDate)) {
                return false;
            }
        }

        return $returnedValues;
    }

    protected function setupEarlyLateDates(string $dateFormat): array
    {
        $earliestDateString = ($this->getConfig('earliestDate') != '') ? $this->getConfig('earliestDate') : null;
        $latestDateString = ($this->getConfig('latestDate') != '') ? $this->getConfig('latestDate') : null;
        if (! is_null($earliestDateString) && $earliestDateString != '' && ! is_null($latestDateString) && $latestDateString != '') {
            $dateLimits = ['earliest' => $earliestDateString, 'latest' => $latestDateString];
            $earlyLateValidator = Validator::make($dateLimits, [
                'earliest' => 'date_format:'.$dateFormat,
                'latest' => 'date_format:'.$dateFormat,
            ]);
            if (! $earlyLateValidator->fails()) {
                return [
                    'earliest' => $this->createCarbonDate($earliestDateString),
                    'latest' => $this->createCarbonDate($latestDateString),
                ];

            }
        }

        return [];
    }

    protected function populateReturnedValues(string|array $values): array
    {
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

        return $returnedValues;
    }

    protected function validateDateFormat(array $returnedValues, string $dateFormat): bool
    {
        $validator = Validator::make($returnedValues, [
            'minDate' => 'required|date_format:'.$dateFormat,
            'maxDate' => 'required|date_format:'.$dateFormat,
        ]);
        if ($validator->fails()) {
            return false;
        }

        return true;
    }

    public function getDefaultValue(): array
    {
        return $this->getFilterDefaultValue();
    }

    public function getFilterDefaultValue(): array
    {
        return $this->filterDefaultValue ?? [];
    }

    public function hasFilterDefaultValue(): bool
    {
        return ! is_null($this->filterDefaultValue);
    }

    public function setFilterDefaultValue($value): self
    {
        if (is_array($value)) {
            $minDate = '';
            $maxDate = '';

            if (array_key_exists('minDate', $value)) {
                $minDate = $value['minDate'];
            } elseif (array_key_exists('min', $value)) {
                $minDate = $value['min'];
            } elseif (array_key_exists(0, $value)) {
                $minDate = $value[0];
            }

            if (array_key_exists('maxDate', $value)) {
                $maxDate = $value['maxDate'];
            } elseif (array_key_exists('max', $value)) {
                $maxDate = $value['max'];
            } elseif (array_key_exists(1, $value)) {
                $maxDate = $value[1];
            }
            $this->filterDefaultValue = ['minDate' => $minDate, 'maxDate' => $maxDate];
        } else {
            $this->filterDefaultValue = ['minDate' => $value, 'maxDate' => $value];
        }

        return $this;
    }

    public function getFilterPillValue($value): array|string|bool|null
    {
        $validatedValue = $this->validate($value);

        if (is_array($validatedValue)) {
            if ($this->hasConfig('locale')) {
                $this->setPillsLocale($this->getConfig('locale'));
            }

            $minDate = $this->createCarbonDate($validatedValue['minDate']);
            $maxDate = $this->createCarbonDate($validatedValue['maxDate']);

            if (($minDate instanceof Carbon) && $maxDate instanceof Carbon) {
                return $this->outputTranslatedDate($minDate)
                        .' '.__($this->getLocalisationPath().'to').' '.
                        $this->outputTranslatedDate($maxDate);
            }
        }

        return '';
    }

    public function isEmpty(array|string|null $value): bool
    {
        if (is_null($value) || empty($value)) {
            return true;
        }
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
