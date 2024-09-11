<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use PHPUnit\Framework\Attributes\DataProvider;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class BulkActionsStylingConfigurationTest extends TestCase
{

    public static function attributeStatusProvider2(): array
    {
        return [
            [false, false, false,'bg-blue-500', 'bg-red-300'],
            [true, false, false,'bg-red-500', 'bg-yellow-300'],
            [true, true, false,'bg-green-500', 'bg-gray-300'],
            [true, true, true,'bg-yellow-500', 'bg-green-300'],
            [true, false, true,'bg-red-500', 'bg-blue-300'],
            [false, true, false,'bg-green-500', 'bg-amber-300'],
            [false, true, true,'bg-gray-500', 'bg-blue-300'],
            [false, false, true,'bg-blue-500', 'bg-yellow-300'],
        ];
    }

    public static function providesAttributeDataSet(): array
    {
        return [
            [false, false, false,'bg-blue-500', 'bg-red-300'],
            [true, false, false,'bg-red-500', 'bg-yellow-300'],
            [true, true, false,'bg-green-500', 'bg-gray-300'],
            [true, true, true,'bg-yellow-500', 'bg-green-300'],
            [true, false, true,'bg-red-500', 'bg-blue-300'],
            [false, true, false,'bg-green-500', 'bg-amber-300'],
            [false, true, true,'bg-gray-500', 'bg-blue-300'],
            [false, false, true,'bg-blue-500', 'bg-yellow-300'],
        ];
    }

    public static function attributeStatusProvider(): array
    {
        
        $allItems = [];

        $dataSetItems = static::providesAttributeDataSet();

        $testItems = [
            'BulkActionsButtonAttributes',
            'BulkActionsMenuAttributes',
            'BulkActionsMenuItemAttributes',
            'BulkActionsThAttributes',
            'BulkActionsThCheckboxAttributes',
            'BulkActionsTdAttributes',
            'BulkActionsTdCheckboxAttributes',
        ];

        foreach ($testItems as $testItem)
        {
            foreach ($dataSetItems as $dataSetItem)
            {
                $allItems[] = ['set'.$testItem, 'get'.$testItem, $dataSetItem[0], $dataSetItem[1],  $dataSetItem[2],  $dataSetItem[3],  $dataSetItem[4]];
            }
        }

        return $allItems;
    }


    #[DataProvider('attributeStatusProvider')]
    public function test_can_set_bulk_actions_td_attributes_via_provider(string $setMethod, string $getMethod, bool $default, bool $defaultColors, bool $defaultStyling, string $class1, string $class2): void
    {
        $this->basicTable->{$setMethod}([
            'default' => $default, 
            'default-colors' => $defaultColors, 
            'class' => $class1, 
            'default-styling' => $defaultStyling,
        ]);

        $this->assertSame([
            'class' => $class1,
            'default' => $default, 
            'default-colors' => $defaultColors, 
            'default-styling' => $defaultStyling, 
        ], $this->basicTable->{$getMethod}());

        $this->basicTable->{$setMethod}([
            'default' => $default, 
            'class' => $class2,
            'default-colors' => !$defaultColors, 
            'default-styling' => $defaultStyling,
        ]);

        $this->assertSame([
            'class' => $class2,
            'default' => $default, 
            'default-colors' => !$defaultColors, 
            'default-styling' => $defaultStyling, 
        ], $this->basicTable->{$getMethod}());
    }


    
    public function test_bulk_actions_td_attributes_returns_default_true_if_not_set(): void
    {
        $this->assertSame(['default' => true, 'default-colors' => false, 'default-styling' => false], $this->basicTable->getBulkActionsTdAttributes());
    }

    public function test_bulk_actions_td_checkbox_attributes_returns_default_true_if_not_set(): void
    {
        $this->assertSame(['default' => true, 'default-colors' => false, 'default-styling' => false], $this->basicTable->getBulkActionsTdCheckboxAttributes());
    }

    public function test_bulk_actions_th_attributes_returns_default_true_if_not_set(): void
    {
        $this->assertSame(['default' => true, 'default-colors' => false, 'default-styling' => false], $this->basicTable->getBulkActionsThAttributes());
    }

    public function test_bulk_actions_th_checkbox_attributes_returns_default_true_if_not_set(): void
    {
        $this->assertSame(['default' => true, 'default-colors' => false, 'default-styling' => false], $this->basicTable->getBulkActionsThCheckboxAttributes());
    }

}
