<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;

class DateColumnTest extends TestCase
{
    /** @test */
    public function can_set_the_column_title(): void
    {
        $column = DateColumn::make('Last Visit', 'last_visit');

        $this->assertSame('Last Visit', $column->getTitle());
    }

    /** @test */
    public function can_infer_field_name_from_title_if_no_from(): void
    {
        $column = DateColumn::make('My Title');

        $this->assertSame('my_title', $column->getField());
    }

    /** @test */
    public function can_set_base_field_from_from(): void
    {
        $column = DateColumn::make('Name', 'last_visit');

        $this->assertSame('last_visit', $column->getField());
    }

    /** @test */
    public function can_set_relation_field_from_from(): void
    {
        $column = DateColumn::make('Name', 'last_visit');

        $this->assertSame('last_visit', $column->getField());
    }

    /** @test */
    public function can_get_column_formatted_contents(): void
    {
        $column = DateColumn::make('Name', 'last_visit')->inputFormat('Y-m-d')->outputFormat('Y-m-d');

        $rows = $this->basicTable->getRows();

        $this->assertSame($rows->first()->last_visit, $column->getContents($rows->first()));
        $this->assertSame($rows->first()->last_visit, '2023-01-04');
    }

    /** @test */
    public function can_get_column_reformatted_contents(): void
    {
        $column = DateColumn::make('Name', 'last_visit')->inputFormat('Y-m-d')->outputFormat('d-m-Y');

        $rows = $this->basicTable->getRows();

        $this->assertSame('04-01-2023', $column->getContents($rows->first()));
    }
}
