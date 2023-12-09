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

        $this->assertSame($rows->last()->last_visit, $column->getContents($rows->last()));
        $this->assertSame($rows->last()->last_visit, '2023-05-04');
    }

    /** @test */
    public function can_get_column_reformatted_contents(): void
    {
        $column = DateColumn::make('Name', 'last_visit')->inputFormat('Y-m-d')->outputFormat('d-m-Y');

        $rows = $this->basicTable->getRows();

        $this->assertSame('04-05-2023', $column->getContents($rows->last()));
    }

    /** @test */
    public function can_not_get_column_reformatted_contents_with_bad_values(): void
    {
        $column = DateColumn::make('Name', 'last_visit')->inputFormat('d-m-Y')->outputFormat('d-m-Y');

        $firstRow = $this->basicTable->getRows()->first();
        $firstRow->last_visit = '44-12-2023';
        $firstRow->save();

        $this->assertSame('', $column->getContents($firstRow));

        $firstRow->last_visit = '04-01-2023';
        $firstRow->save();

        $this->assertSame('04-01-2023', $column->getContents($firstRow));

    }

    /** @test */
    public function can_set_column_empty_value(): void
    {
        $column = DateColumn::make('Name', 'last_visit')->inputFormat('d-m-Y')->outputFormat('d-m-Y')->emptyValue('Not Found');

        $thirdRow = $this->basicTable->getRows()->slice(3, 1)->first();

        $this->assertSame('Not Found', $column->getContents($thirdRow));

        $column->emptyValue('');
        $this->assertSame('', $column->getContents($thirdRow));

    }
}
