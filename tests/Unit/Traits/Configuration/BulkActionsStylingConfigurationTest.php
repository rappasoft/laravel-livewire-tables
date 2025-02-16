<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use Illuminate\View\ComponentAttributeBag;
use PHPUnit\Framework\Attributes\DataProvider;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class BulkActionsStylingConfigurationTest extends TestCase
{
    public static function providesAttributeDataSet(): array
    {
        return [
            'fff' => [false, false, false, 'bg-blue-500', 'bg-red-300'],
            'tff' => [true, false, false, 'bg-red-500', 'bg-yellow-300'],
            'ttf' => [true, true, false, 'bg-green-500', 'bg-gray-300'],
            'ttt' => [true, true, true, 'bg-yellow-500', 'bg-green-300'],
            'tft' => [true, false, true, 'bg-red-500', 'bg-blue-300'],
            'ftf' => [false, true, false, 'bg-green-500', 'bg-amber-300'],
            'ftt' => [false, true, true, 'bg-gray-500', 'bg-blue-300'],
            'fff' => [false, false, true, 'bg-blue-500', 'bg-yellow-300'],
        ];
    }

    public static function providesBulkActionMethodsToTest(): array
    {
        return [
            'BulkActionsButtonAttributes',
            'BulkActionsMenuAttributes',
            'BulkActionsMenuItemAttributes',
            'BulkActionsThAttributes',
            'BulkActionsThCheckboxAttributes',
            'BulkActionsTdAttributes',
            'BulkActionsTdCheckboxAttributes',
            'BulkActionsRowButtonAttributes',
        ];
    }

    public static function mergesMethodsWithAttributes(array $methodsToTest, array $dataSetItems): array
    {
        $allItems = [];

        foreach ($methodsToTest as $methodToTest) {
            $lcFirst = lcfirst($methodToTest);
            $getMethod = 'get'.$methodToTest;
            $setMethod = 'set'.$methodToTest;
            $lower = strtolower($methodToTest);

            foreach ($dataSetItems as $index => $dataSetItem) {
                $allItems[$lower.'_'.$index] = [$setMethod, $getMethod, $lcFirst, $dataSetItem[0], $dataSetItem[1],  $dataSetItem[2],  $dataSetItem[3],  $dataSetItem[4]];
            }
        }

        return $allItems;
    }

    public static function bulkActionAttributesProvider(): array
    {
        $dataSetItems = self::providesAttributeDataSet();
        $methodsToTest = self::providesBulkActionMethodsToTest();

        return self::mergesMethodsWithAttributes($methodsToTest, $dataSetItems);

    }

    #[DataProvider('bulkActionAttributesProvider')]
    public function test_can_set_bulk_actions_attributes_via_provider(string $setMethod, string $getMethod, string $propertyName, bool $default, bool $defaultColors, bool $defaultStyling, string $class1, string $class2): void
    {
        $this->basicTable->{$setMethod}([
            'default' => $default,
            'default-colors' => $defaultColors,
            'class' => $class1,
            'default-styling' => $defaultStyling,
        ]);

        $returnedData = collect($this->basicTable->{$getMethod}())->only(['class', 'default', 'default-colors', 'default-styling'])->sortKeys()->toArray();

        $this->assertSame([
            'class' => $class1,
            'default' => $default,
            'default-colors' => $defaultColors,
            'default-styling' => $defaultStyling,
        ], $returnedData);

        $this->basicTable->{$setMethod}([
            'default' => $default,
            'class' => $class2,
            'default-colors' => ! $defaultColors,
            'default-styling' => $defaultStyling,
        ]);

        $returnedData = collect($this->basicTable->{$getMethod}())->only(['class', 'default', 'default-colors', 'default-styling'])->sortKeys()->toArray();

        $this->assertSame([
            'class' => $class2,
            'default' => $default,
            'default-colors' => ! $defaultColors,
            'default-styling' => $defaultStyling,
        ], $returnedData);
    }

    #[DataProvider('bulkActionAttributesProvider')]
    public function test_can_get_bulk_actions_attributes_bag_via_provider(string $setMethod, string $getMethod, string $propertyName, bool $default, bool $defaultColors, bool $defaultStyling, string $class1, string $class2): void
    {
        $data = [
            'class' => $class1,
            'default' => $default,
            'default-colors' => $defaultColors,
            'default-styling' => $defaultStyling,
        ];

        $this->basicTable->{$setMethod}($data);

        $returnedData = collect($this->basicTable->{$getMethod}())->only(['class', 'default', 'default-colors', 'default-styling'])->sortKeys()->toArray();

        $this->assertSame($data, $returnedData);

        $attributeBag = new ComponentAttributeBag($data);

        $this->assertSame($attributeBag->getAttributes(), $this->basicTable->getCustomAttributesBag($propertyName)->getAttributes());
    }

    public function test_bulk_actions_td_attributes_returns_default_true_if_not_set(): void
    {
        $this->assertSame(['default' => true, 'default-colors' => true, 'default-styling' => true], $this->basicTable->getBulkActionsTdAttributes());
    }

    public function test_bulk_actions_td_checkbox_attributes_returns_default_true_if_not_set(): void
    {

        $this->assertSame(['default' => true, 'default-colors' => true, 'default-styling' => true], collect($this->basicTable->getBulkActionsTdCheckboxAttributes())->only(['class', 'default', 'default-colors', 'default-styling'])->sortKeys()->toArray());
    }

    public function test_bulk_actions_th_attributes_returns_default_true_if_not_set(): void
    {
        $this->assertSame(['default' => true, 'default-colors' => true, 'default-styling' => true], $this->basicTable->getBulkActionsThAttributes());
    }

    public function test_bulk_actions_th_checkbox_attributes_returns_default_true_if_not_set(): void
    {
        $this->assertSame(['default' => true, 'default-colors' => true, 'default-styling' => true], $this->basicTable->getBulkActionsThCheckboxAttributes());
    }

    public function test_bulk_actions_td_checkbox_attributes_returns_additional_data(): void
    {
        $defaultData = [
            'x-show' => '!currentlyReorderingStatus',
            'x-model' => 'selectedItems',
            'wire:loading.attr.delay' => 'disabled',
            'type' => 'checkbox',
            'default' => true,
            'default-colors' => true,
            'default-styling' => true,
        ];
        ksort($defaultData);

        $returnedData = $this->basicTable->getBulkActionsTdCheckboxAttributes();
        ksort($returnedData);

        $this->assertSame($defaultData, $returnedData);
    }

    public function test_bulk_actions_td_checkbox_attributes_returns_additional_data_with_bag(): void
    {
        $defaultAttributeBag = new ComponentAttributeBag([
            'x-show' => '!currentlyReorderingStatus',
            'x-model' => 'selectedItems',
            'wire:loading.attr.delay' => 'disabled',
            'type' => 'checkbox',
            'default' => true,
            'default-colors' => true,
            'default-styling' => true,
        ]);
        $returnedAttributeBag = new ComponentAttributeBag($this->basicTable->getBulkActionsTdCheckboxAttributes());

        $this->assertSame($defaultAttributeBag->getAttributes(), $returnedAttributeBag->getAttributes());

        $this->basicTable->setBulkActionsTdCheckboxAttributes([
            'default-colors' => true,
            'class' => 'w-12',
        ]);

        $customAttributeBag = new ComponentAttributeBag([
            'x-show' => '!currentlyReorderingStatus',
            'x-model' => 'selectedItems',
            'wire:loading.attr.delay' => 'disabled',
            'type' => 'checkbox',
            'class' => 'w-12',
            'default' => false,
            'default-colors' => true,
            'default-styling' => false,
        ]);

        $updatedAttributeBag = new ComponentAttributeBag($this->basicTable->getBulkActionsTdCheckboxAttributes());
        $this->assertSame($customAttributeBag->getAttributes(), $updatedAttributeBag->getAttributes());

    }
}
