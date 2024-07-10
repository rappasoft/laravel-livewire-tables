<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\CountColumn;

final class CountColumnTest extends TestCase
{
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

        $column = CountColumn::make('Total Users')
                ->sortable();
        $contents = $column->getContents(Pet::find(1));
        $this->assertNull($contents);

    }
}
