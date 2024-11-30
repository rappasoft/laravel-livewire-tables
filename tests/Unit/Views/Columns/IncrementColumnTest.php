<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

final class IncrementColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = IncrementColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    public function test_can_not_infer_field_name_from_title_if_no_from(): void
    {
        $column = IncrementColumn::make('My Title');

        $this->assertNull($column->getField());
    }

    public function test_can_not_render_field_if_no_title(): void
    {
        $this->expectException(\ArgumentCountError::class);

        IncrementColumn::make()->getContents(Pet::find(1));
    }

    public function test_handles_row_index_correctly(): void
    {
        $rows = $this->basicTable->getRows();
        $row1 = $rows->first();
        $col = IncrementColumn::make('#')->setRowIndex(1);
        $contents = $col->getContents($row1);
        $this->assertSame(1, $col->getRowIndex());

    }

    public function test_handles_col_index_correctly(): void
    {
        $rows = $this->basicTable->getRows();
        $row1 = $rows->first();
        $col = IncrementColumn::make('#')->setColumnIndex(2);
        $contents = $col->getContents($row1);
        $this->assertSame(2, $col->getColumnIndex());

    }

    public function test_handles_indexes_correctly(): void
    {
        $rows = $this->basicTable->getRows();
        $row1 = $rows->first();
        $col = IncrementColumn::make('#')->setIndexes(5, 3);
        $contents = $col->getContents($row1);
        $this->assertSame(5, $col->getRowIndex());
        $this->assertSame(3, $col->getColumnIndex());

    }

    public function test_renders_correctly(): void
    {
        $rows = $this->basicTable->getRows();
        $row1 = $rows->first();
        $col = IncrementColumn::make('#')->setRowIndex(1);
        $contents = $col->getContents($row1);
        $this->assertSame(1, $col->getRowIndex());

    }
}
