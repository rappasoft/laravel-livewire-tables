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

    public function test_search_via_query_string_functions(): void
    {
        Livewire::withQueryParams(['table-search' => 'Cartman'])
        ->test(PetsTable::class)
        ->assertSee('Cartman')
        ->assertDontSee('Chico');

        Livewire::withQueryParams(['table-search' => 'Chico'])
        ->test(PetsTable::class)
        ->assertSee('Chico')
        ->assertDontSee('Cartman');

        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setPrimaryKey('id');
                $this->setDataTableFingerprint('test');
                $this->setQueryStringAliasForSearch('pet-search');
            }
        };

        Livewire::withQueryParams(['table-search' => 'Chico'])
        ->test($mock)
        ->assertSee('Chico')
        ->assertSee('Cartman');

        Livewire::withQueryParams(['pet-search' => 'Chico'])
        ->test($mock)
        ->assertSee('Chico')
        ->assertDontSee('Cartman');

    }
}
