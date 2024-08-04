<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Support\Facades\Event;
use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class ColumnsSelectedTest extends TestCase
{
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /* Temporary Removal - Suitable Replacement Inbound */
    public function test_an_event_is_emitted_when_a_column_selection_are_updated_by_default()
    {
        Event::fake();

        $this->basicTable->selectAllColumns();
        Event::assertDispatched(ColumnsSelected::class);
    }

    public function test_an_event_is_emitted_when_a_column_selection_and_event_is_enabled()
    {
        Event::fake();

        $this->basicTable->enableColumnSelectEvent()->selectAllColumns();
        Event::assertDispatched(ColumnsSelected::class);
    }

    public function test_an_event_is_not_emitted_when_a_column_selection_and_event_is_disabled()
    {
        Event::fake();

        // Select all columns to test event trigger
        $this->basicTable->disableColumnSelectEvent()->selectAllColumns();

        Event::assertNotDispatched(ColumnsSelected::class);
    }

    public function test_an_event_is_emitted_when_a_column_selection_are_updated__and_event_is_enabled_with_fields_one()
    {
        Event::fake();

        // Select all columns to test event trigger
        $this->basicTable->selectAllColumns();

        Event::assertDispatched(ColumnsSelected::class, function ($event) {
            return $event->columns == $this->basicTable->getSelectedColumns() && $event->tableName == $this->basicTable->getTableName();
        });

    }

    public function test_an_event_is_emitted_when_a_column_selection_are_updated__and_event_is_enabled_with_fields_two()
    {
        Event::fake();

        $this->basicTable->deselectAllColumns();

        Event::assertDispatched(ColumnsSelected::class, function ($event) {
            return $event->columns == [] && $event->tableName == $this->basicTable->getTableName();
        });
    }
}
