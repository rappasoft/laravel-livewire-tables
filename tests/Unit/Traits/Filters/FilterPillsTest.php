<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Filters;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Filters')]
final class FilterPillsTest extends TestCase
{
    public function test_can_get_default_filter_pills_item_attributes(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterPillsItemAttributes());
    }

    public function test_can_get_default_filter_reset_filter_button_attributes(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterPillsResetFilterButtonAttributes());
    }

    public function test_can_get_default_filter_reset_all_filter_button_attributes(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterPillsResetAllButtonAttributes());
    }

    public function test_can_change_default_filter_pills_item_attributes(): void
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
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $testTableDefault->getFilterPillsItemAttributes());
        $testTableDefault->publiclySetFilterPillsItemAttributes(['class' => 'bg-blue-500']);
        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => true], $testTableDefault->getFilterPillsItemAttributes());
        $testTableDefault->publiclySetFilterPillsItemAttributes(['class' => 'bg-blue-500', 'default-colors' => false]);
        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => false, 'default-styling' => true], $testTableDefault->getFilterPillsItemAttributes());

    }

    public function test_can_change_default_filter_pills_reset_button_attributes(): void
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

        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $testTableDefault->getFilterPillsResetFilterButtonAttributes());
        $testTableDefault->publiclySetResetFilterButtonAttributes(['class' => 'bg-red-500']);
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => true, 'default-styling' => true], $testTableDefault->getFilterPillsResetFilterButtonAttributes());
        $testTableDefault->publiclySetResetFilterButtonAttributes(['class' => 'bg-red-500', 'default-colors' => false]);
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => false, 'default-styling' => true], $testTableDefault->getFilterPillsResetFilterButtonAttributes());

    }

    public function test_can_change_default_filter_pills_reset_all_button_attributes(): void
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

        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $testTableDefault->getFilterPillsResetAllButtonAttributes());
        $testTableDefault->publiclySetResetFilterAllButtonAttributes(['class' => 'bg-red-500']);
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => true, 'default-styling' => true], $testTableDefault->getFilterPillsResetAllButtonAttributes());
        $testTableDefault->publiclySetResetFilterAllButtonAttributes(['class' => 'bg-red-500', 'default-colors' => false]);
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => false, 'default-styling' => true], $testTableDefault->getFilterPillsResetAllButtonAttributes());

    }
}
