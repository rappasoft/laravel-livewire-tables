<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Filters;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Tests\Models\Breed;

#[Group('Filters')]
final class FilterMenuTest extends TestCase
{
    public function test_can_get_default_filter_popover_attributes(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true, 'default-width' => true], $this->basicTable->getFilterPopoverAttributes());
    }

    public function test_can_get_default_filter_slidedown_attributes(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterSlidedownWrapperAttributes());
    }

    public function test_can_get_default_filter_slidedown_row_attributes(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => 1], $this->basicTable->getFilterSlidedownRowAttributes(1));
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true, 'row' => 2], $this->basicTable->getFilterSlidedownRowAttributes('2'));

    }

    public function test_can_check_filters_with_no_defined_slidedown_rows(): void
    {
        $testTableDefault = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->useComputedPropertiesDisabled();

            }

            public function publiclySetFilterPillsItemAttributes(array $attributes = [])
            {
                $this->setFilterPillsItemAttributes($attributes);
            }

            public function publiclySetResetFilterButtonAttributes(array $attributes = [])
            {
                $this->setFilterPillsResetFilterButtonAttributes($attributes);
            }

            public function publiclySetResetFilterAllButtonAttributes(array $attributes = [])
            {
                $this->setFilterPillsResetAllButtonAttributes($attributes);
            }
        };
        $this->assertFalse($testTableDefault->hasFiltersWithSlidedownRows());
    }

    public function test_can_check_filters_with_defined_slidedown_rows(): void
    {
        $testTableDefault = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->useComputedPropertiesDisabled();

            }

            public function filters(): array
            {
                return [
                    MultiSelectFilter::make('Breed', 'breed')
                        ->setFilterSlidedownRow(2)
                        ->options(
                            Breed::query()
                                ->orderBy('name')
                                ->get()
                                ->keyBy('id')
                                ->map(fn ($breed) => $breed->name)
                                ->toArray()
                        )
                        ->filter(function (Builder $builder, array $values) {
                            return $builder->whereIn('breed_id', $values);
                        }),
                    ];
            }

            public function publiclySetFilterPillsItemAttributes(array $attributes = [])
            {
                $this->setFilterPillsItemAttributes($attributes);
            }

            public function publiclySetResetFilterButtonAttributes(array $attributes = [])
            {
                $this->setFilterPillsResetFilterButtonAttributes($attributes);
            }

            public function publiclySetResetFilterAllButtonAttributes(array $attributes = [])
            {
                $this->setFilterPillsResetAllButtonAttributes($attributes);
            }
        };
        $this->assertTrue($testTableDefault->hasFiltersWithSlidedownRows());
    }


   /* 
    }*/


    
}
