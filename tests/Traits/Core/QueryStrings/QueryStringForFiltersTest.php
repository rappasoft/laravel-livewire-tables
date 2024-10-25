<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Core\QueryStrings;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class QueryStringForFiltersTest extends TestCase
{
    public function test_can_get_default_filter_query_string_status(): void
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

        $this->assertSame(true, $mock->getQueryStringStatusForFilter());
    }

    public function test_can_disable_filter_query_string_status(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
                $this->setQueryStringForFilterDisabled();
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame(false, $mock->getQueryStringStatusForFilter());
    }

    public function test_can_enable_filter_query_string_status(): void
    {
        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
                $this->setQueryStringForFilterDisabled();
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame(false, $mock->getQueryStringStatusForFilter());
        $mock->setQueryStringForFilterEnabled();
        $this->assertSame(true, $mock->getQueryStringStatusForFilter());

    }

    public function test_can_get_default_filter_query_string_alias(): void
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

        $this->assertSame('table-filters', $mock->getQueryStringAliasForFilter());

    }

    public function test_can_change_default_filter_query_string_alias(): void
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

        $this->assertSame('table-filters', $mock->getQueryStringAliasForFilter());
        $mock->setQueryStringAliasForFilter('pet-filters');
        $this->assertSame('pet-filters', $mock->getQueryStringAliasForFilter());
    }
}
