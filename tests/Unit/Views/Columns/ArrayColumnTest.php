<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Columns\ArrayColumn;

#[Group('Columns')]
final class ArrayColumnTest extends ColumnTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$columnInstance = ArrayColumn::make('Name');
    }

    public function test_can_set_the_separator(): void
    {
        $this->assertSame('<br />', self::$columnInstance->getSeparator());
        self::$columnInstance->separator('<br /><br />');
        $this->assertTrue(self::$columnInstance->hasSeparator());

        $this->assertSame('<br /><br />', self::$columnInstance->getSeparator());
    }

    public function test_can_set_the_output_format(): void
    {
        $this->assertNull(self::$columnInstance->getOutputFormatCallback());
        $this->assertFalse(self::$columnInstance->hasOutputFormatCallback());
        self::$columnInstance->outputFormat(fn ($index, $value) => "<a href='".$value->id."'>".$value->name.'</a>');
        $this->assertTrue(self::$columnInstance->hasOutputFormatCallback());
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
        self::$columnInstance
            ->separator('<br /><br />')
            ->data(fn ($value, $row) => ($row->pets))
            ->sortable();
        $this->assertNotNull(self::$columnInstance->getDataCallback());

        $contents = self::$columnInstance->getContents(Pet::find(1));
        $this->assertNull($contents);
    }

    public function test_requires_the_output_format_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);
        self::$columnInstance
            ->separator('<br /><br />')
            ->data(fn ($value, $row) => ($row->pets))
            ->sortable();

        $contents = self::$columnInstance->getContents(Pet::find(1));
        $this->assertNull($contents);
    }

    public function test_can_get_empty_value(): void
    {
        self::$columnInstance
            ->separator('<br /><br />')
            ->data(fn ($value, $row) => ($row->pets))
            ->sortable();

        $this->assertSame('', self::$columnInstance->getEmptyValue());
        self::$columnInstance->emptyValue('Unknown');
        $this->assertSame('Unknown', self::$columnInstance->getEmptyValue());

    }


}
