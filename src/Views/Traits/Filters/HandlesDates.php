<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

use Carbon\Carbon;

trait HandlesDates
{
    use HasPillsLocale;

    protected string $inputDateFormat;

    protected string $outputDateFormat;

    protected Carbon $carbonInstance;

    protected function createCarbon()
    {
        $this->carbonInstance = new Carbon;
        $this->carbonInstance->setLocale($this->getPillsLocale());

    }

    protected function createCarbonFromFormat(string $format, string $value): Carbon|bool
    {
        $this->createCarbon();

        return $this->carbonInstance->createFromFormat($format, $value);
    }

    protected function createCarbonDate(string $value): Carbon|bool
    {
        $this->createCarbon();

        return $this->carbonInstance->createFromFormat($this->inputDateFormat, $value);
    }

    protected function setInputDateFormat(string $inputDateFormat): self
    {
        $this->inputDateFormat = $inputDateFormat;

        return $this;
    }

    protected function setOutputDateFormat(string $outputDateFormat): self
    {
        $this->outputDateFormat = $outputDateFormat;

        return $this;
    }

    protected function outputTranslatedDate(?Carbon $carbon): string
    {
        if ($carbon instanceof Carbon) {
            return $carbon->translatedFormat($this->outputDateFormat);
        }

        return '';
    }
}
