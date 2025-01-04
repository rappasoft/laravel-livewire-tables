<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Illuminate\Support\Facades\Event;
use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
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
        $this->assertTrue($this->basicTable->shouldStoreColumnSelectInSession());

        $this->basicTable->setRememberColumnSelectionDisabled();

        $this->assertFalse($this->basicTable->shouldStoreColumnSelectInSession());

        $this->basicTable->setRememberColumnSelectionEnabled();

        $this->assertTrue($this->basicTable->shouldStoreColumnSelectInSession());

        $this->basicTable->storeColumnSelectInSessionDisabled();

        $this->assertFalse($this->basicTable->shouldStoreColumnSelectInSession());

        $this->basicTable->storeColumnSelectInSessionEnabled();

        $this->assertTrue($this->basicTable->shouldStoreColumnSelectInSession());

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

    public function test_can_get_for_query(): void
    {
        $cols = [];
        foreach ($this->basicTable->getSelectedColumnsForQuery() as $column) {
            $cols[] = $column->getColumnSelectName();
        }

        $this->assertSame(['id', 'sort', 'name', 'age', 'breed.name'], $cols);

    }

    public function test_can_get_unselectable_columns(): void
    {
        $cols = [];
        foreach ($this->basicTable->getUnSelectableColumns() as $column) {
            $cols[] = $column->getColumnSelectName();
        }

        $this->assertSame(['sort'], $cols);

    }

    public function test_get_currently_selected_cols_works(): void
    {
        $this->assertSame(8, count($this->basicTable->getDefaultVisibleColumns()));
        $this->assertSame(8, count(array_intersect($this->basicTable->selectedColumns, $this->basicTable->getDefaultVisibleColumns())));

        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'link', 'rowimg'], $this->basicTable->selectedColumns);

        $this->basicTable->selectedColumns = ['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'];
        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'], $this->basicTable->selectedColumns);

        $this->assertSame(7, count(array_intersect($this->basicTable->selectedColumns, $this->basicTable->getDefaultVisibleColumns())));
        $this->assertSame(8, count($this->basicTable->getDefaultVisibleColumns()));

    }

    public function test_event_fires_for_columnselect(): void
    {
        Event::fake();

        $testTable = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
            }
        };
        $testTable->mountManagesFilters();
        $testTable->configure();
        $testTable->boot();
        $testTable->bootedManagesFilters();
        $testTable->bootedComponentUtilities();
        $testTable->bootedWithColumns();
        $testTable->bootedWithColumnSelect();
        $testTable->bootedWithSecondaryHeader();
        $testTable->booted();

        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'link', 'rowimg'], $testTable->selectedColumns);

        $testTable->disableColumnSelectEvent();
        $testTable->selectedColumns = ['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'];
        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'], $testTable->selectedColumns);
        $testTable->updatedSelectedColumns();
        Event::assertNotDispatched(ColumnsSelected::class);

        $testTable->enableColumnSelectEvent();

        $testTable->selectedColumns = ['id', 'sort', 'name', 'age', 'breed', 'other', 'link', 'rowimg'];
        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'link', 'rowimg'], $testTable->selectedColumns);
        $testTable->updatedSelectedColumns();
        Event::assertDispatched(ColumnsSelected::class);

    }

    public function test_event_does_fire_for_columnselect(): void
    {
        Event::fake();

        $testTable = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->enableColumnSelectEvent();
            }
        };
        $testTable->mountManagesFilters();
        $testTable->configure();
        $testTable->boot();
        $testTable->bootedComponentUtilities();
        $testTable->bootedManagesFilters();
        $testTable->bootedWithColumns();
        $testTable->bootedWithColumnSelect();
        $testTable->bootedWithSecondaryHeader();
        $testTable->booted();

        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'link', 'rowimg'], $testTable->selectedColumns);

        $testTable->selectedColumns = ['id', 'sort', 'name', 'age', 'breed', 'other', 'link', 'rowimg'];
        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'link', 'rowimg'], $testTable->selectedColumns);
        $testTable->updatedSelectedColumns();
        Event::assertDispatched(ColumnsSelected::class);

    }

    public function test_event_does_not_fire_for_columnselect(): void
    {
        Event::fake();

        $testTable = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->disableColumnSelectEvent();
            }
        };
        $testTable->mountManagesFilters();
        $testTable->configure();
        $testTable->boot();
        $testTable->bootedManagesFilters();
        $testTable->bootedComponentUtilities();
        $testTable->bootedWithColumns();
        $testTable->bootedWithColumnSelect();
        $testTable->bootedWithSecondaryHeader();
        $testTable->booted();

        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'link', 'rowimg'], $testTable->selectedColumns);
        $testTable->selectedColumns = ['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'];
        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'], $testTable->selectedColumns);
        $testTable->updatedSelectedColumns();
        Event::assertNotDispatched(ColumnsSelected::class);
    }
}
