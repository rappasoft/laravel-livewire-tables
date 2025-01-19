<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Filters;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

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
}
