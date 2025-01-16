<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals\Filters;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\BreedsTable;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;

#[Group('Visuals')]
#[Group('Filters')]
final class DateTimeFilterVisualsTest extends FilterVisualsTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_use_default_attributes_on_datetime_filter(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    DateTimeFilter::make('Datetimefilter'),
                ];
            }
        })
            ->assertSeeHtml('<input wire:model.live="filterComponents.datetimefilter" class="block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50 border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600" id="table-filter-datetimefilter" type="datetime-local" wire:key="table-filter-datetime-datetimefilter" />');
    }

    public function test_can_set_custom_attributes_on_datetime_filter(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    DateTimeFilter::make('Datetimefilter')
                        ->setInputAttributes([
                            'min' => '01/01/2024',
                            'max' => '12/12/2024',
                            'default-colors' => true,
                            'default-styling' => true,
                        ]),
                ];
            }
        })
            ->assertSeeHtml('<input wire:model.live="filterComponents.datetimefilter" class="block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50 border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600" id="table-filter-datetimefilter" max="12/12/2024" min="01/01/2024" type="datetime-local" wire:key="table-filter-datetime-datetimefilter" />');
    }
}
