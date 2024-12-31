<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Localisations;

use PHPUnit\Framework\Attributes\DataProvider;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class BaseLocalisationCase extends TestCase
{
    public static function getEnLocaleStrings(): array
    {
        $baseDir = __DIR__.'/../../resources/lang/php/';

        $items = require $baseDir.'en/core.php';

        return $items;
    }

    public static function getLocaleStrings($locale): array
    {
        $baseDir = __DIR__.'/../../resources/lang/php/';

        $items = require $baseDir.$locale.'/core.php';

        return $items;
    }

    public static function localisationProvider(): array
    {
        $baseDir = __DIR__.'/../../resources/lang/php/';

        $localisations = [];

        $availableLocales = [
            'ar',
            'ca',
            'da',
            'de',
            'en',
            'es',
            'fr',
            'id',
            'it',
            'ms',
            'nb',
            'nl',
            'pl',
            'pt',
            'pt_BR',
            'ru',
            'sq',
            'sv',
            'th',
            'tk',
            'tr',
            'tw',
            'uk',
        ];
        // return $availableLocales;

        foreach ($availableLocales as $availableLocale) {
            // $array = require($baseDir.$availableLocale.'/core.php');
            $localisations[] = [
                'locale' => $availableLocale,
                //      'localisationStrings' => $array,
            ];
        }

        return $localisations;
    }
}
