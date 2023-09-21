<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class ColumnSelectConfigurationTest extends TestCase
{
    /** @test */
    public function variables_are_correct_types(): void
    {
        $this->assertIsArray($this->basicTable->selectedColumns);
    }

    /** @test */
    public function check_protected_fields_columnSelectStatus(): void
    {
        $this->expectException(\Livewire\Exceptions\PropertyNotFoundException::class);
        $this->assertIsBool($this->basicTable->columnSelectStatus);
    }

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

    /** @test  */
    public function can_deselect_all_columns(): void
    {
        $this->assertTrue($this->basicTable->getColumnSelectStatus());

        $this->basicTable->deselectAllColumns();

        $this->assertSame([], $this->basicTable->selectedColumns);
    }

    /** @test  */
    public function can_exclude_deselected_columns_from_query_enabled(): void
    {
        $this->basicTable->setExcludeDeselectedColumnsFromQueryEnabled();

        $this->assertTrue($this->basicTable->getExcludeDeselectedColumnsFromQuery());

        $this->basicTable->setExcludeDeselectedColumnsFromQueryDisabled();

        $this->assertFalse($this->basicTable->getExcludeDeselectedColumnsFromQuery());

        $this->basicTable->setExcludeDeselectedColumnsFromQuery(true);

        $this->assertTrue($this->basicTable->getExcludeDeselectedColumnsFromQuery());

    }

    /** @test  */
    public function can_check_all_columns_get_selected(): void
    {
        $this->basicTable->deselectAllColumns();

        $this->assertFalse($this->basicTable->getAllColumnsAreSelected());

        $this->basicTable->selectAllColumns();

        $this->assertTrue($this->basicTable->getAllColumnsAreSelected());

    }

    public function check_get_selected_columns()
    {

        $this->basicTable->deselectAllColumns();

        $this->assertSame([], $this->basicTable->getSelectedColumns());

        $this->basicTable->selectAllColumns();

        $this->assertSame($this->basicTable->selectedColumns, $this->basicTable->getSelectedColumns());

    }
}
