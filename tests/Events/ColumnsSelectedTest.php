<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Support\Facades\Event;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class ColumnsSelectedTest extends TestCase
{
    /** @test */
    public function an_event_is_emitted_when_a_column_selection_are_updated()
    {
        Event::fake([
          ColumnsSelected::class,
          ]);

        $test['columns'] = $this->basicTable->selectedColumns;
        $test['key'] = $this->basicTable->getDataTableFingerprint().'-columnSelectEnabled';
      
        // Select all columns to test event trigger
        $this->basicTable->selectAllColumns();

        Event::assertDispatched(ColumnsSelected::class, function ($event) use ($test) {
            return ($event->columns === $test['columns'] && $event->key === $test['key']);
        });
    }
}
