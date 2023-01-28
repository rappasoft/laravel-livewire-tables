<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class ColumnSelectConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_column_select_status(): void
    {
        $this->assertTrue($this->basicTable->getColumnSelectStatus());

        $this->basicTable->setColumnSelectDisabled();

        $this->assertFalse($this->basicTable->getColumnSelectStatus());

        $this->basicTable->setColumnSelectEnabled();

        $this->assertTrue($this->basicTable->getColumnSelectStatus());

        $this->basicTable->setColumnSelectStatus(false);

        $this->assertFalse($this->basicTable->getColumnSelectStatus());

        $this->basicTable->setColumnSelectStatus(true);

        $this->assertTrue($this->basicTable->getColumnSelectStatus());
    }

    /** @test */
    public function can_set_remember_column_selection_status(): void
    {
        $this->assertTrue($this->basicTable->getRememberColumnSelectionStatus());

        $this->basicTable->setRememberColumnSelectionDisabled();

        $this->assertFalse($this->basicTable->getRememberColumnSelectionStatus());

        $this->basicTable->setRememberColumnSelectionEnabled();

        $this->assertTrue($this->basicTable->getRememberColumnSelectionStatus());

        $this->basicTable->setRememberColumnSelectionStatus(false);

        $this->assertFalse($this->basicTable->getRememberColumnSelectionStatus());

        $this->basicTable->setRememberColumnSelectionStatus(true);

        $this->assertTrue($this->basicTable->getRememberColumnSelectionStatus());
    }


    /** @test */
    public function can_set_column_select_hidden_on_mobile_status(): void
    {
        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnMobile());

        $this->basicTable->setColumnSelectHiddenOnMobile();

        $this->assertTrue($this->basicTable->getColumnSelectIsHiddenOnMobile());
    }

    /** @test */
    public function can_set_column_select_hidden_on_tablet_status(): void
    {
        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnTablet());

        $this->basicTable->setColumnSelectHiddenOnTablet();

        $this->assertTrue($this->basicTable->getColumnSelectIsHiddenOnTablet());
    }
}
