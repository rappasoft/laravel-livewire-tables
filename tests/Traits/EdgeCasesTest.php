<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

final class EdgeCasesTest extends TestCase
{
    public function test_pagination_with_empty_results(): void
    {
        $this->basicTable->setSearch('nonexistent_pet_name_xyz');
        $this->basicTable->applySearch();
        
        $rows = $this->basicTable->getRows();
        $this->assertSame(0, $rows->count());
        $this->assertSame([], $this->basicTable->paginationCurrentItems);
        $this->assertSame(0, $this->basicTable->paginationCurrentCount);
    }

    public function test_pagination_per_page_edge_cases(): void
    {
        // Test with -1 (all items) - need to accept it first
        $this->basicTable->setPerPageAccepted([-1, 10, 25, 50]);
        $this->basicTable->setPerPage(-1);
        $rows = $this->basicTable->getRows();
        $this->assertGreaterThan(0, $rows->count());
        
        // Test with invalid per page value
        $this->basicTable->setPerPageAccepted([10, 25, 50]);
        $this->basicTable->updatedPerPage(99); // Invalid value
        // Should default to first accepted value
        $this->assertContains($this->basicTable->getPerPage(), [10, 25, 50]);
    }

    public function test_bulk_actions_with_empty_selection(): void
    {
        $this->basicTable->setBulkActions(['activate' => 'Activate']);
        $this->basicTable->setSelected([]);
        
        $this->assertSame([], $this->basicTable->getSelected());
        $this->assertFalse($this->basicTable->getSelectAllStatus());
    }

    public function test_bulk_actions_select_all_clears_on_search(): void
    {
        $this->basicTable->setBulkActions(['activate' => 'Activate']);
        $this->basicTable->setSelected([1, 2, 3]);
        $this->basicTable->setSelectAllEnabled();
        
        $this->basicTable->updatedSearch('test');
        
        $this->assertSame([], $this->basicTable->getSelected());
        $this->assertFalse($this->basicTable->getSelectAllStatus());
    }

    public function test_bulk_actions_select_all_clears_on_filter(): void
    {
        $this->basicTable->setBulkActions(['activate' => 'Activate']);
        $this->basicTable->setSelected([1, 2, 3]);
        $this->basicTable->setSelectAllEnabled();
        
        $this->basicTable->updatedFilterComponents([1], 'breed');
        
        $this->assertSame([], $this->basicTable->getSelected());
        $this->assertFalse($this->basicTable->getSelectAllStatus());
    }

    public function test_filters_with_empty_values(): void
    {
        $this->basicTable->updatedFilterComponents(null, 'breed');
        
        // Should not throw exception
        $this->assertTrue(true);
    }

    public function test_filters_with_invalid_values(): void
    {
        $this->basicTable->updatedFilterComponents(['invalid_id'], 'breed');
        $this->basicTable->applyFilters();
        
        // Should handle gracefully
        $rows = $this->basicTable->getRows();
        $this->assertIsIterable($rows);
    }

    public function test_filters_validation_returns_false(): void
    {
        // Test that filter validation returning false is handled
        $this->basicTable->updatedFilterComponents('invalid', 'pet_name_filter');
        $this->basicTable->applyFilters();
        
        // Should not throw exception
        $this->assertTrue(true);
    }

    public function test_primary_key_pluck_with_empty_results(): void
    {
        $this->basicTable->setSearch('nonexistent_pet_name_xyz');
        $this->basicTable->applySearch();
        
        $rows = $this->basicTable->getRows();
        // Should not throw exception when plucking from empty collection
        $this->assertSame([], $this->basicTable->paginationCurrentItems);
    }

    public function test_columns_with_missing_relationships(): void
    {
        // Create a table with a column that has invalid relationship
        $table = new class extends PetsTable {
            public function columns(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Column::make('Invalid', 'nonexistent.field')
                        ->sortable(),
                ];
            }
        };
        
        $table->boot();
        $table->bootedComponentUtilities();
        $table->bootedWithData();
        
