<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Events\FilterApplied;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTableFilterHooks;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\TestExternalArrayFilter;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

#[Group('Filters')]
final class FilterUpdatesTest extends TestCase
{
    public function test_nested_array_items_update_the_owning_filter(): void
    {
        Event::fake([FilterApplied::class]);

        Livewire::test(PetsTableFilterHooks::class)
            ->set('filterHookLog', [])
            ->set('selected', [1, 2])
            ->call('setPage', 2)
            ->set('filterComponents.breed.0', '4')
            ->assertSet('filterComponents.breed', ['4'])
            ->assertSet('appliedFilters.breed', ['4'])
            ->assertSet('filterHookLog', [['updated', 'breed', ['4']]])
            ->assertSet('paginators.page', 1)
            ->assertSet('selected', [])
            ->assertDispatched('filter-was-set', tableName: 'table', filterKey: 'breed', value: ['4'])
            ->assertSee('Cartman')
            ->assertDontSee('May');

        Event::assertDispatched(FilterApplied::class, fn ($event) => $event->key === 'breed' && $event->value === ['4']);
    }

    public function test_replacing_filter_array_applies_each_filter_and_clears_omitted_filters(): void
    {
        Event::fake([FilterApplied::class]);

        $table = Livewire::test(PetsTableFilterHooks::class)
            ->set('filterHookLog', [])
            ->set('filterComponents', ['breed' => ['4'], 'pet_name_filter' => 'Cartman'])
            ->assertSet('filterHookLog', [['updated', 'breed', ['4']], ['updated', 'pet_name_filter', 'Cartman']])
            ->assertSet('appliedFilters', ['breed' => ['4'], 'pet_name_filter' => 'Cartman'])
            ->assertDispatched('filter-was-set', tableName: 'table', filterKey: 'breed', value: ['4'])
            ->assertDispatched('filter-was-set', tableName: 'table', filterKey: 'pet_name_filter', value: 'Cartman')
            ->assertSee('Cartman')
            ->assertDontSee('Tux');

        $table->set('filterHookLog', [])
            ->set('selected', [1])
            ->call('setPage', 2)
            ->set('filterComponents', ['breed' => ['102']])
            ->assertSet('filterComponents.pet_name_filter', null)
            ->assertSet('appliedFilters', ['breed' => ['102']])
            ->assertSet('filterHookLog', [['updated', 'breed', ['102']], ['removed', 'pet_name_filter'], ['reset', 'pet_name_filter']])
            ->assertSet('paginators.page', 1)
            ->assertSet('selected', [])
            ->assertDispatched('filter-was-set', tableName: 'table', filterKey: 'breed', value: ['102'])
            ->assertDispatched('filter-was-set', tableName: 'table', filterKey: 'pet_name_filter', value: null)
            ->assertSee('May')
            ->assertDontSee('Cartman');

        Event::assertDispatched(FilterApplied::class, fn ($event) => $event->key === 'breed' && $event->value === ['102']);
    }

    public function test_clearing_filter_array_runs_removal_hooks_and_resets_pagination(): void
    {
        $table = Livewire::test(PetsTableFilterHooks::class)
            ->set('filterComponents.breed', ['4'])
            ->set('filterHookLog', [])
            ->set('selected', [1])
            ->call('setPage', 2);

        Event::fake([FilterApplied::class]);

        $table->set('filterComponents', [])
            ->assertSet('filterComponents.breed', [])
            ->assertSet('appliedFilters', [])
            ->assertSet('filterHookLog', [['removed', 'breed'], ['reset', 'breed']])
            ->assertSet('paginators.page', 1)
            ->assertSet('selected', [])
            ->assertDispatched('filter-was-set', tableName: 'table', filterKey: 'breed', value: [])
            ->assertSee('Cartman')
            ->assertSee('May');

        Event::assertNotDispatched(FilterApplied::class);
    }

    public function test_replacing_filter_array_does_not_reapply_unchanged_filters(): void
    {
        Livewire::test(PetsTableFilterHooks::class)
            ->set('filterComponents.breed', ['4'])
            ->set('filterHookLog', [])
            ->set('filterComponents', ['breed' => ['4']])
            ->assertSet('filterHookLog', [])
            ->assertNotDispatched('filter-was-set');
    }

    public function test_omitting_an_active_date_range_default_runs_removal_and_restores_the_default(): void
    {
        $default = ['minDate' => '2023-01-01', 'maxDate' => '2023-12-31'];

        Livewire::test(new class extends PetsTableFilterHooks
        {
            public function filters(): array
            {
                return [
                    ...parent::filters(),
                    DateRangeFilter::make('Visit Range')
                        ->setFilterDefaultValue(['2023-01-01', '2023-12-31'])
                        ->filter(fn (Builder $builder, array $value) => $builder->whereBetween('last_visit', [$value['minDate'], $value['maxDate']])),
                ];
            }
        })
            ->assertSet('filterComponents.visit_range', $default)
            ->set('filterHookLog', [])
            ->set('selected', [1])
            ->call('setPage', 2)
            ->set('filterComponents', [])
            ->assertSet('filterComponents.visit_range', $default)
            ->assertSet('appliedFilters.visit_range', $default)
            ->assertSet('filterHookLog', [['removed', 'visit_range'], ['reset', 'visit_range']])
            ->assertSet('paginators.page', 1)
            ->assertSet('selected', [])
            ->assertDispatched('filter-was-set', tableName: 'table', filterKey: 'visit_range', value: $default);
    }

    public function test_external_array_filter_ignores_unrelated_scalar_events_and_accepts_matching_arrays(): void
    {
        Livewire::test(TestExternalArrayFilter::class)
            ->set('selectedItems', ['4'])
            ->dispatch('filter-was-set', tableName: 'table', filterKey: 'pet_name_filter', value: null)
            ->assertSet('selectedItems', ['4'])
            ->assertNotDispatched('livewireArrayFilterUpdateValues')
            ->dispatch('filter-was-set', tableName: 'table', filterKey: 'pet_name_filter', value: 'Cartman')
            ->assertSet('selectedItems', ['4'])
            ->assertNotDispatched('livewireArrayFilterUpdateValues')
            ->dispatch('filter-was-set', tableName: 'another-table', filterKey: 'breed', value: [102])
            ->assertSet('selectedItems', ['4'])
            ->dispatch('filter-was-set', tableName: 'table', filterKey: 'breed', value: 'invalid')
            ->assertSet('selectedItems', ['4'])
            ->dispatch('filter-was-set', tableName: 'table', filterKey: 'breed', value: [102])
            ->assertSet('selectedItems', [102])
            ->assertNotDispatched('livewireArrayFilterUpdateValues');
    }

    public function test_external_array_filter_accepts_whole_array_and_nested_item_updates_and_clears(): void
    {
        Livewire::test(TestExternalArrayFilter::class)
            ->set('selectedItems', ['4'])
            ->assertSet('value', [4])
            ->assertDispatchedTo(PetsTable::class, 'livewireArrayFilterUpdateValues', tableName: 'table', filterKey: 'breed', values: [4 => 'Norwegian Forest'])
            ->set('selectedItems.0', '102')
            ->assertSet('value', [102])
            ->assertDispatchedTo(PetsTable::class, 'livewireArrayFilterUpdateValues', tableName: 'table', filterKey: 'breed', values: [102 => 'Red Setter'])
            ->set('selectedItems', [])
            ->assertSet('value', [])
            ->assertDispatchedTo(PetsTable::class, 'livewireArrayFilterUpdateValues', tableName: 'table', filterKey: 'breed', values: []);
    }
}
