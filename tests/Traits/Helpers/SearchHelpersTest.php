<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class SearchHelpersTest extends TestCase
{
    /** @test */
    public function can_see_if_there_is_a_search_term(): void
    {
        $this->assertFalse($this->basicTable->hasSearch());

        $this->basicTable->setSearch('Anthony');

        $this->assertTrue($this->basicTable->hasSearch());
    }

    /** @test */
    public function can_get_search_term(): void
    {
        $this->basicTable->setSearch('Anthony');

        $this->assertSame('Anthony', $this->basicTable->getSearch());
    }

    /** @test */
    public function can_clear_current_search(): void
    {
        $this->basicTable->setSearch('Anthony');

        $this->assertSame('Anthony', $this->basicTable->getSearch());

        $this->basicTable->clearSearch();

        $this->assertFalse($this->basicTable->hasSearch());
    }

    /** @test */
    public function can_get_search_status(): void
    {
        $this->assertTrue($this->basicTable->searchIsEnabled());

        $this->basicTable->setSearchDisabled();

        $this->assertTrue($this->basicTable->searchIsDisabled());

        $this->basicTable->setSearchEnabled();

        $this->assertTrue($this->basicTable->searchIsEnabled());
    }

    /** @test */
    public function can_get_search_visibility_status(): void
    {
        $this->assertTrue($this->basicTable->searchVisibilityIsEnabled());

        $this->basicTable->setSearchVisibilityDisabled();

        $this->assertTrue($this->basicTable->searchVisibilityIsDisabled());

        $this->basicTable->setSearchVisibilityEnabled();

        $this->assertTrue($this->basicTable->searchVisibilityIsEnabled());
    }

    /** @test */
    public function can_check_if_search_debounce_is_set(): void
    {
        $this->assertFalse($this->basicTable->hasSearchDebounce());

        $this->basicTable->setSearchDebounce(1000);

        $this->assertTrue($this->basicTable->hasSearchDebounce());
    }

    /** @test */
    public function can_check_if_search_defer_is_set(): void
    {
        $this->assertFalse($this->basicTable->hasSearchDefer());

        $this->basicTable->setSearchDefer();

        $this->assertTrue($this->basicTable->hasSearchDefer());
    }

    /** @test */
    public function can_check_if_search_lazy_is_set(): void
    {
        $this->assertFalse($this->basicTable->hasSearchLazy());

        $this->basicTable->setSearchLazy();

        $this->assertTrue($this->basicTable->hasSearchLazy());
    }
}
