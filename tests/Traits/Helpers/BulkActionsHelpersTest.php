<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class BulkActionsHelpersTest extends TestCase
{
    /** @test */
    public function can_get_bulk_actions_status(): void
    {
        $this->assertTrue($this->basicTable->bulkActionsAreEnabled());

        $this->basicTable->setBulkActionsDisabled();

        $this->assertTrue($this->basicTable->bulkActionsAreDisabled());

        $this->basicTable->setBulkActionsEnabled();

        $this->assertTrue($this->basicTable->bulkActionsAreEnabled());
    }

    /** @test */
    public function can_get_select_all_status(): void
    {
        $this->assertTrue($this->basicTable->selectAllIsDisabled());

        $this->basicTable->setSelectAllEnabled();

        $this->assertTrue($this->basicTable->selectAllIsEnabled());

        $this->basicTable->setSelectAllDisabled();

        $this->assertTrue($this->basicTable->selectAllIsDisabled());
    }

    /** @test */
    public function can_get_hide_bulk_actions_on_empty_status(): void
    {
        $this->assertTrue($this->basicTable->hideBulkActionsWhenEmptyIsDisabled());

        $this->basicTable->setHideBulkActionsWhenEmptyEnabled();

        $this->assertTrue($this->basicTable->hideBulkActionsWhenEmptyIsEnabled());

        $this->basicTable->setHideBulkActionsWhenEmptyDisabled();

        $this->assertTrue($this->basicTable->hideBulkActionsWhenEmptyIsDisabled());
    }

    /** @test */
    public function can_get_bulk_actions_array(): void
    {
        $this->assertSame([], $this->basicTable->getBulkActions());

        $this->basicTable->setBulkActions(['activate' => 'Activate']);

        $this->assertSame(['activate' => 'Activate'], $this->basicTable->getBulkActions());
    }

    /** @test */
    public function can_check_if_bulk_actions_dropdown_should_bw_shown(): void
    {
        $this->basicTable->setBulkActionsDisabled();

        $this->assertFalse($this->basicTable->showBulkActionsDropdown());

        $this->basicTable->setBulkActionsEnabled();

        $this->basicTable->setHideBulkActionsWhenEmptyDisabled();

        $this->assertFalse($this->basicTable->showBulkActionsDropdown());

        $this->basicTable->setBulkActions(['activate' => 'Activate']);

        $this->assertTrue($this->basicTable->showBulkActionsDropdown());

        $this->basicTable->setBulkActions([]);

        $this->basicTable->setHideBulkActionsWhenEmptyEnabled();

        $this->assertFalse($this->basicTable->showBulkActionsDropdown());

        $this->basicTable->setSelected([1, 2, 3]);

        $this->assertTrue($this->basicTable->showBulkActionsDropdown());
    }

    /** @test */
    public function can_set_selected_bulk_items(): void
    {
        $this->assertSame([], $this->basicTable->getSelected());

        $this->basicTable->setSelected([1, 2, 3]);

        $this->assertSame([1, 2, 3], $this->basicTable->getSelected());
    }

    /** @test */
    public function can_check_if_there_are_selected_items(): void
    {
        $this->assertFalse($this->basicTable->hasSelected());

        $this->basicTable->setSelected([1, 2, 3]);

        $this->assertTrue($this->basicTable->hasSelected());
    }

    /** @test */
    public function can_get_selected_count(): void
    {
        $this->assertEquals(0, $this->basicTable->getSelectedCount());

        $this->basicTable->setSelected([1, 2, 3]);

        $this->assertEquals(3, $this->basicTable->getSelectedCount());
    }

    /** @test */
    public function can_clear_selected(): void
    {
        $this->basicTable->setSelected([1, 2, 3]);

        $this->basicTable->clearSelected();

        $this->assertEquals(0, $this->basicTable->getSelectedCount());

        $this->basicTable->setSelectAllEnabled();

        $this->assertTrue($this->basicTable->selectAllIsEnabled());

        $this->basicTable->clearSelected();

        $this->assertTrue($this->basicTable->selectAllIsDisabled());
    }

    /** @test */
    public function select_all_disabled_when_selected_updated(): void
    {
        $this->basicTable->setSelectAllEnabled();

        $this->assertTrue($this->basicTable->selectAllIsEnabled());

        $this->basicTable->setSelected([1]);
        $this->basicTable->updatedSelected();

        $this->assertTrue($this->basicTable->selectAllIsDisabled());
    }

    /** @test */
    public function update_select_all_clears_or_selects_all_depending_on_status(): void
    {
        $this->basicTable->setSelected([1, 2, 3, 4, 5]);

        $this->basicTable->updatedSelectAll();

        $this->assertSame([], $this->basicTable->getSelected());

        $this->basicTable->setSelected([1]);

        $this->basicTable->updatedSelectAll();

        $this->assertSame(['1', '2', '3', '4', '5'], $this->basicTable->getSelected());
    }

    /** @test */
    public function set_select_all_selects_all(): void
    {
        $this->assertSame([], $this->basicTable->getSelected());

        $this->basicTable->setAllSelected();

        $this->assertTrue($this->basicTable->selectAllIsEnabled());

        $this->assertSame(['1', '2', '3', '4', '5'], $this->basicTable->getSelected());
    }
}
