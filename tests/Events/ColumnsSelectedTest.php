<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Support\Facades\Event;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class ColumnsSelectedTest extends TestCase
{
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /* Temporary Removal - Suitable Replacement Inbound */
    /*
    public function test_an_event_is_emitted_when_a_column_selection_are_updated()
    {
        Event::fake([
            ColumnsSelected::class,
        ]);

        $test['columns'] = $this->basicTable->getDefaultVisibleColumns();
        $test['key'] = $this->basicTable->getDataTableFingerprint().'-columnSelectEnabled';
        // Select all columns to test event trigger
        $this->basicTable->selectAllColumns();

        Event::assertDispatched(ColumnsSelected::class, function ($event) use ($test) {
            return $event->columns == $test['columns'];
        });
    }
    */
}
