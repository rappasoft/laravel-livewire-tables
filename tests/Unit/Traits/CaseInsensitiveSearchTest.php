<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits;

use Illuminate\Support\Facades\Config;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

final class CaseInsensitiveSearchTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Never connected to - getDriverName() only reads the config
        Config::set('database.connections.pgsql', ['driver' => 'pgsql', 'database' => 'testing']);
    }

    public function test_search_uses_ilike_on_postgres_only(): void
    {
        $this->assertStringContainsString(' like ', $this->searchSql('sqlite'));
        $this->assertStringContainsString(' ilike ', $this->searchSql('pgsql'));
    }

    public function test_wildcard_filters_use_ilike_on_postgres_only(): void
    {
        foreach (['contains', 'notContains', 'startsWith', 'notStartsWith', 'endsWith', 'notEndsWith'] as $method) {
            $this->assertStringContainsString(' like ', $this->filterSql($method, 'sqlite'), $method);
            $this->assertStringContainsString(' ilike ', $this->filterSql($method, 'pgsql'), $method);
        }
    }

    private function searchSql(string $connection): string
    {
        $this->basicTable->setBuilder(Pet::on($connection)->newQuery());
        $this->basicTable->setSearch('cartman');

        return $this->basicTable->applySearch()->toSql();
    }

    private function filterSql(string $method, string $connection): string
    {
        $builder = Pet::on($connection)->newQuery();

        $filter = TextFilter::make('Name', 'name')->{$method}('name');
        $filter->getFilterCallback()($builder, 'cartman');

        return $builder->toSql();
    }
}
