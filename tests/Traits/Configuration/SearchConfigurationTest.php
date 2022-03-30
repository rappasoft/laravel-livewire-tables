<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class SearchConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_default_search_term(): void
    {
        $this->assertNull($this->basicTable->getSearch());

        $this->basicTable->setSearch('Anthony');

        $this->assertSame('Anthony', $this->basicTable->getSearch());
    }

    /** @test */
    public function can_set_search_status_status(): void
    {
        $this->assertTrue($this->basicTable->getSearchStatus());

        $this->basicTable->setSearchDisabled();

        $this->assertFalse($this->basicTable->getSearchStatus());

        $this->basicTable->setSearchEnabled();

        $this->assertTrue($this->basicTable->getSearchStatus());

        $this->basicTable->setSearchStatus(false);

        $this->assertFalse($this->basicTable->getSearchStatus());

        $this->basicTable->setSearchStatus(true);

        $this->assertTrue($this->basicTable->getSearchStatus());
    }

    /** @test */
    public function can_set_search_visibility_status_status(): void
    {
        $this->assertTrue($this->basicTable->getSearchVisibilityStatus());

        $this->basicTable->setSearchVisibilityDisabled();

        $this->assertFalse($this->basicTable->getSearchVisibilityStatus());

        $this->basicTable->setSearchVisibilityEnabled();

        $this->assertTrue($this->basicTable->getSearchVisibilityStatus());

        $this->basicTable->setSearchVisibilityStatus(false);

        $this->assertFalse($this->basicTable->getSearchVisibilityStatus());

        $this->basicTable->setSearchVisibilityStatus(true);

        $this->assertTrue($this->basicTable->getSearchVisibilityStatus());
    }

    /** @test */
    public function can_set_search_debounce(): void
    {
        $this->assertFalse($this->basicTable->hasSearchDebounce());

        $this->basicTable->setSearchDebounce(1000);

        $this->assertTrue($this->basicTable->hasSearchDebounce());
        $this->assertSame(1000, $this->basicTable->getSearchDebounce());
        $this->assertSame('.debounce.1000ms', $this->basicTable->getSearchOptions());
    }

    /** @test */
    public function cant_set_search_debounce_with_other_search_modifiers(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $this->basicTable->setSearchDebounce(1000);
        $this->basicTable->setSearchDefer();
    }

    /** @test */
    public function can_set_search_defer(): void
    {
        $this->assertFalse($this->basicTable->hasSearchDefer());

        $this->basicTable->setSearchDefer();

        $this->assertTrue($this->basicTable->hasSearchDefer());
        $this->assertSame('.defer', $this->basicTable->getSearchOptions());
    }

    /** @test */
    public function cant_set_search_defer_with_other_search_modifiers(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $this->basicTable->setSearchDefer();
        $this->basicTable->setSearchDebounce(1000);
    }

    /** @test */
    public function can_set_search_lazy(): void
    {
        $this->assertFalse($this->basicTable->hasSearchLazy());

        $this->basicTable->setSearchLazy();

        $this->assertTrue($this->basicTable->hasSearchLazy());
        $this->assertSame('.lazy', $this->basicTable->getSearchOptions());
    }

    /** @test */
    public function cant_set_search_lazy_with_other_search_modifiers(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $this->basicTable->setSearchLazy();
        $this->basicTable->setSearchDebounce(1000);
    }
}
