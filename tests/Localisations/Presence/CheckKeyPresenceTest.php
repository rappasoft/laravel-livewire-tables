<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Localisations\Presence;

use PHPUnit\Framework\Attributes\DataProvider;
use Rappasoft\LaravelLivewireTables\Tests\Localisations\BaseLocalisationCase;

final class CheckKeyPresenceTest extends BaseLocalisationCase
{
    #[DataProvider('localisationProvider')]
    public function test_can_get_localised_empty_message(string $locale): void
    {
        $localisedStrings = self::getLocaleStrings($locale);

        $localisedString = $localisedStrings['No items found, try to broaden your search'] ?? $locale;
        $this->basicTable->changeLocale($locale);
        $this->assertEquals($localisedString, $this->basicTable->getEmptyMessage());
    }

    #[DataProvider('localisationProvider')]
    public function test_can_check_presence_of_keys(string $locale): void
    {
        $engStrings = self::getEnLocaleStrings();
        $localisedStrings = self::getLocaleStrings($locale);
        foreach ($engStrings as $key => $value) {
            $this->assertArrayHasKey($key, $localisedStrings);
        }
    }
}
