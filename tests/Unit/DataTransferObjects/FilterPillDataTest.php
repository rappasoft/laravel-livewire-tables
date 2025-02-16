<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\DataTransferObjects;

use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters\FilterPillData;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class FilterPillDataTest extends TestCase
{
    public function test_check_all_default_dto_elements()
    {
        $filterKey = 'filterSelectName';
        $filterPillTitle = 'filterPillTitle';
        $filterKey = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = 0;
        $renderPillsAsHtml = 0;
        $renderPillsTitleAsHtml = 0;
        $watchForEvents = 0;
        $hasCustomPillBlade = false;
        $customPillBlade = null;
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true, 'default-text' => true];
        $defaultData = [
            'filterPillTitle' => $filterPillTitle,
            'filterKey' => $filterKey,
            'filterPillValue' => $filterPillValue,
            'isAnExternalLivewireFilter' => $isAnExternalLivewireFilter,
            'hasCustomPillBlade' => $hasCustomPillBlade,
            'customPillBlade' => $customPillBlade,
            'separator' => $separator,
            'filterPillsItemAttributes' => $filterPillsItemAttributes,
            'renderPillsAsHtml' => $renderPillsAsHtml,
            'renderPillsTitleAsHtml' => $renderPillsTitleAsHtml,
            'watchForEvents' => $watchForEvents,
            'separatedValues' => 'filterPillValue',
        ];
        ksort($defaultData);

        $dto = FilterPillData::make($filterKey, $filterPillTitle, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, false, false, [], false);
        $dtoArray = $dto->toArray();

        ksort($dtoArray);

        $this->assertSame($defaultData, $dtoArray);
    }

    public function test_can_get_filter_title()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterKey = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterKey, $filterPillTitle, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, false, false, [], false);

        $this->assertSame($dto->getTitle(), $filterPillTitle);
    }

    public function test_can_get_filter_value()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterKey = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterKey, $filterPillTitle, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, false, false, [], false);
        $this->assertSame($dto->getPillValue(), $filterPillValue);
    }

    public function test_can_get_filter_value_is_an_array()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterKey = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterKey, $filterPillTitle, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, false, false, [], false);
        $this->assertFalse($dto->isPillValueAnArray());
        $filterPillValue = ['test123', 'test345'];
        $dto = FilterPillData::make($filterKey, $filterPillTitle, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, false, false, [], false);
        $this->assertTrue($dto->isPillValueAnArray());
    }

    public function test_can_get_separated_pill_value()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterKey = 'filterSelectName';
        $filterPillValue = ['test123', 'test345'];
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterKey, $filterPillTitle, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, false, false, [], false);
        $this->assertTrue($dto->isPillValueAnArray());
        $this->assertSame($dto->getSeparatedPillValue(), 'test123 , test345');

    }

    public function test_can_check_if_has_custom_pill_blade()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterKey = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterKey, $filterPillTitle, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, false, false, [], false);
        $this->assertTrue($dto->getHasCustomPillBlade());
        $this->assertTrue($dto->hasCustomPillBlade);
    }

    public function test_can_get_custom_pill_blade()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterKey = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $dto = FilterPillData::make($filterKey, $filterPillTitle, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, false, false, [], false);
        $this->assertSame($dto->getCustomPillBlade(), $customPillBlade);
    }

    public function test_can_get_filter_pill_display_data_html()
    {
        $filterPillTitle = 'filterPillTitle';
        $filterKey = 'filterSelectName';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = true;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];
        $renderPillsAsHtml = true;
        $renderPillsTitleAsHtml = false;

        $dto = FilterPillData::make($filterKey, $filterPillTitle, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, $renderPillsAsHtml, false, [], $renderPillsTitleAsHtml);
        $displayData = new ComponentAttributeBag($dto->getExternalFilterPillDisplayDataArray());
        $bag = new ComponentAttributeBag(['x-html' => 'displayString']);

        $this->assertSame($displayData->getAttributes(), $bag->getAttributes());
    }

    public function test_can_get_filter_pill_display_data_non_html()
    {
        $filterKey = 'filterSelectName';

        $filterPillTitle = 'filterPillTitle';
        $filterPillValue = 'filterPillValue';
        $separator = ' , ';
        $isAnExternalLivewireFilter = false;
        $hasCustomPillBlade = true;
        $customPillBlade = 'test-blade';
        $renderPillsAsHtml = false;
        $renderPillsTitleAsHtml = false;

        $filterPillsItemAttributes = ['default' => true, 'default-colors' => true, 'default-styling' => true];

        $dto = FilterPillData::make($filterKey, $filterPillTitle, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, $renderPillsAsHtml, false, [], $renderPillsTitleAsHtml);
        $displayData = new ComponentAttributeBag($dto->getExternalFilterPillDisplayDataArray());
        $bag = new ComponentAttributeBag(['x-text' => 'displayString']);

        $this->assertSame($displayData->getAttributes(), $bag->getAttributes());
    }
}
