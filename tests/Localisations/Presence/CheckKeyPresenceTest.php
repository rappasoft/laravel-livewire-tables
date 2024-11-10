<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Localisations\Presence;

use Rappasoft\LaravelLivewireTables\Tests\Localisations\BaseLocalisationCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class CheckKeyPresenceTest extends BaseLocalisationCase
{

    #[DataProvider('localisationProvider')]
    public function test_can_get_localised_empty_message(string $locale): void
    {
        $localisedStrings = static::getLocaleStrings($locale);

        $localisedString = $localisedStrings['No items found, try to broaden your search'] ?? $locale;
        $this->basicTable->changeLocale($locale);
        $this->assertEquals($localisedString, $this->basicTable->getEmptyMessage());
    }

    #[DataProvider('localisationProvider')]
    public function test_can_check_presence_of_keys(string $locale): void
    {
        $engStrings = static::getEnLocaleStrings();
        $localisedStrings = static::getLocaleStrings($locale);
        foreach ($engStrings as $key => $value)
        {
            $this->assertNotNull($localisedStrings[$key]);
        }
    }



}
