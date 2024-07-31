<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class ColumnSelectHelpersTest extends TestCase
{
    public function test_can_get_column_select_status(): void
    {
        $this->assertTrue($this->basicTable->columnSelectIsEnabled());

        $this->basicTable->setColumnSelectDisabled();

        $this->assertTrue($this->basicTable->columnSelectIsDisabled());

        $this->basicTable->setColumnSelectEnabled();

        $this->assertTrue($this->basicTable->columnSelectIsEnabled());
    }

    public function test_can_get_remember_column_selection_status(): void
    {
        $this->assertTrue($this->basicTable->rememberColumnSelectionIsEnabled());

        $this->basicTable->setRememberColumnSelectionDisabled();

        $this->assertTrue($this->basicTable->rememberColumnSelectionIsDisabled());

        $this->basicTable->setRememberColumnSelectionEnabled();

        $this->assertTrue($this->basicTable->rememberColumnSelectionIsEnabled());
    }

    public function test_can_set_column_select_hidden_on_mobile_status(): void
    {
        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnMobile());

        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnTablet());

        $this->basicTable->setColumnSelectHiddenOnMobile();

        $this->assertTrue($this->basicTable->getColumnSelectIsHiddenOnMobile());

        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnTablet());
    }

    public function test_can_set_column_select_hidden_on_tablet_status(): void
    {
        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnMobile());

        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnTablet());

        $this->basicTable->setColumnSelectHiddenOnTablet();

        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnMobile());

        $this->assertTrue($this->basicTable->getColumnSelectIsHiddenOnTablet());
    }
}