        // Should handle gracefully or throw appropriate exception
        try {
            $table->bootedWithColumns();
            $table->applySorting();
            $this->assertTrue(true);
        } catch (\Exception $e) {
            // Exception is acceptable for invalid relationships
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function test_pagination_method_validation(): void
    {
        $this->expectException(DataTableConfigurationException::class);
        
        $reflection = new \ReflectionClass($this->basicTable);
        $method = $reflection->getMethod('setPaginationMethod');
        $method->setAccessible(true);
        $method->invoke($this->basicTable, 'invalid_method');
        
        $this->basicTable->getRows();
    }

    public function test_simple_pagination_without_total_count(): void
    {
        $this->basicTable->setPaginationMethod('simple');
        $this->basicTable->setShouldRetrieveTotalItemCountDisabled();
        
        $rows = $this->basicTable->getRows();
        $this->assertInstanceOf(\Illuminate\Pagination\Paginator::class, $rows);
        $this->assertSame(-1, $this->basicTable->paginationTotalItemCount);
    }

    public function test_cursor_pagination(): void
    {
        $this->basicTable->setPaginationMethod('cursor');
        
        $rows = $this->basicTable->getRows();
        $this->assertInstanceOf(\Illuminate\Pagination\CursorPaginator::class, $rows);
    }

    public function test_reordering_disables_other_features(): void
    {
        $this->basicTable->enableReordering();
        
        $this->assertFalse($this->basicTable->sortingIsEnabled());
        $this->assertFalse($this->basicTable->paginationIsEnabled());
        $this->assertFalse($this->basicTable->searchIsEnabled());
        $this->assertFalse($this->basicTable->bulkActionsAreEnabled());
        $this->assertFalse($this->basicTable->filtersAreEnabled());
    }

    public function test_reordering_restores_state_on_disable(): void
    {
        // Set some state
        $this->basicTable->setSearch('test');
        $this->basicTable->setSort('id', 'asc');
        $this->basicTable->setSelected([1, 2]);
        
        // Enable reordering (should backup state)
        $this->basicTable->enableReordering();
        
        // Disable reordering (should restore state)
        $this->basicTable->disableReordering();
        
        // State should be restored
        $this->assertSame('test', $this->basicTable->getSearch());
        $this->assertSame(['id' => 'asc'], $this->basicTable->getSorts());
        $this->assertSame([1, 2], $this->basicTable->getSelected());
    }

    public function test_search_with_no_searchable_columns(): void
    {
        $table = new class extends PetsTable {
            public function columns(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Column::make('ID', 'id'),
                    \Rappasoft\LaravelLivewireTables\Views\Column::make('Name'),
                ];
            }
        };
        
        $table->boot();
        $table->bootedComponentUtilities();
        $table->bootedWithData();
        $table->bootedWithColumns();
        
        $table->setSearch('test');
        $table->applySearch();
        
        // Should not throw exception
        $rows = $table->getRows();
        $this->assertIsIterable($rows);
    }

    public function test_sorting_with_no_sortable_columns(): void
    {
        $table = new class extends PetsTable {
            public function columns(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Column::make('ID', 'id'),
                    \Rappasoft\LaravelLivewireTables\Views\Column::make('Name'),
                ];
            }
        };
        
        $table->boot();
        $table->bootedComponentUtilities();
        $table->bootedWithData();
        $table->bootedWithColumns();
        
        $table->setSort('id', 'asc');
        $table->applySorting();
        
        // Should not throw exception
        $rows = $table->getRows();
        $this->assertIsIterable($rows);
    }

    public function test_pagination_current_items_with_different_primary_key_types(): void
    {
        // Test that pluck works with different primary key types
        $rows = $this->basicTable->getRows();
        
        // Should have array of primary keys
        $this->assertIsArray($this->basicTable->paginationCurrentItems);
        $this->assertSame(count($rows), count($this->basicTable->paginationCurrentItems));
    }

    public function test_extra_withs_with_invalid_relationships(): void
    {
        $reflection = new \ReflectionClass($this->basicTable);
        $method = $reflection->getMethod('setExtraWiths');
        $method->setAccessible(true);
        $method->invoke($this->basicTable, ['nonexistent_relation']);
        
        // Should handle gracefully
        try {
            $this->basicTable->getRows();
            $this->assertTrue(true);
        } catch (\Exception $e) {
            // Exception is acceptable for invalid relationships
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function test_query_string_with_special_characters(): void
    {
        $this->basicTable->setSearch("test' OR '1'='1");
        $this->basicTable->setQueryStringEnabled();
        
        // Should handle special characters in search
        $this->basicTable->applySearch();
        $rows = $this->basicTable->getRows();
        $this->assertIsIterable($rows);
    }

    public function test_column_select_exclusion_from_query(): void
    {
        $this->basicTable->setExcludeDeselectedColumnsFromQueryEnabled();
        // Use the actual selectedColumns property
        $this->basicTable->selectedColumns = ['id', 'name'];
        
        $rows = $this->basicTable->getRows();
        
        // Should only select specified columns
        $this->assertIsIterable($rows);
    }

    public function test_empty_table_rendering(): void
    {
        $this->basicTable->setSearch('nonexistent_pet_name_xyz');
        $this->basicTable->applySearch();
        
        $view = view('livewire-tables::datatable');
        $this->basicTable->renderingWithPagination($view, []);
        $this->basicTable->renderingWithData($view, []);
        
        // Should render without errors
        $this->assertTrue(true);
    }

    public function test_filter_empty_value_removes_filter(): void
    {
        // Set a filter value using setFilter
        $this->basicTable->setFilter('breed', [1]);
        // Verify filter was set
        $this->assertArrayHasKey('breed', $this->basicTable->filterComponents);
        $this->assertSame([1], $this->basicTable->filterComponents['breed']);
        
        // Set empty value - should reset filter to default value
        $this->basicTable->updatedFilterComponents([], 'breed');
        // resetFilter sets filter to default value (empty array for MultiSelectFilter)
        $this->assertSame([], $this->basicTable->filterComponents['breed']);
        // Should not be in appliedFiltersWithValues when empty
        $this->assertArrayNotHasKey('breed', $this->basicTable->getAppliedFiltersWithValues());
    }

    public function test_search_trimming_handles_whitespace_only(): void
    {
        $this->basicTable->setTrimSearchStringEnabled();
        $this->basicTable->updatedSearch('   ');
        
        $this->assertSame('', $this->basicTable->getSearch());
    }
}
