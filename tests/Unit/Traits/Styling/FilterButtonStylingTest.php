<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Styling;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

#[Group('Filters')]
final class FilterButtonStylingTest extends TestCase
{
    public function test_can_get_default_filter_button_attributes(): void
    {
        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => ''], $this->basicTable->getFilterButtonAttributes());
    }

    public function test_can_get_default_filter_button_badge_attributes(): void
    {
        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => ''], $this->basicTable->getFilterButtonBadgeAttributes());
    }

    public function test_can_change_default_filter_button_attributes(): void
    {
        $testTableDefault = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->useComputedPropertiesDisabled();

            }

            public function publiclySetFilterButtonAttributes(array $attributes = [])
            {
                $this->setFilterButtonAttributes($attributes);
            }
        };
        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => ''], $testTableDefault->getFilterButtonAttributes());
        $testTableDefault->publiclySetFilterButtonAttributes(['class' => 'bg-blue-500']);
        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => 'bg-blue-500'], $testTableDefault->getFilterButtonAttributes());
        $testTableDefault->publiclySetFilterButtonAttributes(['class' => 'bg-blue-500', 'default-colors' => false]);
        $this->assertSame(['default-styling' => true, 'default-colors' => false, 'class' => 'bg-blue-500'], $testTableDefault->getFilterButtonAttributes());
    }

    public function test_can_change_default_filter_button_badge_attributes(): void
    {
        $testTableDefault = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->useComputedPropertiesDisabled();

            }

            public function publiclySetFilterButtonBadgeAttributes(array $attributes = [])
            {
                $this->setFilterButtonBadgeAttributes($attributes);
            }
        };
        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => ''], $testTableDefault->getFilterButtonBadgeAttributes());
        $testTableDefault->publiclySetFilterButtonBadgeAttributes(['class' => 'bg-blue-500']);
        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => 'bg-blue-500'], $testTableDefault->getFilterButtonBadgeAttributes());
        $testTableDefault->publiclySetFilterButtonBadgeAttributes(['class' => 'bg-blue-500', 'default-colors' => false]);
        $this->assertSame(['default-styling' => true, 'default-colors' => false, 'class' => 'bg-blue-500'], $testTableDefault->getFilterButtonBadgeAttributes());
    }
}
