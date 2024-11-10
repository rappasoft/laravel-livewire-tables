<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Support\Facades\Event;
use Rappasoft\LaravelLivewireTables\Events\FilterApplied;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class FilterAppliedTest extends TestCase
{
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_an_event_is_not_emitted_when_a_filter_is_applied_and_event_disabled()
    {
        Event::fake();

        // Select all columns to test event trigger
        $this->basicTable->disableFilterAppliedEvent()->setFilter('pet_name_filter', 'test 456');

        Event::assertNotDispatched(FilterApplied::class);
    }

    public function test_an_event_is_emitted_when_a_filter_is_applied()
    {
        Event::fake();

        // Select all columns to test event trigger
        $this->basicTable->enableFilterAppliedEvent()->setFilter('pet_name_filter', 'test 123');

        Event::assertDispatched(FilterApplied::class);
    }

    public function test_an_event_is_emitted_when_a_filter_is_applied_with_values()
    {
        Event::fake();

        // Select all columns to test event trigger
        $this->basicTable->enableFilterAppliedEvent()->setFilter('pet_name_filter', 'test value');

        Event::assertDispatched(FilterApplied::class, function ($event) {
            return $event->value == 'test value' && $event->key = 'pet_name_filter' && $event->tableName == $this->basicTable->getTableName();
        });
    }

    public function test_an_event_is_emitted_when_a_filter_is_applied_with_values_and_user()
    {
        Event::fake();

        $user = new \Illuminate\Foundation\Auth\User;
        $user->id = '1234';
        $user->name = 'Bob';
        $this->actingAs($user);

        // Select all columns to test event trigger
        $this->basicTable->enableFilterAppliedEvent()->setFilter('pet_name_filter', 'test value');

        Event::assertDispatched(FilterApplied::class, function ($event) {
            return $event->value == 'test value' && $event->user->id == '1234' && $event->key = 'pet_name_filter' && $event->tableName == $this->basicTable->getTableName();
        });
    }

    public function test_user_not_set_on_event_when_a_filter_is_applied_and_user_for_event_disabled()
    {
        Event::fake();

        config()->set('livewire-tables.events.enableUserForEvent', false);

        $user = new \Illuminate\Foundation\Auth\User;
        $user->id = '1234';
        $user->name = 'Bob';
        $this->actingAs($user);

        $this->basicTable->enableFilterAppliedEvent()->setFilter('pet_name_filter', 'test value');

        Event::assertDispatched(FilterApplied::class, function ($event) {
            $this->assertFalse(isset($event->user), 'User set on Event when config is set to disable this behavior');

            return true;
        });
    }
}
