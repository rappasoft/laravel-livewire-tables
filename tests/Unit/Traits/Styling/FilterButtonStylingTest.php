<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Styling;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Filters')]
final class FilterButtonStylingTest extends TestCase
{
    public function test_filter_button_attributes_returns_default_if_not_set(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterButtonAttributes());
    }

    public function test_filter_button_attributes_can_be_changed(): void
    {
        $this->basicTable->setFilterButtonAttributes(['class' => 'bg-blue-500']);

        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterButtonAttributes());

        $this->basicTable->setFilterButtonAttributes(['class' => 'bg-red-500', 'default-colors' => false]);

        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => false, 'default-styling' => true], $this->basicTable->getFilterButtonAttributes());
    }

    public function test_filter_button_badge_attributes_returns_default_if_not_set(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterButtonBadgeAttributes());
    }

    public function test_filter_button_badge_attributes_can_be_changed(): void
    {
        $this->basicTable->setFilterButtonBadgeAttributes(['class' => 'bg-blue-500']);

        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterButtonBadgeAttributes());

        $this->basicTable->setFilterButtonBadgeAttributes(['class' => 'bg-red-500', 'default-colors' => false]);

        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => false, 'default-styling' => true], $this->basicTable->getFilterButtonBadgeAttributes());
    }
}
