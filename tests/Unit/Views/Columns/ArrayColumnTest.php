<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\ArrayColumn;

final class ArrayColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = ArrayColumn::make('Array Col');

        $this->assertSame('Array Col', $column->getTitle());
    }

    public function test_can_set_the_separator(): void
    {
        $column = ArrayColumn::make('Array Col');

        $this->assertSame('<br />', $column->getSeparator());
        $column->separator('<br /><br />');
        $this->assertTrue($column->hasSeparator());

        $this->assertSame('<br /><br />', $column->getSeparator());
    }

    public function test_can_set_the_output_format(): void
    {
        $column = ArrayColumn::make('Array Col');

        $this->assertNull($column->getOutputFormatCallback());
        $this->assertFalse($column->hasOutputFormatCallback());
        $column->outputFormat(fn ($index, $value) => "<a href='".$value->id."'>".$value->name.'</a>');
        $this->assertTrue($column->hasOutputFormatCallback());
    }

    public function test_requires_the_data_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);
        $column = ArrayColumn::make('Average Age')
            ->separator('<br /><br />')
            ->sortable();
        $contents = $column->getContents(Pet::find(1));
        $this->assertNull($contents);
    }

    public function test_can_get_the_output_format_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);
        $column = ArrayColumn::make('Average Age')
            ->separator('<br /><br />')
            ->data(fn ($value, $row) => ($row->pets))
            ->sortable();
        $this->assertNotNull($column->getDataCallback());

        $contents = $column->getContents(Pet::find(1));
        $this->assertNull($contents);
    }

    public function test_requires_the_output_format_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);
        $column = ArrayColumn::make('Average Age')
            ->separator('<br /><br />')
            ->data(fn ($value, $row) => ($row->pets))
            ->sortable();

        $contents = $column->getContents(Pet::find(1));
        $this->assertNull($contents);
    }

    public function test_can_get_empty_value(): void
    {
        $column = ArrayColumn::make('Average Age')
            ->separator('<br /><br />')
            ->data(fn ($value, $row) => ($row->pets))
            ->sortable();

        $this->assertSame('', $column->getEmptyValue());
        $column->emptyValue('Unknown');
        $this->assertSame('Unknown', $column->getEmptyValue());

    }
}
