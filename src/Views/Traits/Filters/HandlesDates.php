<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

use Carbon\Carbon;

trait HandlesDates
{
    use HasLocale;

    protected function createCarbon(string $locale = null): Carbon
    {
        $carbon = new Carbon;
        $carbon->setLocale($locale ?? $this->getLocale());

        return $carbon;
    }

    protected function createCarbonFromFormat(string $format, string $value, string $locale = null): Carbon|bool
    {
        $carbon = $this->createCarbon($locale);

        return $carbon->createFromFormat($format, $value);
    }
    
    protected function outputTranslatedDate(string $format, string $value, string $ariaDateFormat, string $locale = null): string
    {
        $carbon = $this->createCarbonFromFormat($format, $value, $locale);

        return $carbon->translatedFormat($ariaDateFormat);
    }
}
