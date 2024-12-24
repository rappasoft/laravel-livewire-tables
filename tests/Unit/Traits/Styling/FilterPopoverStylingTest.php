<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Styling;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Filters')]
final class FilterPopoverStylingTest extends TestCase
{
    public function test_filter_popover_attributes_returns_default_if_not_set(): void
    {
        $this->assertSame(['class' => '', 'default-width' => true, 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterPopoverAttributes());
    }

    public function test_filter_popover_attributes_can_be_changed(): void
    {
        $this->assertSame(['class' => '', 'default-width' => true, 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterPopoverAttributes());

        $this->basicTable->setFilterPopoverAttributes(['class' => 'bg-blue-500']);

        $this->assertSame(['class' => 'bg-blue-500', 'default-width' => true, 'default-colors' => true, 'default-styling' => true], $this->basicTable->getFilterPopoverAttributes());

        $this->basicTable->setFilterPopoverAttributes(['class' => 'bg-red-500', 'default-colors' => false]);

        $this->assertSame(['class' => 'bg-red-500', 'default-width' => true, 'default-colors' => false, 'default-styling' => true], $this->basicTable->getFilterPopoverAttributes());

    }
}
