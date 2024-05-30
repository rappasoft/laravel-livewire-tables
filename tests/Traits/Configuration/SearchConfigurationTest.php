<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class SearchConfigurationTest extends TestCase
{
    public function test_can_set_default_search_term(): void
    {
        $this->assertSame('', $this->basicTable->getSearch());

        $this->basicTable->setSearch('Anthony');

        $this->assertSame('Anthony', $this->basicTable->getSearch());
    }

    public function test_can_set_search_status_status(): void
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

    public function test_can_set_search_visibility_status_status(): void
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

    public function test_can_set_search_debounce(): void
    {
        $this->assertFalse($this->basicTable->hasSearchDebounce());

        $this->basicTable->setSearchDebounce(1000);

        $this->assertTrue($this->basicTable->hasSearchDebounce());
        $this->assertSame(1000, $this->basicTable->getSearchDebounce());
        $this->assertSame('.live.debounce.1000ms', $this->basicTable->getSearchOptions());
    }

    public function test_cant_set_search_debounce_with_other_search_modifiers(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $this->basicTable->setSearchDebounce(1000);
        $this->basicTable->setSearchDefer();
    }

    public function test_can_set_search_defer(): void
    {
        $this->assertFalse($this->basicTable->hasSearchDefer());

        $this->basicTable->setSearchDefer();

        $this->assertTrue($this->basicTable->hasSearchDefer());
        $this->assertSame('', $this->basicTable->getSearchOptions());
    }

    public function test_cant_set_search_defer_with_other_search_modifiers(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $this->basicTable->setSearchDefer();
        $this->basicTable->setSearchDebounce(1000);
    }

    /*public function test_can_set_search_lazy(): void
    {
        $this->assertFalse($this->basicTable->hasSearchLazy());

        $this->basicTable->setSearchLazy();

        $this->assertTrue($this->basicTable->hasSearchLazy());
        $this->assertSame('.lazy', $this->basicTable->getSearchOptions());
    }*/

    /*public function test_cant_set_search_lazy_with_other_search_modifiers(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $this->basicTable->setSearchLazy();
        $this->basicTable->setSearchDebounce(1000);
    }*/

    public function test_can_set_search_live(): void
    {
        $this->assertFalse($this->basicTable->hasSearchLive());

        $this->basicTable->setSearchLive();

        $this->assertTrue($this->basicTable->hasSearchLive());
        $this->assertSame('.live', $this->basicTable->getSearchOptions());
    }

    public function test_cant_set_search_live_with_other_search_modifiers(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $this->basicTable->setSearchLive();
        $this->basicTable->setSearchDebounce(1000);
    }

    public function test_can_set_search_blur(): void
    {
        $this->assertFalse($this->basicTable->hasSearchBlur());

        $this->basicTable->setSearchBlur();

        $this->assertTrue($this->basicTable->hasSearchBlur());
        $this->assertSame('.blur', $this->basicTable->getSearchOptions());
    }

    public function test_cant_set_search_blur_with_other_search_modifiers(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $this->basicTable->setSearchBlur();
        $this->basicTable->setSearchDefer();
    }

    public function test_can_set_search_throttle(): void
    {
        $this->assertFalse($this->basicTable->hasSearchThrottle());

        $this->basicTable->setSearchThrottle(1000);

        $this->assertTrue($this->basicTable->hasSearchThrottle());
        $this->assertSame(1000, $this->basicTable->getSearchThrottle());
        $this->assertSame('.live.throttle.1000ms', $this->basicTable->getSearchOptions());
    }

    public function test_cant_set_search_throttle_with_other_search_modifiers(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $this->basicTable->setSearchThrottle(1000);
        $this->basicTable->setSearchDefer();
    }

    public function test_can_set_search_placeholder(): void
    {
        $this->assertSame(__('Search'), $this->basicTable->getSearchPlaceholder());

        $this->basicTable->setSearchPlaceholder('Anthony');

        $this->assertSame('Anthony', $this->basicTable->getSearchPlaceholder());

    }

    public function test_can_set_search_field_attributes(): void
    {
        $this->assertSame(['default' => true], $this->basicTable->getSearchFieldAttributes());

        $this->basicTable->setSearchFieldAttributes(['class' => 'bg-blue', 'style' => 'font-size: 3em;']);

        $this->assertSame(['class' => 'bg-blue', 'style' => 'font-size: 3em;'], $this->basicTable->getSearchFieldAttributes());

    }
}
