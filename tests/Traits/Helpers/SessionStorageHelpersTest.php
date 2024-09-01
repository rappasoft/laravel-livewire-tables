<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class SessionStorageHelpersTest extends TestCase
{
    public function test_can_get_session_storage_status_for_filters(): void
    {
        $this->assertFalse($this->basicTable->shouldStoreFiltersInSession());

        $this->basicTable->storeFiltersInSessionEnabled();

        $this->assertTrue($this->basicTable->shouldStoreFiltersInSession());

        $this->basicTable->storeFiltersInSessionDisabled();

        $this->assertFalse($this->basicTable->shouldStoreFiltersInSession());

    }

    public function test_can_get_session_storage_status_filter_key(): void
    {
        $this->assertSame($this->basicTable->getTableName().'-stored-filters', $this->basicTable->getFilterSessionKey());
    }

    public function test_can_get_session_storage_status_for_columnselect(): void
    {
        $this->assertTrue($this->basicTable->shouldStoreColumnSelectInSession());

        $this->basicTable->storeColumnSelectInSessionDisabled();

        $this->assertFalse($this->basicTable->shouldStoreColumnSelectInSession());

        $this->basicTable->storeColumnSelectInSessionEnabled();

        $this->assertTrue($this->basicTable->shouldStoreColumnSelectInSession());

    }

    public function test_can_get_session_storage_status_columnselect_key(): void
    {
        $this->assertSame($this->basicTable->getTableName().'-stored-columnselect', $this->basicTable->getColumnSelectSessionKey());
    }

    public function test_can_store_for_columnselect(): void
    {
        $this->assertTrue($this->basicTable->shouldStoreColumnSelectInSession());

        $this->basicTable->selectedColumns = ['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'];
        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'], $this->basicTable->selectedColumns);
        $this->basicTable->storeColumnSelectValues();
        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'], $this->basicTable->getStoredColumnSelectValues());
        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'], $this->basicTable->selectedColumns);
        $this->basicTable->selectedColumns = ['rowimg'];
        $this->assertSame(['rowimg'], $this->basicTable->selectedColumns);
        $this->basicTable->restoreColumnSelectValues();
        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'], $this->basicTable->getStoredColumnSelectValues());
        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'], $this->basicTable->selectedColumns);
        $this->basicTable->clearStoredColumnSelectValues();
        $this->assertSame([], $this->basicTable->getStoredColumnSelectValues());
        $this->assertSame(['id', 'sort', 'name', 'age', 'breed', 'other', 'rowimg'], $this->basicTable->selectedColumns);
    }
}
