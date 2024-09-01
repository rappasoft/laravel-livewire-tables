<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class TableAttributeHelpersTest extends TestCase
{
    public function test_top_level_attributes_match(): void
    {
        $topLevelAttributesArray = $this->basicTable->getTopLevelAttributesArray();
        $this->assertSame('shouldBeDisplayed', $topLevelAttributesArray['x-show']);
        $this->assertSame("showTable(event.detail.tableName ?? '', event.detail.tableFingerpint ?? '')", $topLevelAttributesArray['x-on:show-table.window']);
        $this->assertSame("hideTable(event.detail.tableName ?? '', event.detail.tableFingerpint ?? '')", $topLevelAttributesArray['x-on:hide-table.window']);
        $this->assertSame("laravellivewiretable(\$wire, '". $this->basicTable->showBulkActionsDropdownAlpine()."', '".$this->basicTable->getTableId()."', '". $this->basicTable->getPrimaryKey()."')", $topLevelAttributesArray['x-data']);
    }

    public function test_top_level_attribute_bag_matches(): void
    {
        $topLevelAttributeBag = $this->basicTable->getTopLevelAttributes();
        
        $topLevelAttributesArray = $topLevelAttributeBag->getAttributes();

        $this->assertSame('shouldBeDisplayed', $topLevelAttributesArray['x-show']);
        $this->assertSame("showTable(event.detail.tableName ?? '', event.detail.tableFingerpint ?? '')", $topLevelAttributesArray['x-on:show-table.window']);
        $this->assertSame("hideTable(event.detail.tableName ?? '', event.detail.tableFingerpint ?? '')", $topLevelAttributesArray['x-on:hide-table.window']);
        $this->assertSame("laravellivewiretable(\$wire, '". $this->basicTable->showBulkActionsDropdownAlpine()."', '".$this->basicTable->getTableId()."', '". $this->basicTable->getPrimaryKey()."')", $topLevelAttributesArray['x-data']);
    }

}