<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class AggregateColumnQueryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        parent::setupSpeciesTable();
    }

    public function test_aggregates_are_applied_for_every_column_by_default(): void
    {
        $this->speciesTable->getRows();

        $this->assertSame(['pets'], $this->speciesTable->getExtraWithCounts());
        $this->assertSame([['table' => 'pets', 'field' => 'age']], $this->speciesTable->getExtraWithSums());
        $this->assertSame([['table' => 'pets', 'field' => 'age']], $this->speciesTable->getExtraWithAvgs());
    }

    public function test_deselected_aggregate_columns_are_dropped_from_the_query_when_excluded(): void
    {
        // withCount/withSum/withAvg each add a correlated subquery, so running them
        // for a column the user cannot see is the expensive half of the query
        $this->speciesTable->setExcludeDeselectedColumnsFromQueryEnabled();
        $this->speciesTable->selectedColumns = ['id', 'name', 'number-of-pets'];

        $this->speciesTable->getRows();

        $this->assertSame(['pets'], $this->speciesTable->getExtraWithCounts());
        $this->assertSame([], $this->speciesTable->getExtraWithSums());
        $this->assertSame([], $this->speciesTable->getExtraWithAvgs());
    }
}
