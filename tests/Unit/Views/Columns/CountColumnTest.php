<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Columns\CountColumn;

#[Group('Columns')]
final class CountColumnTest extends ColumnTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        parent::setupSpeciesTable();
        self::$columnInstance = CountColumn::make('Total Users');

    }

    public function test_can_set_the_column_title(): void
    {
        $this->assertSame('Total Users', self::$columnInstance->getTitle());
    }

    public function test_can_setup_column_correctly(): void
    {
        $column = self::$columnInstance
            ->setDataSource('users')
            ->sortable();

        $this->assertNotEmpty($column);
    }

    public function test_can_not_skip_set_data_source(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $column = self::$columnInstance
            ->sortable();
        $contents = $column->getContents(Pet::find(1));
        $this->assertNull($contents);

    }

    public function test_renders_correctly(): void
    {
        $rows = $this->speciesTable->getRows();
        $row1 = $rows->first();
        $column = self::$columnInstance
            ->setDataSource('pets');
        $contents = $column->getContents($rows->first());
        $this->assertSame('2', $contents);
        $contents = $column->getContents($rows->last());
        $this->assertSame('0', $contents);
    }
}
