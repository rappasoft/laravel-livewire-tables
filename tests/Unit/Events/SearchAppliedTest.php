<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Support\Facades\Event;
use Rappasoft\LaravelLivewireTables\Events\SearchApplied;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

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
        $this->basicTable->setSearch('test')->applySearch();

        Event::assertNotDispatched(SearchApplied::class);
    }

    public function test_an_event_is_not_emitted_when_a_search_is_applied_and_event_disabled()
    {
        Event::fake();

        // Select all columns to test event trigger
        $this->basicTable->disableSearchAppliedEvent()->setSearch('test')->applySearch();

        Event::assertNotDispatched(SearchApplied::class);
    }

    public function test_an_event_is_emitted_when_a_search_is_applied_and_event_enabled()
    {
        Event::fake();

        // Select all columns to test event trigger
        $this->basicTable->enableSearchAppliedEvent()->setSearch('test search')->applySearch();

        Event::assertDispatched(SearchApplied::class);
    }

    public function test_an_event_is_emitted_when_a_search_is_applied_and_event_enabled_with_values()
    {
        Event::fake();

        // Select all columns to test event trigger
        $this->basicTable->enableSearchAppliedEvent()->setSearch('test search value')->applySearch();

        Event::assertDispatched(SearchApplied::class, function ($event) {
            return $event->value == 'test search value' && $event->tableName == $this->basicTable->getTableName();
        });
    }

    public function test_an_event_is_emitted_when_a_search_is_applied_and_event_enabled_with_values_and_user()
    {
        Event::fake();

        $user = new \Illuminate\Foundation\Auth\User;
        $user->id = '1234';
        $user->name = 'Bob';
        $this->actingAs($user);

        // Select all columns to test event trigger
        $this->basicTable->enableSearchAppliedEvent()->setSearch('test search value')->applySearch();

        Event::assertDispatched(SearchApplied::class, function ($event) {
            return $event->value == 'test search value' && $event->user->id == '1234' && $event->tableName == $this->basicTable->getTableName();
        });
    }

    public function test_user_not_set_on_event_when_a_search_is_applied_and_user_for_event_disabled()
    {
        Event::fake();

        config()->set('livewire-tables.events.enableUserForEvent', false);

        $user = new \Illuminate\Foundation\Auth\User;
        $user->id = '1234';
        $user->name = 'Bob';
        $this->actingAs($user);

        $this->basicTable->enableSearchAppliedEvent()->setSearch('test')->applySearch();

        Event::assertDispatched(SearchApplied::class, function ($event) {
            $this->assertFalse(isset($event->user), 'User set on Event when config is set to disable this behavior');

            return true;
        });
    }
}
