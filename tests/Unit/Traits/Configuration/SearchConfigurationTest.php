<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
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

        $this->basicTable->setSearchDefer();
        $this->basicTable->setSearchDebounce(1000);
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

        $this->basicTable->setSearchDebounce(1000);
        $this->basicTable->setSearchDefer();
    }

    public function test_can_set_search_lazy(): void
    {
        $this->assertFalse($this->basicTable->hasSearchLazy());

        $this->basicTable->setSearchLazy();

        $this->assertTrue($this->basicTable->hasSearchLazy());
        $this->assertSame('.live.lazy', $this->basicTable->getSearchOptions());
    }

    public function test_cant_set_search_lazy_with_other_search_modifiers(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $this->basicTable->setSearchDebounce(1000);
        $this->basicTable->setSearchLazy();
    }

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

        $this->basicTable->setSearchDebounce(1000);
        $this->basicTable->setSearchLive();
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

        $this->basicTable->setSearchDefer();
        $this->basicTable->setSearchBlur();
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

        $this->basicTable->setSearchDefer();
        $this->basicTable->setSearchThrottle(1000);
    }

    public function test_can_set_search_placeholder(): void
    {
        $this->assertSame(__($this->basicTable->getLocalisationPath().'Search'), $this->basicTable->getSearchPlaceholder());

        $this->basicTable->setSearchPlaceholder('Anthony');

        $this->assertSame('Anthony', $this->basicTable->getSearchPlaceholder());

    }

    public function test_can_set_search_field_attributes(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
            }

            public function pubSetSearchFieldAttributes(array $attributes)
            {
                $this->setSearchFieldAttributes($attributes);
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame(['default' => true, 'default-colors' => true, 'default-styling' => true], $mock->getSearchFieldAttributes());

        $mock->pubSetSearchFieldAttributes(['class' => 'bg-blue', 'style' => 'font-size: 3em;']);

        $this->assertSame(['class' => 'bg-blue', 'default' => false, 'default-colors' => false, 'default-styling' => false, 'style' => 'font-size: 3em;'], $mock->getSearchFieldAttributes());

    }

    public function test_can_set_search_icon(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
            }

            public function pubSetSearchFieldAttributes(array $attributes)
            {
                $this->setSearchFieldAttributes($attributes);
            }

            public function pubSetSearchIcon(string $searchIcon)
            {
                $this->setSearchIcon($searchIcon);
            }

            public function pubSetSearchIconAttributes(array $attributes)
            {
                $this->setSearchIconAttributes($attributes);
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertFalse($mock->hasSearchIcon());
        $mock->pubSetSearchIcon('heroicon-m-magnifying-glass-2');
        $this->assertTrue($mock->hasSearchIcon());

        $this->assertSame($mock->getSearchIcon(), 'heroicon-m-magnifying-glass-2');

    }

    public function test_can_set_search_icon_status(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
            }

            public function pubSetSearchFieldAttributes(array $attributes)
            {
                $this->setSearchFieldAttributes($attributes);
            }

            public function pubSetSearchIconEnabled()
            {
                $this->searchIconEnabled();
            }

            public function pubSetSearchIconDisabled()
            {
                $this->searchIconDisabled();
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertFalse($mock->hasSearchIcon());
        $mock->pubSetSearchIconEnabled();

        $this->assertTrue($mock->hasSearchIcon());
        $mock->pubSetSearchIconDisabled();
        $this->assertFalse($mock->hasSearchIcon());

    }

    public function test_can_set_search_icon_attributes(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');

            }

            public function pubSetSearchFieldAttributes(array $attributes)
            {
                $this->setSearchFieldAttributes($attributes);
            }

            public function pubSetSearchIcon(string $searchIcon)
            {
                $this->setSearchIcon($searchIcon);
            }

            public function pubSetSearchIconAttributes(array $attributes)
            {
                $this->setSearchIconAttributes($attributes);
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame('h-4 w-4', $mock->getSearchIconClasses());
        $this->assertSame([
            'style' => 'color: #000000',
        ], $mock->getSearchIconOtherAttributes());

        $mock->pubSetSearchIconAttributes([
            'style' => 'color: #FF0000',
            'class' => 'h-6 w-6',
        ]);

        $this->assertSame('h-6 w-6', $mock->getSearchIconClasses());
        $this->assertSame([
            'style' => 'color: #FF0000',
        ], $mock->getSearchIconOtherAttributes());

        $this->assertSame([
            'class' => 'h-6 w-6',
            'style' => 'color: #FF0000',
        ], $mock->getSearchIconAttributes());

    }
}
