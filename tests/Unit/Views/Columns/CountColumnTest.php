<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\CountColumn;

final class CountColumnTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        parent::setupSpeciesTable();
    }

    public function test_can_set_the_column_title(): void
    {
        $column = CountColumn::make('Total Users');

        $this->assertSame('Total Users', $column->getTitle());
    }

    public function test_can_setup_column_correctly(): void
    {
        $column = CountColumn::make('Total Users')
            ->setDataSource('users')
            ->sortable();

        $this->assertNotEmpty($column);
    }

    public function test_can_not_skip_set_data_source(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $column = CountColumn::make('Average Age')
            ->sortable();
        $contents = $column->getContents(Pet::find(1));
        $this->assertNull($contents);

    }

    public function test_renders_correctly(): void
    {
        $rows = $this->speciesTable->getRows();
        $row1 = $rows->first();
        $column = CountColumn::make('Pets')
            ->setDataSource('pets');
        $contents = $column->getContents($rows->first());
        $this->assertSame('2', $contents);
        $contents = $column->getContents($rows->last());
        $this->assertSame('0', $contents);
    }
}
