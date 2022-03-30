<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class FilterConfigurationTest extends TestCase
{
    /** @test */
    public function filters_status_can_be_set(): void
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

    /** @test */
    public function filters_visibility_status_can_be_set(): void
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

    /** @test */
    public function filters_pills_status_can_be_set(): void
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

    /** @test */
    public function filters_layout_can_be_set(): void
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
}
