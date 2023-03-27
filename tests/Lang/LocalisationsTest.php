<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Lang;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class LocalisationsTest extends TestCase
{

    public static function languageDataProvider(): array
    {
        return [
            'ar' => ['ar',],
            'ca' => ['ca',],
            'de' => ['de',],
            'es' => ['es',],
            'fr' => ['fr',],
            'id' => ['id',],
            'it' => ['it',],
            'ms' => ['ms',],
            'nl' => ['nl',],
            'pt_BR' => ['pt_BR',],
            'pt' => ['pt',],
            'ru' => ['ru',],
            'th' => ['th',],
            'tk' => ['tk',],
            'tr' => ['tr',],
            'tw' => ['tw',],
            'uk' => ['uk',],
        ];
    }




    /**
     * @test
     * 
     */
    public function testHasEnglishArray(): void
    {
        $englishFile = file_get_contents(__DIR__.'/../../resources/lang/en.json');
        $this->assertNotEmpty($englishFile);

        $englishLangArray = json_decode($englishFile,true);
        $this->assertNotEmpty($englishLangArray);
    }

    /**
     * @test
     * 
     * @dataProvider languageDataProvider
     */
    public function testAllTranslationsHaveAllValues($languagePath): void
    {        
        $englishFile = file_get_contents(__DIR__.'/../../resources/lang/en.json');
        $englishLangArray = json_decode($englishFile,true);
        $this->assertNotEmpty($englishLangArray);

        $transFile = file_get_contents(__DIR__.'/../../resources/lang/'.$languagePath.'.json');
        $this->assertNotEmpty($transFile);

        $transArray = json_decode($transFile,true);
        $this->assertNotEmpty($transArray);

        foreach($englishLangArray as $key => $val)
        {
            $this->assertNotEmpty($transArray[$key]);
        }
    }
}
