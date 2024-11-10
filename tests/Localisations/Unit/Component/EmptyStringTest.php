<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Localisations\Unit\Component;

use Rappasoft\LaravelLivewireTables\Tests\Localisations\BaseLocalisationCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class EmptyStringTest extends BaseLocalisationCase
{

    #[DataProvider('localisationProvider')]
    public function test_can_get_localised_empty_message(string $locale): void
    {
        $localisedString = $localisationStrings['No items found, try to broaden your search'] ?? $locale;
        $this->basicTable->changeLocale($locale);
        $this->assertEquals($localisedString, $this->basicTable->getEmptyMessage());
    }

}
