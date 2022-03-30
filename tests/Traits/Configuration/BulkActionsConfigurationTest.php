<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class BulkActionsConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_bulk_actions_status(): void
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

    /** @test */
    public function can_set_select_all_status(): void
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

    /** @test */
    public function can_set_hide_bulk_action_dropdown_status(): void
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

    /** @test */
    public function can_set_bulk_actions(): void
    {
        $this->assertFalse($this->basicTable->hasBulkActions());

        $this->basicTable->setBulkActions(['activate' => 'Activate']);

        $this->assertTrue($this->basicTable->hasBulkActions());
    }
}
