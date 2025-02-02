<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\DataTransferObjects;

use Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters\FilterPillData;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class FilterPillDataTest extends TestCase
{

    public function test_check_all_default_dto_elements()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterSelectName = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = false;
        $customPillBlade = null;
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $defaultData = [
            'filterPillTitle' => $filterPillTitle,
            'filterSelectName' => $filterSelectName,
            'filterPillValue' => $filterPillValue,
            'isAnExternalLivewireFilter' => $isAnExternalLivewireFilter,
            'hasCustomPillBlade' => $hasCustomPillBlade,
            'customPillBlade' => $customPillBlade,
            'separator' => $separator,
            'filterPillsItemAttributes' => $filterPillsItemAttributes,
        ];

        $dto = FilterPillData::make($filterPillTitle, $filterSelectName, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes);

        $this->assertSame($dto->toArray(),$defaultData);
    }

    public function test_can_get_filter_title()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterSelectName = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterPillTitle, $filterSelectName, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes);
        $this->assertSame($dto->getTitle(), $filterPillTitle);
    }

    public function test_can_get_filter_select_name()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterSelectName = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterPillTitle, $filterSelectName, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes);
        $this->assertSame($dto->getSelectName(), $filterSelectName);
    }

    public function test_can_get_filter_value()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterSelectName = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterPillTitle, $filterSelectName, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes);
        $this->assertSame($dto->getPillValue(), $filterPillValue);
    }

    public function test_can_get_filter_value_is_an_array()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterSelectName = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterPillTitle, $filterSelectName, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes);
        $this->assertFalse($dto->isPillValueAnArray());
        $filterPillValue = ['test123', 'test345'];
        $dto = FilterPillData::make($filterPillTitle, $filterSelectName, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes);
        $this->assertTrue($dto->isPillValueAnArray());
    }

    public function test_can_get_separated_pill_value()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterSelectName = 'filterSelectName';
        $filterPillValue = ['test123', 'test345'];
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterPillTitle, $filterSelectName, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes);
        $this->assertTrue($dto->isPillValueAnArray());
        $this->assertSame($dto->getSeparatedPillValue(), 'test123 , test345');

    }
    
    public function test_can_check_if_has_custom_pill_blade()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterSelectName = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterPillTitle, $filterSelectName, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes);
        $this->assertTrue($dto->getHasCustomPillBlade());
        $this->assertTrue($dto->hasCustomPillBlade);
    }

    public function test_can_get_custom_pill_blade()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterSelectName = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterPillTitle, $filterSelectName, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes);
        $this->assertSame($dto->getCustomPillBlade(), $customPillBlade);
    }




}
