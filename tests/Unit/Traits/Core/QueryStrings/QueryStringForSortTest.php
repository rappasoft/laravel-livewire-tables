<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Core\QueryStrings;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

#[Group('QueryString')]
final class QueryStringForSortTest extends QueryStringTestBase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_get_default_sort_query_string_status(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();

        $this->assertSame(true, parent::$mock->getQueryStringStatusForSort());
    }

    public function test_can_disable_sort_query_string_status(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();
        parent::$mock->setQueryStringForSortDisabled();

        $this->assertSame(false, parent::$mock->getQueryStringStatusForSort());
    }

    public function test_can_enable_sort_query_string_status(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();
        parent::$mock->setQueryStringForSortDisabled();

        $this->assertSame(false, parent::$mock->getQueryStringStatusForSort());
        parent::$mock->setQueryStringForSortEnabled();
        $this->assertSame(true, parent::$mock->getQueryStringStatusForSort());

    }

    public function test_can_get_default_sort_query_string_alias(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();
        parent::$mock->setQueryStringForSortDisabled();

        $this->assertSame('table-sorts', parent::$mock->getQueryStringAliasForSort());

    }

    public function test_can_change_default_sort_query_string_alias(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();
        parent::$mock->setQueryStringForSortDisabled();

        $this->assertSame('table-sorts', parent::$mock->getQueryStringAliasForSort());
        parent::$mock->setQueryStringAliasForSort('pet-sorts');
        $this->assertSame('pet-sorts', parent::$mock->getQueryStringAliasForSort());
        $this->assertTrue(parent::$mock->hasQueryStringAliasForSort());
    }
}
