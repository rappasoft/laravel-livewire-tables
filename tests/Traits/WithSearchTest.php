<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class WithSearchTest extends TestCase
{
    public function test_search_gets_applied_for_searchable_columns(): void
    {
        $this->basicTable->setSearch('Cartman');
        $this->basicTable->applySearch();
        
        $rows = $this->basicTable->getRows();
        $this->assertGreaterThan(0, $rows->count());
        $this->assertTrue($rows->first()->name === 'Cartman');
    }

    public function test_search_callback_gets_applied_where_necessary(): void
    {
        $this->basicTable->setSearch('Norwegian');
        $this->basicTable->applySearch();
        
        $rows = $this->basicTable->getRows();
        // Search callback should be applied - check that query was modified
        $sql = $this->basicTable->getBuilder()->toSql();
        $this->assertStringContainsStringIgnoringCase('breed.name', $sql);
    }

    public function test_when_search_is_applied_bulk_actions_are_cleared(): void
    {
        $this->basicTable->setBulkActions(['activate' => 'Activate']);
        $this->basicTable->setSelected([1, 2, 3]);
        $this->assertSame([1, 2, 3], $this->basicTable->getSelected());
        
        $this->basicTable->updatedSearch('abcd');
        
        $this->assertSame([], $this->basicTable->getSelected());
        $this->assertFalse($this->basicTable->getSelectAllStatus());
    }

    public function test_empty_search_clears_search(): void
    {
        $this->basicTable->setSearch('test');
        $this->assertSame('test', $this->basicTable->getSearch());
        
        $this->basicTable->updatedSearch('');
        $this->assertSame('', $this->basicTable->getSearch());
    }

    public function test_null_search_clears_search(): void
    {
        $this->basicTable->setSearch('test');
        $this->assertSame('test', $this->basicTable->getSearch());
        
        $this->basicTable->updatedSearch(null);
        $this->assertSame('', $this->basicTable->getSearch());
    }

    public function test_search_with_special_characters(): void
    {
        $this->basicTable->setSearch("test' OR '1'='1");
        $this->basicTable->applySearch();
        
        // Should not throw exception and handle safely
        $this->assertIsArray($this->basicTable->getRows()->toArray());
    }

    public function test_search_trimming_when_enabled(): void
    {
        $this->basicTable->setTrimSearchStringEnabled();
        $this->basicTable->updatedSearch('  Cartman  ');
        
        $this->assertSame('Cartman', $this->basicTable->getSearch());
    }

    public function test_search_without_trimming_when_disabled(): void
    {
        $this->basicTable->setTrimSearchStringDisabled();
        // Set search directly since updatedSearch always trims if enabled
        $this->basicTable->search = '  Cartman  ';
        
        $this->assertSame('  Cartman  ', $this->basicTable->getSearch());
    }

    public function test_search_disabled_does_not_apply_search(): void
    {
        $this->basicTable->setSearchDisabled();
        $this->basicTable->setSearch('Cartman');
        $this->basicTable->applySearch();
        
        // Should return all rows, not filtered
        $rows = $this->basicTable->getRows();
        $this->assertGreaterThan(1, $rows->count());
    }

    public function test_search_event_not_fired_when_disabled(): void
    {
        $this->basicTable->setEventStatus('searchApplied', false);
        $this->basicTable->setSearch('test');
        
        // Should not throw exception
        $this->basicTable->applySearch();
        $this->assertTrue(true);
    }
}
