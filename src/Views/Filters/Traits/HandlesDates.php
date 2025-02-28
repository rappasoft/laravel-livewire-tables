<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Pills\HandlesPillsLocale;

trait HandlesDates
{
    use HandlesPillsLocale;

    protected string $inputDateFormat;

    protected string $outputDateFormat;

    protected Carbon $carbonInstance;

    protected function createCarbon(): void
    {
        $this->carbonInstance = new Carbon;
        $this->carbonInstance->setLocale($this->getPillsLocale());

    }

    protected function createCarbonDate(string $value): Carbon|bool
    {
        $this->createCarbon();
        $fromFormat = false;
        try {
            $fromFormat = $this->carbonInstance->createFromFormat($this->inputDateFormat, $value);
        } catch (\Exception $e) {
            return false;
        }

        return $fromFormat;
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
