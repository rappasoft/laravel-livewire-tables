<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\Models\Breed;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

#[Group('Filters')]
final class FilterDefaultValueTest extends TestCase
{
    public function test_checks_that_default_value_for_filter_is_set(): void
    {
        $mock = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->useComputedPropertiesDisabled();

            }

            public function filters(): array
            {
                return [
                    TextFilter::make('Pet Name', 'pet_name_filter')
                        ->filter(function (Builder $builder, string $value) {
                            return $builder->where('pets.name', '=', $value);
                        })
                        ->setFilterDefaultValue('car'),
                ];
            }
        };
        $this->assertSame([], $mock->getAppliedFilters());

        $mock->bootAll();

        $this->assertSame(['pet_name_filter' => 'car'], $mock->getAppliedFilters());

    }
}
