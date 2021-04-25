<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsAltQueryTable;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

class DataTableComponentTest extends TestCase
{
    protected DataTableComponent $table;
    protected DataTableComponent $tableAltQuery;

    public function setUp(): void
    {
        parent::setUp();

        $this->table = new PetsTable();
        $this->tableAltQuery = new PetsAltQueryTable();
    }

    /** @test */
    public function bootstrap_test_datatable(): void
    {
        $this->assertInstanceOf(DataTableComponent::class, $this->table);
    }

    /** @test */
    public function columns(): void
    {
        $columns = $this->table->columns();

        $this->assertCount(5, $columns);
    }

    /** @test */
    public function rows(): void
    {
        $rows = $this->table->rows;

        $this->assertInstanceOf(LengthAwarePaginator::class, $rows);
        $this->assertEquals(5, $this->table->getRowsProperty()->total());
    }

    /** @test */
    public function pagination_default(): void
    {
        $this->assertInstanceOf(LengthAwarePaginator::class, $this->table->rows);
        $this->assertEquals(10, $this->table->perPage);
        $this->assertTrue($this->table->paginationEnabled);
        $this->assertTrue($this->table->showPerPage);
    }

    /** @test */
    public function pagination(): void
    {
        $this->table->perPage = 2;
        $this->assertEquals(1, $this->table->rows->currentPage());
        $this->assertEquals(2, $this->table->rows->count());
        $this->assertEquals(3, $this->table->rows->lastPage());
    }

    /** @test */
    public function pagination_disabled(): void
    {
        $this->table->paginationEnabled = false;
        $this->table->perPage = 2;
        $this->assertInstanceOf(Collection::class, $this->table->rows);
        $this->assertCount(5, $this->table->rows);
    }

    /** @test */
    public function search_filter(): void
    {
        $this->table->filters['search'] = 'Cartman';
        $this->assertEquals(1, $this->table->getRowsProperty()->total());
    }

    /** @test */
    public function search_filter_reset(): void
    {
        $this->table->filters['search'] = 'Cartman';
        $this->table->resetFilters();
        $this->assertEquals(1, $this->table->rows->total());
    }

    /** @test */
    public function search_filter_remove(): void
    {
        $this->table->filters['search'] = 'Cartman';
        $this->table->removeFilter('search');
        $this->assertEquals(5, $this->table->rows->total());
    }

    /** @test */
    public function search_filter_callback(): void
    {
        $this->table->filters['search'] = '2';
        $this->assertEquals(1, $this->table->getRowsProperty()->total());
    }

    /** @test */
    public function search_filter_alt_query()
    {
        $this->tableAltQuery->filters['search'] = 'Cartman';
        $this->assertEquals(1, $this->tableAltQuery->rows->total());
    }

    /** @test */
    public function search_filter_alt_query_relation()
    {
        $this->tableAltQuery->filters['search'] = 'Cat';
        $this->assertEquals(2, $this->tableAltQuery->rows->total());
    }
}
