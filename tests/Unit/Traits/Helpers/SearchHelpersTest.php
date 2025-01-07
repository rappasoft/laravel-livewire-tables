<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class SearchHelpersTest extends TestCase
{
    public function test_can_see_if_there_is_a_search_term(): void
    {
        $this->assertFalse($this->basicTable->hasSearch());

        $this->basicTable->setSearch('Anthony');

        $this->assertTrue($this->basicTable->hasSearch());
    }

    public function test_can_get_search_term(): void
    {
        $this->basicTable->setSearch('Anthony');

        $this->assertSame('Anthony', $this->basicTable->getSearch());
    }

    public function test_can_clear_current_search(): void
    {
        $this->basicTable->setSearch('Anthony');

        $this->assertSame('Anthony', $this->basicTable->getSearch());

        $this->basicTable->clearSearch();

        $this->assertFalse($this->basicTable->hasSearch());
    }

    public function test_can_get_search_status(): void
    {
        $this->assertTrue($this->basicTable->searchIsEnabled());

        $this->basicTable->setSearchDisabled();

        $this->assertTrue($this->basicTable->searchIsDisabled());

        $this->basicTable->setSearchEnabled();

        $this->assertTrue($this->basicTable->searchIsEnabled());
    }

    public function test_can_get_search_visibility_status(): void
    {
        $this->assertTrue($this->basicTable->searchVisibilityIsEnabled());

        $this->basicTable->setSearchVisibilityDisabled();

        $this->assertTrue($this->basicTable->searchVisibilityIsDisabled());

        $this->basicTable->setSearchVisibilityEnabled();

        $this->assertTrue($this->basicTable->searchVisibilityIsEnabled());
    }

    public function test_can_check_if_search_debounce_is_set(): void
    {
        $this->assertFalse($this->basicTable->hasSearchDebounce());

        $this->basicTable->setSearchDebounce(1000);

        $this->assertTrue($this->basicTable->hasSearchDebounce());
    }

    public function test_can_check_if_search_defer_is_set(): void
    {
        $this->assertFalse($this->basicTable->hasSearchDefer());

        $this->basicTable->setSearchDefer();

        $this->assertTrue($this->basicTable->hasSearchDefer());
    }

    public function test_can_check_if_search_blur_is_set(): void
    {
        $this->assertFalse($this->basicTable->hasSearchBlur());

        $this->basicTable->setSearchBlur();

        $this->assertTrue($this->basicTable->hasSearchBlur());
    }

    public function test_can_check_if_search_lazy_is_set(): void
    {
        $this->assertFalse($this->basicTable->hasSearchLazy());

        $this->basicTable->setSearchLazy();

        $this->assertTrue($this->basicTable->hasSearchLazy());
    }

    public function test_can_check_if_search_throttle_is_set(): void
    {
        $this->assertFalse($this->basicTable->hasSearchThrottle());

        $this->basicTable->setSearchThrottle(180);

        $this->assertSame(180, $this->basicTable->getSearchThrottle());
    }

    public function test_can_check_if_has_search_placeholder(): void
    {
        $this->assertFalse($this->basicTable->hasSearchPlaceholder());

        $this->basicTable->setSearchPlaceholder('Test');

        $this->assertTrue($this->basicTable->hasSearchPlaceholder());
    }

    public function test_can_trim_whitespace_from_search(): void
    {
        $this->basicTable->setSearch('Anthony  ');

        $this->assertSame('Anthony  ', $this->basicTable->getSearch());

        $this->basicTable->setTrimSearchStringEnabled();

        $this->basicTable->clearSearch();

        $this->basicTable->setSearch('Anthony  ');

        $this->assertSame('Anthony', $this->basicTable->getSearch());

        $this->basicTable->clearSearch();

        $this->basicTable->setSearch('   Anthony');

        $this->assertSame('Anthony', $this->basicTable->getSearch());

        $this->basicTable->clearSearch();

        $this->basicTable->setSearch('   Anthony   ');

        $this->assertSame('Anthony', $this->basicTable->getSearch());

        $this->basicTable->clearSearch();

        $this->basicTable->setTrimSearchStringDisabled();

        $this->basicTable->setSearch('   Anthony   ');

        $this->assertSame('   Anthony   ', $this->basicTable->getSearch());

    }

    public function test_can_test_all_search_options(): void
    {
        $temp = new class extends PetsTable
        {
            public function resetSearchConfiguration(): self
            {
                $this->searchFilterBlur = null;
                $this->searchFilterDebounce = null;
                $this->searchFilterDefer = null;
                $this->searchFilterLazy = null;
                $this->searchFilterLive = null;
                $this->searchFilterThrottle = null;

                return $this;
            }
        };

        $this->assertFalse($temp->hasSearchDebounce());

        $temp->setSearchDebounce(1000);

        $this->assertSame('.live.debounce.1000ms', $temp->getSearchOptions());

        $temp->resetSearchConfiguration()->setSearchDefer();

        $this->assertSame('', $temp->getSearchOptions());

        $temp->resetSearchConfiguration()->setSearchLive();

        $this->assertSame('.live', $temp->getSearchOptions());

        $temp->resetSearchConfiguration()->setSearchBlur();

        $this->assertSame('.blur', $temp->getSearchOptions());

        $temp->resetSearchConfiguration()->setSearchLazy();

        $this->assertSame('.live.lazy', $temp->getSearchOptions());

        $temp->resetSearchConfiguration()->setSearchThrottle(599);

        $this->assertSame('.live.throttle.599ms', $temp->getSearchOptions());

    }

    public function test_can_get_search_term_with_trim(): void
    {
        $this->basicTable->setTrimSearchStringEnabled();
        $this->basicTable->setSearch('Anthony');
        $this->assertSame('Anthony', $this->basicTable->getSearch());
        $this->basicTable->setSearch('Bob    ');
        $this->assertSame('Bob', $this->basicTable->getSearch());
        $this->basicTable->setSearch('     Bill    ');
        $this->assertSame('Bill', $this->basicTable->getSearch());
    }

    public function test_can_get_search_term_without_trim(): void
    {
        $this->basicTable->setTrimSearchStringDisabled();
        $this->basicTable->setSearch('Ben    ');
        $this->assertSame('Ben    ', $this->basicTable->getSearch());
        $this->basicTable->setSearch('     Baz    ');
        $this->assertSame('     Baz    ', $this->basicTable->getSearch());
    }
}
