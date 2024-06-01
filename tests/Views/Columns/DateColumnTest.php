<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;

final class DateColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = DateColumn::make('Last Visit', 'last_visit');

        $this->assertSame('Last Visit', $column->getTitle());
    }

    public function test_can_infer_field_name_from_title_if_no_from(): void
    {
        $column = DateColumn::make('My Title');

        $this->assertSame('my_title', $column->getField());
    }

    public function test_can_set_base_field_from_from(): void
    {
        $column = DateColumn::make('Name', 'last_visit');

        $this->assertSame('last_visit', $column->getField());
    }

    public function test_can_set_relation_field_from_from(): void
    {
        $column = DateColumn::make('Name', 'last_visit');

        $this->assertSame('last_visit', $column->getField());
    }

    public function test_can_get_column_formatted_contents(): void
    {
        $column = DateColumn::make('Name', 'last_visit')->inputFormat('Y-m-d')->outputFormat('Y-m-d');

        $rows = $this->basicTable->getRows();

        $this->assertSame($rows->last()->last_visit, $column->getContents($rows->last()));
        $this->assertSame($rows->last()->last_visit, '2023-05-04');
    }

    public function test_can_get_column_reformatted_contents(): void
    {
        $column = DateColumn::make('Name', 'last_visit')->inputFormat('Y-m-d')->outputFormat('d-m-Y');

        $rows = $this->basicTable->getRows();

        $this->assertSame('04-05-2023', $column->getContents($rows->last()));
    }

    public function test_can_not_get_column_reformatted_contents_with_bad_values(): void
    {
        $column = DateColumn::make('Name', 'last_visit')->inputFormat('d-m-Y')->outputFormat('d-m-Y');

        $firstRow = $this->basicTable->getRows()->first();

        $firstRow->last_visit = '44-12-2023';

        $this->assertSame('', $column->getContents($firstRow));

        $firstRow->last_visit = '04-01-2023';

        $this->assertSame('04-01-2023', $column->getContents($firstRow));

        $this->assertSame('04-01-2023', $column->emptyValue('Unknown')->getContents($firstRow));

        $firstRow->last_visit = '44-12-2023';

        $this->assertSame('Unknown', $column->emptyValue('Unknown')->getContents($firstRow));

    }

    public function test_can_set_column_empty_value(): void
    {
        $column = DateColumn::make('Name', 'last_visit')->inputFormat('d-m-Y')->outputFormat('d-m-Y');
        $this->assertSame('', $column->getEmptyValue());

        $column->emptyValue('Not Found');
        $this->assertSame('Not Found', $column->getEmptyValue());

        $thirdRow = $this->basicTable->getRows()->slice(3, 1)->first();

        $this->assertSame('Not Found', $column->getContents($thirdRow));

        $column->emptyValue('');
        $this->assertSame('', $column->getContents($thirdRow));

    }
}
