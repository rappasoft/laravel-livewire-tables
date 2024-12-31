<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

// use Illuminate\Support\Facades\Exceptions;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;

final class DateColumnTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        parent::setupPetOwnerTable();
    }

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

        $this->assertSame($rows->last()->last_visit->format('Y-m-d'), $column->getContents($rows->last()));
        $this->assertSame($rows->last()->last_visit->format('Y-m-d'), '2023-05-04');
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
        $column->emptyValue('Not Found');

        $firstRow = $this->basicTable->getRows()->first();

        $firstRow->last_visit = '44-12-2023';

        $this->assertSame('Not Found', $column->getContents($firstRow));

        $firstRow->last_visit = '04-01-2023';

        $this->assertSame('04-01-2023', $column->getContents($firstRow));

        $this->assertSame('04-01-2023', $column->emptyValue('Unknown')->getContents($firstRow));

        $firstRow->last_visit = '44-12-2023';

        //  Exceptions::fake();

        $this->assertSame('Unknown', $column->emptyValue('Unknown')->getContents($firstRow));

        // Exceptions::assertReported(function (\Carbon\Exceptions\InvalidFormatException $e): bool {
        //     return $e->getMessage() === "Could not parse '44-12-2023': Failed to parse time string (44-12-2023) at position 8 (2): Unexpected character";
        // });

    }

    public function test_can_set_column_empty_value(): void
    {
        $column = DateColumn::make('Name', 'last_visit')->inputFormat('d-m-Y')->outputFormat('d-m-Y');
        $this->assertSame('', $column->getEmptyValue());

        $column->emptyValue('Not Found');
        $this->assertSame('Not Found', $column->getEmptyValue());

        $this->assertSame('Not Found', $column->getContents(Pet::where('id', 3)->first()));

        $column->emptyValue('');
        $this->assertSame('04-04-2023', $column->getContents(Pet::where('id', 4)->first()));

    }

    public function test_can_get_distant_related_date(): void
    {
        $column1 = DateColumn::make('Owner DoB', 'owner.date_of_birth')->inputFormat('Y-m-d')->outputFormat('d-m-Y');
        $column2 = DateColumn::make('Owner DoB', 'owner.date_of_birth')->inputFormat('Y-m-d')->outputFormat('d-M-Y');

        $rows = $this->petOwnerTable->getRows();
        $lastRow = $rows->last();

        $this->assertSame('22-08-1985', $column1->getContents($lastRow));
        $this->assertSame('22-Aug-1985', $column2->getContents($lastRow));

    }
}
