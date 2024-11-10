<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Core\QueryStrings;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class QueryStringForSortTest extends TestCase
{
    public function test_can_get_default_sort_query_string_status(): void
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

        $this->assertSame(true, $mock->getQueryStringStatusForSort());
    }

    public function test_can_disable_sort_query_string_status(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
                $this->setQueryStringForSortDisabled();
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame(false, $mock->getQueryStringStatusForSort());
    }

    public function test_can_enable_sort_query_string_status(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
                $this->setQueryStringForSortDisabled();
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame(false, $mock->getQueryStringStatusForSort());
        $mock->setQueryStringForSortEnabled();
        $this->assertSame(true, $mock->getQueryStringStatusForSort());

    }

    public function test_can_get_default_sort_query_string_alias(): void
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

        $this->assertSame('table-sorts', $mock->getQueryStringAliasForSort());

    }

    public function test_can_change_default_sort_query_string_alias(): void
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

        $this->assertSame('table-sorts', $mock->getQueryStringAliasForSort());
        $mock->setQueryStringAliasForSort('pet-sorts');
        $this->assertSame('pet-sorts', $mock->getQueryStringAliasForSort());
        $this->assertTrue($mock->hasQueryStringAliasForSort());
    }
}
