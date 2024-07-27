<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

use Carbon\Carbon;

trait HandlesDates
{
    use HasLocale;

    protected function createCarbon(): Carbon
    {
        $carbon = new Carbon;
        $carbon->setLocale($this->getLocale());

        return $carbon;
    }

    protected function createCarbonFromFormat(string $format, string $value): Carbon|bool
    {
        $carbon = $this->createCarbon();

        return $carbon->createFromFormat($format, $value);
    }
    
    protected function outputTranslatedDate(string $format, string $value, string $ariaDateFormat): string
    {
        $carbon = $this->createFromFormat($format, $value);

        return $carbon->translatedFormat($ariaDateFormat);
    }
}