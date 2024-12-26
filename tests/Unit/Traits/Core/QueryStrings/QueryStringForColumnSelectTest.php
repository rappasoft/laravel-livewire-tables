<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Core\QueryStrings;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

#[Group('QueryString')]
final class QueryStringForColumnSelectTest extends QueryStringTestBase
{
    public function test_can_get_default_column_select_query_string_status(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();

        $this->assertSame(false, parent::$mock->getQueryStringStatusForColumnSelect());

        parent::$mock->setQueryStringForColumnSelectEnabled();
        $this->assertSame(true, parent::$mock->getQueryStringStatusForColumnSelect());

    }

    public function test_can_disable_column_select_query_string_status(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();
        $this->assertSame(false, parent::$mock->getQueryStringStatusForColumnSelect());
        parent::$mock->setQueryStringForColumnSelectDisabled();
        $this->assertSame(false, parent::$mock->getQueryStringStatusForColumnSelect());
    }

    public function test_can_enable_column_select_query_string_status(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();

        $this->assertSame(false, parent::$mock->getQueryStringStatusForColumnSelect());
        parent::$mock->setQueryStringForColumnSelectEnabled();
        $this->assertSame(true, parent::$mock->getQueryStringStatusForColumnSelect());
        parent::$mock->setQueryStringForColumnSelectDisabled();
        $this->assertSame(false, parent::$mock->getQueryStringStatusForColumnSelect());

    }

    public function test_can_get_default_column_select_query_string_alias(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();

        $this->assertSame('table-columns', parent::$mock->getQueryStringAliasForColumnSelect());

    }

    public function test_can_change_default_column_select_query_string_alias(): void
    {
        parent::$mock->configure();
        parent::$mock->boot();

        $this->assertSame('table-columns', parent::$mock->getQueryStringAliasForColumnSelect());
        $this->assertFalse(parent::$mock->hasQueryStringAliasForColumnSelect());
        parent::$mock->setQueryStringAliasForColumnSelect('selected-columns');
        $this->assertSame('selected-columns', parent::$mock->getQueryStringAliasForColumnSelect());
        $this->assertTrue(parent::$mock->hasQueryStringAliasForColumnSelect());
    }
}
