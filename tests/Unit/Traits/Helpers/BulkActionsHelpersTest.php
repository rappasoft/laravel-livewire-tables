<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class BulkActionsHelpersTest extends TestCase
{
    public function test_can_get_bulk_actions_status(): void
    {
        $this->assertTrue($this->basicTable->bulkActionsAreEnabled());

        $this->basicTable->setBulkActionsDisabled();

        $this->assertTrue($this->basicTable->bulkActionsAreDisabled());

        $this->basicTable->setBulkActionsEnabled();

        $this->assertTrue($this->basicTable->bulkActionsAreEnabled());
    }

    public function test_can_get_select_all_status(): void
    {
        $this->assertTrue($this->basicTable->selectAllIsDisabled());

        $this->basicTable->setSelectAllEnabled();

        $this->assertTrue($this->basicTable->selectAllIsEnabled());

        $this->basicTable->setSelectAllDisabled();

        $this->assertTrue($this->basicTable->selectAllIsDisabled());
    }

    public function test_can_get_hide_bulk_actions_on_empty_status(): void
    {
        $this->assertTrue($this->basicTable->hideBulkActionsWhenEmptyIsDisabled());

        $this->basicTable->setHideBulkActionsWhenEmptyEnabled();

        $this->assertTrue($this->basicTable->hideBulkActionsWhenEmptyIsEnabled());

        $this->basicTable->setHideBulkActionsWhenEmptyDisabled();

        $this->assertTrue($this->basicTable->hideBulkActionsWhenEmptyIsDisabled());
    }

    public function test_can_get_bulk_actions_array(): void
    {
        $this->assertSame([], $this->basicTable->getBulkActions());

        $this->basicTable->setBulkActions(['activate' => 'Activate']);

        $this->assertSame(['activate' => 'Activate'], $this->basicTable->getBulkActions());
    }

    public function test_can_get_bulk_actions_array_direct(): void
    {
        $this->assertSame([], $this->basicTable->bulkActions());

        $this->basicTable->setBulkActions(['activate' => 'Activate']);

        $this->assertSame(['activate' => 'Activate'], $this->basicTable->bulkActions());
    }

    public function test_can_check_if_bulk_actions_dropdown_should_bw_shown(): void
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

    public function test_can_set_selected_bulk_items(): void
    {
        $this->assertSame([], $this->basicTable->getSelected());

        $this->basicTable->setSelected([1, 2, 3]);

        $this->assertSame([1, 2, 3], $this->basicTable->getSelected());
    }

    public function test_can_check_if_there_are_selected_items(): void
    {
        $this->assertFalse($this->basicTable->hasSelected());

        $this->basicTable->setSelected([1, 2, 3]);

        $this->assertTrue($this->basicTable->hasSelected());
    }

    public function test_can_get_selected_count(): void
    {
        $this->assertEquals(0, $this->basicTable->getSelectedCount());

        $this->basicTable->setSelected([1, 2, 3]);

        $this->assertEquals(3, $this->basicTable->getSelectedCount());
    }

    public function test_can_clear_selected(): void
    {
        $this->basicTable->setSelected([1, 2, 3]);

        $this->basicTable->clearSelected();

        $this->assertEquals(0, $this->basicTable->getSelectedCount());

        $this->basicTable->setSelectAllEnabled();

        $this->assertTrue($this->basicTable->selectAllIsEnabled());

        $this->basicTable->clearSelected();

        $this->assertTrue($this->basicTable->selectAllIsDisabled());
    }

    public function test_select_all_disabled_when_selected_updated(): void
    {
        $this->basicTable->setSelectAllEnabled();

        $this->assertTrue($this->basicTable->selectAllIsEnabled());

        $this->basicTable->setSelected([1]);
        $this->basicTable->updatedSelected();

        $this->assertTrue($this->basicTable->selectAllIsDisabled());
    }

    public function test_update_select_all_clears_or_selects_all_depending_on_status(): void
    {
        $this->basicTable->setSelected([1, 2, 3, 4, 5]);

        $this->assertSame([1, 2, 3, 4, 5], $this->basicTable->getSelected());

        $this->basicTable->setSelected([1]);

        $this->assertSame([1], $this->basicTable->getSelected());
    }

    public function test_set_select_all_selects_all(): void
    {
        $this->assertSame([], $this->basicTable->getSelected());

        $this->basicTable->setAllSelected();

        $this->assertTrue($this->basicTable->selectAllIsEnabled());

        $this->assertSame(['1', '2', '3', '4', '5'], $this->basicTable->getSelected());
    }

    public function test_can_get_bulk_action_confirms(): void
    {
        $this->assertSame([], $this->basicTable->getBulkActionConfirms());
    }

    public function test_can_find_if_bulk_action_has_confirm_message(): void
    {
        $this->assertFalse($this->basicTable->hasConfirmationMessage('test123'));
    }

    public function test_bulk_action_confirm_returns_default_message_if_not_set(): void
    {
        $this->assertSame($this->basicTable->getBulkActionDefaultConfirmationMessage(), $this->basicTable->getBulkActionConfirmMessage('test'));
    }

    public function test_can_get_bulk_action_default_confirmation_message(): void
    {
        $this->assertSame('Are you sure?', $this->basicTable->getBulkActionDefaultConfirmationMessage());
    }

    public function test_select_clears_by_default(): void
    {
        $this->basicTable->setSelected([1, 2, 3, 4, 5]);
        $this->assertSame([1, 2, 3, 4, 5], $this->basicTable->getSelected());

        $this->basicTable->setSearch('Anthony');
        $this->basicTable->updatedSearch('Anthony');

        $this->assertSame([], $this->basicTable->getSelected());
    }

    public function test_select_does_not_clear_when_disabled(): void
    {
        $this->basicTable->setClearSelectedOnSearchDisabled();

        $this->basicTable->setSelected([1, 2, 3, 4, 5]);
        $this->assertSame([1, 2, 3, 4, 5], $this->basicTable->getSelected());

        $this->basicTable->setSearch('Anthony');
        $this->basicTable->updatedSearch('Anthony');

        $this->assertSame([1, 2, 3, 4, 5], $this->basicTable->getSelected());
    }

    public function test_select_does_clear_when_enabled(): void
    {
        $this->basicTable->setClearSelectedOnSearchEnabled();

        $this->basicTable->setSelected([1, 2, 3, 4, 5]);
        $this->assertSame([1, 2, 3, 4, 5], $this->basicTable->getSelected());

        $this->basicTable->setSearch('Anthony');
        $this->basicTable->updatedSearch('Anthony');

        $this->assertSame([], $this->basicTable->getSelected());

    }

    public function test_select_clears_by_default_when_filtering(): void
    {
        $this->basicTable->setSelected([1, 2, 3, 4, 5]);

        $this->assertSame([1, 2, 3, 4, 5], $this->basicTable->getSelected());

        $this->basicTable->setFilter('breed_id_filter', '2');
        $this->basicTable->updatedFilterComponents('2', 'breed_id_filter');

        $this->assertSame([], $this->basicTable->getSelected());
    }

    public function test_select_does_clear_when_filtering_when_enabled(): void
    {
        $this->basicTable->setSelected([1, 2, 3, 4, 5]);
        $this->assertSame([1, 2, 3, 4, 5], $this->basicTable->getSelected());
        $this->basicTable->setClearSelectedOnFilterEnabled();
        $this->basicTable->setFilter('breed_id_filter', '2');
        $this->basicTable->updatedFilterComponents('2', 'breed_id_filter');
        $this->assertSame([], $this->basicTable->getSelected());
    }

    public function test_select_does_not_clear_when_filtering_when_disabled(): void
    {
        $this->basicTable->setSelected([1, 2, 3, 4, 5]);
        $this->assertSame([1, 2, 3, 4, 5], $this->basicTable->getSelected());
        $this->basicTable->setClearSelectedOnFilterDisabled();
        $this->basicTable->setFilter('breed_id_filter', '2');
        $this->basicTable->updatedFilterComponents('2', 'breed_id_filter');
        $this->assertSame([1, 2, 3, 4, 5], $this->basicTable->getSelected());
    }
}
