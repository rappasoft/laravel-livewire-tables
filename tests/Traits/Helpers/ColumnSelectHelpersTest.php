<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class ColumnSelectHelpersTest extends TestCase
{
    /** @test */
    public function can_get_column_select_status(): void
    {
        $this->assertTrue($this->basicTable->columnSelectIsEnabled());

        $this->basicTable->setColumnSelectDisabled();

        $this->assertTrue($this->basicTable->columnSelectIsDisabled());

        $this->basicTable->setColumnSelectEnabled();

        $this->assertTrue($this->basicTable->columnSelectIsEnabled());
    }

    /** @test */
    public function can_get_remember_column_selection_status(): void
    {
        $this->assertTrue($this->basicTable->rememberColumnSelectionIsEnabled());

        $this->basicTable->setRememberColumnSelectionDisabled();

        $this->assertTrue($this->basicTable->rememberColumnSelectionIsDisabled());

        $this->basicTable->setRememberColumnSelectionEnabled();

        $this->assertTrue($this->basicTable->rememberColumnSelectionIsEnabled());
    }
}
