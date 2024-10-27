<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Core\QueryStrings;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class QueryStringForSearchTest extends TestCase
{
    public function test_can_get_default_search_query_string_status(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame(true, $mock->getQueryStringStatusForSearch());
    }

    public function test_can_disable_search_query_string_status(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
                $this->setQueryStringForSearchDisabled();
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame(false, $mock->getQueryStringStatusForSearch());
    }

    public function test_can_enable_search_query_string_status(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
                $this->setQueryStringForSearchDisabled();
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame(false, $mock->getQueryStringStatusForSearch());
        $mock->setQueryStringForSearchEnabled();
        $this->assertSame(true, $mock->getQueryStringStatusForSearch());

    }

    public function test_can_get_default_search_query_string_alias(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame('table-search', $mock->getQueryStringAliasForSearch());

    }

    public function test_can_change_default_search_query_string_alias(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame('table-search', $mock->getQueryStringAliasForSearch());
        $mock->setQueryStringAliasForSearch('pet-search');
        $this->assertSame('pet-search', $mock->getQueryStringAliasForSearch());
        $this->assertTrue($mock->hasQueryStringAliasForSearch());
    }
}
