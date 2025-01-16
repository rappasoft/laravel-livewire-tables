<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals\Filters;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\BreedsTable;
use Rappasoft\LaravelLivewireTables\Views\Filters\BooleanFilter;

#[Group('Visuals')]
#[Group('Filters')]
final class BooleanFilterVisualsTest extends FilterVisualsTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_set_custom_attributes_on_boolean_filter(): void
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
                    BooleanFilter::make('Boolfilter')
                        ->setInputAttributes([
                            'blobColor' => 'bg-green-500',
                            'activeColor' => 'bg-red-500',
                            'inactiveColor' => 'bg-blue-500',
                            'default-styling' => true,
                        ]),
                ];
            }
        })
            ->assertSeeHtml('<span :class="(value == 1 || value == true) ? \'translate-x-[18px]\' : \'translate-x-0.5\'" class="w-5 h-5 duration-200 ease-in-out rounded-full shadow-md bg-green-500"></span>')
            ->assertSeeHtml('<button x-cloak class="relative inline-flex h-6 py-0.5 ml-4 focus:outline-none rounded-full w-10" :class="(value == 1 || value == true) ? &#039;bg-red-500&#039; : &#039;bg-blue-500&#039;" @click="toggleStatusWithUpdate" id="table-filter-boolfilter" type="button" x-ref="switchButton">');
    }
}
