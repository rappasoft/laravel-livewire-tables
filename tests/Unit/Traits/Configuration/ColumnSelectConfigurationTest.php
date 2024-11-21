<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use PHPUnit\Framework\Attributes\Depends;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class ColumnSelectConfigurationTest extends TestCase
{
    public function test_variables_are_correct_types(): void
    {
        $this->assertIsArray($this->basicTable->selectedColumns);
    }

    public function test_check_protected_fields_column_select_status(): void
    {
        $this->expectException(\Livewire\Exceptions\PropertyNotFoundException::class);
        $this->assertIsBool($this->basicTable->columnSelectStatus);
    }

    public function test_can_set_column_select_status(): void
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

    public function test_can_set_remember_column_selection_status(): void
    {
        $this->assertTrue($this->basicTable->shouldStoreColumnSelectInSession());

        $this->basicTable->setRememberColumnSelectionDisabled();

        $this->assertFalse($this->basicTable->shouldStoreColumnSelectInSession());

        $this->basicTable->setRememberColumnSelectionEnabled();

        $this->assertTrue($this->basicTable->shouldStoreColumnSelectInSession());

        $this->basicTable->setRememberColumnSelectionStatus(false);

        $this->assertFalse($this->basicTable->shouldStoreColumnSelectInSession());

        $this->basicTable->setRememberColumnSelectionStatus(true);

        $this->assertTrue($this->basicTable->shouldStoreColumnSelectInSession());
    }

    public function test_can_deselect_all_columns(): void
    {
        $this->assertTrue($this->basicTable->getColumnSelectStatus());

        $this->basicTable->deselectAllColumns();

        $this->assertSame([], $this->basicTable->selectedColumns);
    }

    public function test_can_exclude_deselected_columns_from_query_enabled(): void
    {
        $this->basicTable->setExcludeDeselectedColumnsFromQueryEnabled();

        $this->assertTrue($this->basicTable->getExcludeDeselectedColumnsFromQuery());

        $this->basicTable->setExcludeDeselectedColumnsFromQueryDisabled();

        $this->assertFalse($this->basicTable->getExcludeDeselectedColumnsFromQuery());

        $this->basicTable->setExcludeDeselectedColumnsFromQuery(true);

        $this->assertTrue($this->basicTable->getExcludeDeselectedColumnsFromQuery());

    }

    public function test_can_check_all_columns_get_selected(): void
    {
        $this->basicTable->deselectAllColumns();

        $this->assertSame([], $this->basicTable->getSelectedColumns());

        $this->assertFalse($this->basicTable->getAllColumnsAreSelected());

        $this->basicTable->selectAllColumns();

        $this->assertTrue($this->basicTable->getAllColumnsAreSelected());

    }

    public function test_check_get_selected_columns(): void
    {

        $this->basicTable->deselectAllColumns();

        $this->assertSame([], $this->basicTable->getSelectedColumns());

        $this->basicTable->selectAllColumns();

        $this->assertSame($this->basicTable->selectedColumns, $this->basicTable->getSelectedColumns());

    }

    public function test_can_check_all_columns_get_selected_and_extra_methods_work(): void
    {
        $this->assertTrue($this->basicTable->allSelectedColumnsAreVisibleByDefault());

        $this->assertSame(8, count($this->basicTable->getDefaultVisibleColumns()));

        $this->assertTrue($this->basicTable->allVisibleColumnsAreSelected());

        $this->basicTable->deselectAllColumns();

        $this->assertFalse($this->basicTable->allVisibleColumnsAreSelected());

    }
}
