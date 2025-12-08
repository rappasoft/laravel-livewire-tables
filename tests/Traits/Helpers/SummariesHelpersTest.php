<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;

final class SummariesHelpersTest extends TestCase
{
    public function test_summaries_setup_detects_columns_with_summaries(): void
    {
        // Add a column with summary
        $this->basicTable->getColumns()->push(
            Column::make('Price', 'price')->summary('sum')
        );

        $this->basicTable->setupSummaries();

        $this->assertTrue($this->basicTable->hasSummaries());
        $this->assertTrue($this->basicTable->summariesAreEnabled());
        $this->assertCount(1, $this->basicTable->getSummaryColumns());
    }

    public function test_summaries_setup_enables_summaries_when_column_has_summary(): void
    {
        $this->assertFalse($this->basicTable->getSummariesStatus());

        $this->basicTable->getColumns()->push(
            Column::make('Price', 'price')->summary('sum')
        );

        $this->basicTable->setupSummaries();

        $this->assertTrue($this->basicTable->getSummariesStatus());
    }

    public function test_can_calculate_summary_for_column(): void
    {
        // Get rows first before adding column and convert to Collection
        $rows = collect($this->basicTable->getRows()->all());
        
        $column = Column::make('Age', 'age')->summary('sum');
        $this->basicTable->getColumns()->push($column);

        $summary = $this->basicTable->calculateSummary($column, $rows);

        $this->assertNotNull($summary);
        $this->assertIsNumeric($summary);
    }

    public function test_can_calculate_average_summary(): void
    {
        // Get rows first before adding column and convert to Collection
        $rows = collect($this->basicTable->getRows()->all());
        
        $column = Column::make('Age', 'age')->summary('avg');
        $this->basicTable->getColumns()->push($column);

        $summary = $this->basicTable->calculateSummary($column, $rows);

        $this->assertNotNull($summary);
        $this->assertIsNumeric($summary);
    }

    public function test_can_calculate_count_summary(): void
    {
        // Get rows first before adding column and convert to Collection
        $rows = collect($this->basicTable->getRows()->all());
        
        $column = Column::make('Name', 'name')->summary('count');
        $this->basicTable->getColumns()->push($column);

        $summary = $this->basicTable->calculateSummary($column, $rows);

        $this->assertNotNull($summary);
        $this->assertGreaterThan(0, $summary);
    }

    public function test_can_calculate_min_summary(): void
    {
        // Get rows first before adding column and convert to Collection
        $rows = collect($this->basicTable->getRows()->all());
        
        $column = Column::make('Age', 'age')->summary('min');
        $this->basicTable->getColumns()->push($column);

        $summary = $this->basicTable->calculateSummary($column, $rows);

        $this->assertNotNull($summary);
        $this->assertIsNumeric($summary);
    }

    public function test_can_calculate_max_summary(): void
    {
        // Get rows first before adding column and convert to Collection
        $rows = collect($this->basicTable->getRows()->all());
        
        $column = Column::make('Age', 'age')->summary('max');
        $this->basicTable->getColumns()->push($column);

        $summary = $this->basicTable->calculateSummary($column, $rows);

        $this->assertNotNull($summary);
        $this->assertIsNumeric($summary);
    }

    public function test_returns_null_for_column_without_summary(): void
    {
        // Get rows first before adding column and convert to Collection
        $rows = collect($this->basicTable->getRows()->all());
        
        $column = Column::make('Name', 'name'); // No summary
        $this->basicTable->getColumns()->push($column);

        $summary = $this->basicTable->calculateSummary($column, $rows);

        $this->assertNull($summary);
    }
}


