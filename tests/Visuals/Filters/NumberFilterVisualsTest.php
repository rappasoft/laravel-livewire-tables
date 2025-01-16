<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals\Filters;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\BreedsTable;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;

#[Group('Visuals')]
#[Group('Filters')]
final class NumberFilterVisualsTest extends FilterVisualsTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_set_custom_attributes_on_number_filter(): void
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
                    NumberFilter::make('Numberfilter')
                        ->setInputAttributes([
                            'min' => '20',
                            'max' => '100',
                            'steps' => '0.5',
                            'default-colors' => true,
                            'default-styling' => true,
                        ]),
                ];
            }
        })
            ->assertSeeHtml('<input wire:model.blur="filterComponents.numberfilter" class="block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50 border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600" id="table-filter-numberfilter" max="100" min="20" steps="0.5" type="number" wire:key="table-filter-number-numberfilter" />');

    }
}
