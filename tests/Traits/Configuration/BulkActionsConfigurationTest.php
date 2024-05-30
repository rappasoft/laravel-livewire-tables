<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class BulkActionsConfigurationTest extends TestCase
{
    public function test_variables_are_correct_types(): void
    {
        $this->assertIsBool($this->basicTable->bulkActionsStatus);
        $this->assertIsBool($this->basicTable->selectAll);
        $this->assertIsBool($this->basicTable->hideBulkActionsWhenEmpty);
        $this->assertIsArray($this->basicTable->bulkActions);
        $this->assertIsArray($this->basicTable->selected);
    }

    public function test_can_set_bulk_actions_status(): void
    {
        $this->assertTrue($this->basicTable->getBulkActionsStatus());

        $this->basicTable->setBulkActionsDisabled();

        $this->assertFalse($this->basicTable->getBulkActionsStatus());

        $this->basicTable->setBulkActionsEnabled();

        $this->assertTrue($this->basicTable->getBulkActionsStatus());

        $this->basicTable->setBulkActionsStatus(false);

        $this->assertFalse($this->basicTable->getBulkActionsStatus());

        $this->basicTable->setBulkActionsStatus(true);

        $this->assertTrue($this->basicTable->getBulkActionsStatus());
    }

    public function test_can_set_select_all_status(): void
    {
        $this->assertFalse($this->basicTable->getSelectAllStatus());

        $this->basicTable->setSelectAllEnabled();

        $this->assertTrue($this->basicTable->getSelectAllStatus());

        $this->basicTable->setSelectAllDisabled();

        $this->assertFalse($this->basicTable->getSelectAllStatus());

        $this->basicTable->setSelectAllStatus(true);

        $this->assertTrue($this->basicTable->getSelectAllStatus());

        $this->basicTable->setSelectAllStatus(false);

        $this->assertFalse($this->basicTable->getSelectAllStatus());
    }

    public function test_can_set_hide_bulk_action_dropdown_status(): void
    {
        $this->assertFalse($this->basicTable->getHideBulkActionsWhenEmptyStatus());

        $this->basicTable->setHideBulkActionsWhenEmptyEnabled();

        $this->assertTrue($this->basicTable->getHideBulkActionsWhenEmptyStatus());

        $this->basicTable->setHideBulkActionsWhenEmptyDisabled();

        $this->assertFalse($this->basicTable->getHideBulkActionsWhenEmptyStatus());

        $this->basicTable->setHideBulkActionsWhenEmptyStatus(true);

        $this->assertTrue($this->basicTable->getHideBulkActionsWhenEmptyStatus());

        $this->basicTable->setHideBulkActionsWhenEmptyStatus(false);

        $this->assertFalse($this->basicTable->getHideBulkActionsWhenEmptyStatus());
    }

    public function test_can_set_bulk_actions(): void
    {
        $this->assertFalse($this->basicTable->hasBulkActions());

        $this->basicTable->setBulkActions(['activate' => 'Activate']);

        $this->assertTrue($this->basicTable->hasBulkActions());
    }

    public function test_can_set_bulk_action_confirms(): void
    {
        $this->assertSame([], $this->basicTable->getBulkActionConfirms());

        $this->basicTable->setBulkActionConfirms(['deactivate', 'delete']);

        $this->assertSame(['deactivate', 'delete'], $this->basicTable->getBulkActionConfirms());

    }

    public function test_can_set_bulk_action_custom_message(): void
    {
        $this->basicTable->setBulkActionConfirms(['deactivate', 'delete']);

        $this->assertSame($this->basicTable->getBulkActionDefaultConfirmationMessage(), $this->basicTable->getBulkActionConfirmMessage('deactivate'));

        $this->basicTable->setBulkActionConfirmMessage('deactivate', 'do you want to deactivate?');

        $this->assertSame('do you want to deactivate?', $this->basicTable->getBulkActionConfirmMessage('deactivate'));

        $this->assertSame($this->basicTable->getBulkActionDefaultConfirmationMessage(), $this->basicTable->getBulkActionConfirmMessage('delete'));

    }

    public function test_can_set_bulk_action_custom_messages(): void
    {
        $this->basicTable->setBulkActionConfirms(['purge', 'delete', 'reassign', 'deactivate']);

        $this->assertSame($this->basicTable->getBulkActionDefaultConfirmationMessage(), $this->basicTable->getBulkActionConfirmMessage('deactivate'));
        $this->assertSame($this->basicTable->getBulkActionDefaultConfirmationMessage(), $this->basicTable->getBulkActionConfirmMessage('reassign'));
        $this->assertSame($this->basicTable->getBulkActionDefaultConfirmationMessage(), $this->basicTable->getBulkActionConfirmMessage('delete'));
        $this->assertSame($this->basicTable->getBulkActionDefaultConfirmationMessage(), $this->basicTable->getBulkActionConfirmMessage('purge'));

        $this->basicTable->setBulkActionConfirmMessages([
            'delete' => 'Are you sure you want to delete these items?',
            'purge' => 'Are you sure you want to purge these items?',
            'reassign' => 'This will reassign selected items, are you sure?',
        ]);

        $this->assertSame('Are you sure you want to delete these items?', $this->basicTable->getBulkActionConfirmMessage('delete'));
        $this->assertSame('This will reassign selected items, are you sure?', $this->basicTable->getBulkActionConfirmMessage('reassign'));
        $this->assertSame($this->basicTable->getBulkActionDefaultConfirmationMessage(), $this->basicTable->getBulkActionConfirmMessage('deactivate'));
        $this->assertSame('Are you sure you want to purge these items?', $this->basicTable->getBulkActionConfirmMessage('purge'));
    }

    public function test_can_set_bulk_action_default_confirmation_message(): void
    {
        $this->assertSame('Are you sure?', $this->basicTable->getBulkActionDefaultConfirmationMessage());

        $this->basicTable->setBulkActionDefaultConfirmationMessage('Test Default Message');

        $this->assertSame('Test Default Message', $this->basicTable->getBulkActionDefaultConfirmationMessage());

    }

    public function test_can_set_bulk_actions_td_attributes(): void
    {
        $this->assertSame(['default' => true], $this->basicTable->getBulkActionsTdAttributes());

        $this->basicTable->setBulkActionsTdAttributes(['class' => 'bg-blue-500']);

        $this->assertSame(['default' => true, 'class' => 'bg-blue-500'], $this->basicTable->getBulkActionsTdAttributes());

        $this->basicTable->setBulkActionsTdAttributes(['class' => 'bg-blue-500', 'default' => false]);

        $this->assertSame(['default' => false, 'class' => 'bg-blue-500'], $this->basicTable->getBulkActionsTdAttributes());
    }

    public function test_can_set_bulk_actions_td_checkbox_attributes(): void
    {
        $this->assertSame(['default' => true], $this->basicTable->getBulkActionsTdCheckboxAttributes());

        $this->basicTable->setBulkActionsTdCheckboxAttributes(['class' => 'bg-gray-500']);

        $this->assertSame(['default' => true, 'class' => 'bg-gray-500'], $this->basicTable->getBulkActionsTdCheckboxAttributes());

        $this->basicTable->setBulkActionsTdCheckboxAttributes(['class' => 'bg-gray-500', 'default' => false]);

        $this->assertSame(['default' => false, 'class' => 'bg-gray-500'], $this->basicTable->getBulkActionsTdCheckboxAttributes());
    }

    public function test_can_set_bulk_actions_th_attributes(): void
    {
        $this->assertSame(['default' => true], $this->basicTable->getBulkActionsThAttributes());

        $this->basicTable->setBulkActionsThAttributes(['class' => 'bg-red-500']);

        $this->assertSame(['default' => true, 'class' => 'bg-red-500'], $this->basicTable->getBulkActionsThAttributes());

        $this->basicTable->setBulkActionsThAttributes(['class' => 'bg-red-500', 'default' => false]);

        $this->assertSame(['default' => false, 'class' => 'bg-red-500'], $this->basicTable->getBulkActionsThAttributes());
    }

    public function test_can_set_bulk_actions_th_checkbox_attributes(): void
    {
        $this->assertSame(['default' => true], $this->basicTable->getBulkActionsThCheckboxAttributes());

        $this->basicTable->setBulkActionsThCheckboxAttributes(['class' => 'bg-green-500']);

        $this->assertSame(['default' => true, 'class' => 'bg-green-500'], $this->basicTable->getBulkActionsThCheckboxAttributes());

        $this->basicTable->setBulkActionsThCheckboxAttributes(['class' => 'bg-green-500', 'default' => false]);

        $this->assertSame(['default' => false, 'class' => 'bg-green-500'], $this->basicTable->getBulkActionsThCheckboxAttributes());
    }
}
