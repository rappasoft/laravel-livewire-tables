<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Core\QueryStrings;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

#[Group('Filters')]
#[Group('QueryString')]
final class QueryStringForFiltersTest extends QueryStringTestBase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_get_default_filter_query_string_status(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();

        $this->assertSame(true, parent::$mock->getQueryStringStatusForFilter());
    }

    public function test_can_disable_filter_query_string_status(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();
        $this->assertSame(true, parent::$mock->getQueryStringStatusForFilter());
        parent::$mock->setQueryStringForFilterDisabled();
        $this->assertSame(false, parent::$mock->getQueryStringStatusForFilter());
    }

    public function test_can_enable_filter_query_string_status(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();

        $this->assertSame(true, parent::$mock->getQueryStringStatusForFilter());
        parent::$mock->setQueryStringForFilterDisabled();
        $this->assertSame(false, parent::$mock->getQueryStringStatusForFilter());
        parent::$mock->setQueryStringForFilterEnabled();
        $this->assertSame(true, parent::$mock->getQueryStringStatusForFilter());

    }

    public function test_can_get_default_filter_query_string_alias(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();

        $this->assertSame('table-filters', parent::$mock->getQueryStringAliasForFilter());

    }

    public function test_can_change_default_filter_query_string_alias(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();

        $this->assertSame('table-filters', parent::$mock->getQueryStringAliasForFilter());
        parent::$mock->setQueryStringAliasForFilter('pet-filters');
        $this->assertSame('pet-filters', parent::$mock->getQueryStringAliasForFilter());
        $this->assertTrue(parent::$mock->hasQueryStringAliasForFilter());
    }
}
