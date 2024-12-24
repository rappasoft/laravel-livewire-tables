<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Filters')]
final class FilterConfigurationTest extends TestCase
{
    public function test_filters_status_can_be_set(): void
    {
        $this->assertTrue($this->basicTable->getFiltersStatus());

        $this->basicTable->setFiltersDisabled();

        $this->assertFalse($this->basicTable->getFiltersStatus());

        $this->basicTable->setFiltersEnabled();

        $this->assertTrue($this->basicTable->getFiltersStatus());

        $this->basicTable->setFiltersStatus(false);

        $this->assertFalse($this->basicTable->getFiltersStatus());

        $this->basicTable->setFiltersStatus(true);

        $this->assertTrue($this->basicTable->getFiltersStatus());
    }

    public function test_filters_visibility_status_can_be_set(): void
    {
        $this->assertTrue($this->basicTable->getFiltersVisibilityStatus());

        $this->basicTable->setFiltersVisibilityDisabled();

        $this->assertFalse($this->basicTable->getFiltersVisibilityStatus());

        $this->basicTable->setFiltersVisibilityEnabled();

        $this->assertTrue($this->basicTable->getFiltersVisibilityStatus());

        $this->basicTable->setFiltersVisibilityStatus(false);

        $this->assertFalse($this->basicTable->getFiltersVisibilityStatus());

        $this->basicTable->setFiltersVisibilityStatus(true);

        $this->assertTrue($this->basicTable->getFiltersVisibilityStatus());
    }

    public function test_filters_pills_status_can_be_set(): void
    {
        $this->assertTrue($this->basicTable->getFilterPillsStatus());

        $this->basicTable->setFilterPillsDisabled();

        $this->assertFalse($this->basicTable->getFilterPillsStatus());

        $this->basicTable->setFilterPillsEnabled();

        $this->assertTrue($this->basicTable->getFilterPillsStatus());

        $this->basicTable->setFilterPillsStatus(false);

        $this->assertFalse($this->basicTable->getFilterPillsStatus());

        $this->basicTable->setFilterPillsStatus(true);

        $this->assertTrue($this->basicTable->getFilterPillsStatus());
    }

    public function test_filters_layout_can_be_set(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $this->assertSame('popover', $this->basicTable->getFilterLayout());

        $this->basicTable->setFilterLayout('slide-down');

        $this->assertSame('slide-down', $this->basicTable->getFilterLayout());

        $this->basicTable->setFilterLayout('popover');

        $this->assertSame('popover', $this->basicTable->getFilterLayout());

        $this->basicTable->setFilterLayout('popover2');

        $this->assertSame('popover', $this->basicTable->getFilterLayout());

        $this->basicTable->setFilterLayoutSlideDown();

        $this->basicTable->setFilterLayout('slide-down');

        $this->basicTable->setFilterLayoutPopover();

        $this->basicTable->setFilterLayout('popover');
    }

    public function test_filters_layout_popover_default_can_be_set(): void
    {
        $this->assertFalse($this->basicTable->filterSlideDownDefaultVisible);

        $this->basicTable->setFilterSlideDownDefaultStatusEnabled();

        $this->assertTrue($this->basicTable->filterSlideDownDefaultVisible);

        $this->basicTable->setFilterSlideDownDefaultStatusDisabled();

        $this->assertFalse($this->basicTable->filterSlideDownDefaultVisible);

        $this->basicTable->setFilterSlideDownDefaultStatus(true);

        $this->assertTrue($this->basicTable->filterSlideDownDefaultVisible);

        $this->basicTable->setFilterSlideDownDefaultStatus(false);

        $this->assertFalse($this->basicTable->filterSlideDownDefaultVisible);
    }
}
