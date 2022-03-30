<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class PaginationHelpersTest extends TestCase
{
    /** @test */
    public function can_get_pagination_status(): void
    {
        $this->assertTrue($this->basicTable->paginationIsEnabled());

        $this->basicTable->setPaginationDisabled();

        $this->assertTrue($this->basicTable->paginationIsDisabled());

        $this->basicTable->setPaginationEnabled();

        $this->assertTrue($this->basicTable->paginationIsEnabled());
    }

    /** @test */
    public function can_get_pagination_visibility_status(): void
    {
        $this->assertTrue($this->basicTable->paginationVisibilityIsEnabled());

        $this->basicTable->setPaginationVisibilityDisabled();

        $this->assertTrue($this->basicTable->paginationVisibilityIsDisabled());

        $this->basicTable->setPaginationVisibilityEnabled();

        $this->assertTrue($this->basicTable->paginationVisibilityIsEnabled());
    }

    /** @test */
    public function can_get_computed_page_name(): void
    {
        $this->assertSame('page', $this->basicTable->getComputedPageName());

        $this->basicTable->setTableName('users');

        $this->assertSame('usersPage', $this->basicTable->getComputedPageName());

        $this->basicTable->setPageName('newPage');

        $this->assertSame('newPage', $this->basicTable->getComputedPageName());
    }

    /** @test */
    public function can_get_per_page_selection(): void
    {
        $this->assertSame(10, $this->basicTable->getPerPage());
    }

    /** @test */
    public function can_get_per_page_accepted(): void
    {
        $this->assertSame([10, 25, 50], $this->basicTable->getPerPageAccepted());
    }

    /** @test */
    public function can_get_per_page_visibility_status(): void
    {
        $this->assertTrue($this->basicTable->perPageVisibilityIsEnabled());

        $this->basicTable->setPerPageVisibilityDisabled();

        $this->assertTrue($this->basicTable->perPageVisibilityIsDisabled());

        $this->basicTable->setPerPageVisibilityEnabled();

        $this->assertTrue($this->basicTable->perPageVisibilityIsEnabled());
    }
}
