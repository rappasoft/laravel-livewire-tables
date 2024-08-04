<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Support\Facades\Event;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Events\SearchApplied;

final class SearchAppliedTest extends TestCase
{
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_an_event_is_not_emitted_when_a_search_is_applied_by_default()
    {
        Event::fake();

        // Select all columns to test event trigger
        $this->basicTable->setSearch('test');

        Event::assertNotDispatched(SearchApplied::class);
    }

    public function test_an_event_is_not_emitted_when_a_search_is_applied_and_event_disabled()
    {
        Event::fake();

        // Select all columns to test event trigger
        $this->basicTable->disableSearchAppliedEvent()->setSearch('test');

        Event::assertNotDispatched(SearchApplied::class);
    }

    public function test_an_event_is_emitted_when_a_search_is_applied_and_event_enabled()
    {
        Event::fake();

        // Select all columns to test event trigger
        $this->basicTable->enableSearchAppliedEvent()->setSearch('test search');

        Event::assertDispatched(SearchApplied::class);
    }

    public function test_an_event_is_emitted_when_a_search_is_applied_and_event_enabled_with_values()
    {
        Event::fake();

        // Select all columns to test event trigger
        $this->basicTable->enableSearchAppliedEvent()->setSearch('test search value');

        Event::assertDispatched(SearchApplied::class, function ($event) {
            return $event->value == 'test search value' && $event->tableName == $this->basicTable->getTableName();
        });
    }
}
