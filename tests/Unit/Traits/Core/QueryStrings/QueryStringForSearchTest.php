<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Core\QueryStrings;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

#[Group('QueryString')]
final class QueryStringForSearchTest extends QueryStringTestBase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_get_default_search_query_string_status(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();

        $this->assertSame(true, parent::$mock->getQueryStringStatusForSearch());
    }

    public function test_can_disable_search_query_string_status(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();
        parent::$mock->setQueryStringForSearchDisabled();

        $this->assertSame(false, parent::$mock->getQueryStringStatusForSearch());
    }

    public function test_can_enable_search_query_string_status(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();
        parent::$mock->setQueryStringForSearchDisabled();
        $this->assertSame(false, parent::$mock->getQueryStringStatusForSearch());
        parent::$mock->setQueryStringForSearchEnabled();
        $this->assertSame(true, parent::$mock->getQueryStringStatusForSearch());

    }

    public function test_can_get_default_search_query_string_alias(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();

        $this->assertSame('table-search', parent::$mock->getQueryStringAliasForSearch());
    }

    public function test_can_change_default_search_query_string_alias(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();

        $this->assertFalse(parent::$mock->hasQueryStringAliasForSearch());
        $this->assertSame('table-search', parent::$mock->getQueryStringAliasForSearch());
        parent::$mock->setQueryStringAliasForSearch('pet-search');
        $this->assertSame('pet-search', parent::$mock->getQueryStringAliasForSearch());
        $this->assertTrue(parent::$mock->hasQueryStringAliasForSearch());
    }
}
