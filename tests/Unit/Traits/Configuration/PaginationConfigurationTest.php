<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class PaginationConfigurationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        parent::setupUnpaginatedTable();
    }

    public function test_pagination_theme_can_be_set(): void
    {
        $this->assertSame('tailwind', $this->basicTable->getPaginationTheme());

        $this->basicTable->setPaginationTheme('bootstrap');

        $this->assertSame('bootstrap', $this->basicTable->getPaginationTheme());
    }

    public function test_can_set_pagination_status(): void
    {
        $this->assertTrue($this->basicTable->getPaginationStatus());

        $this->basicTable->setPaginationDisabled();

        $this->assertFalse($this->basicTable->getPaginationStatus());

        $this->basicTable->setPaginationEnabled();

        $this->assertTrue($this->basicTable->getPaginationStatus());

        $this->basicTable->setPaginationStatus(false);

        $this->assertFalse($this->basicTable->getPaginationStatus());

        $this->basicTable->setPaginationStatus(true);

        $this->assertTrue($this->basicTable->getPaginationStatus());
    }

    public function test_can_set_pagination_visibility_status(): void
    {
        $this->assertTrue($this->basicTable->getPaginationVisibilityStatus());

        $this->basicTable->setPaginationVisibilityDisabled();

        $this->assertFalse($this->basicTable->getPaginationVisibilityStatus());

        $this->basicTable->setPaginationVisibilityEnabled();

        $this->assertTrue($this->basicTable->getPaginationVisibilityStatus());

        $this->basicTable->setPaginationVisibilityStatus(false);

        $this->assertFalse($this->basicTable->getPaginationVisibilityStatus());

        $this->basicTable->setPaginationVisibilityStatus(true);

        $this->assertTrue($this->basicTable->getPaginationVisibilityStatus());
    }

    public function test_can_set_per_page_visibility_status(): void
    {
        $this->assertTrue($this->basicTable->getPerPageVisibilityStatus());

        $this->basicTable->setPerPageVisibilityDisabled();

        $this->assertFalse($this->basicTable->getPerPageVisibilityStatus());

        $this->basicTable->setPerPageVisibilityEnabled();

        $this->assertTrue($this->basicTable->getPerPageVisibilityStatus());

        $this->basicTable->setPerPageVisibilityStatus(false);

        $this->assertFalse($this->basicTable->getPerPageVisibilityStatus());

        $this->basicTable->setPerPageVisibilityStatus(true);

        $this->assertTrue($this->basicTable->getPerPageVisibilityStatus());
    }

    public function test_can_set_per_page_selection(): void
    {
        $this->assertSame(10, $this->basicTable->getPerPage());

        $this->basicTable->setPerPage(25);

        $this->assertSame(25, $this->basicTable->getPerPage());
    }

    public function test_can_set_per_page_accepted_values(): void
    {
        $this->assertSame([10, 25, 50], $this->basicTable->getPerPageAccepted());

        $this->basicTable->setPerPageAccepted([10, 25, 50, -1]);

        $this->assertSame([10, 25, 50, -1], $this->basicTable->getPerPageAccepted());
    }

    public function test_can_set_per_page_manually(): void
    {
        $this->assertSame(10, $this->basicTable->getPerPage());

        $this->basicTable->perPage = 25;

        $this->assertSame(25, $this->basicTable->getPerPage());
    }

    public function test_can_set_default_per_page(): void
    {
        $this->assertSame(10, $this->basicTable->getPerPage());
        $this->basicTable->unsetPerPage();
        $this->basicTable->setDefaultPerPage(50);
        $this->assertSame(50, $this->basicTable->getDefaultPerPage());
        $this->assertSame(50, $this->basicTable->getPerPage());
        $this->basicTable->perPage = 25;
        $this->assertSame(25, $this->basicTable->getPerPage());
        $this->basicTable->setPerPage(10);
        $this->assertSame(10, $this->basicTable->getPerPage());
        $this->assertSame(50, $this->basicTable->getDefaultPerPage());
        $this->basicTable->unsetPerPage();
        $this->assertSame(50, $this->basicTable->getPerPage());

    }
}
