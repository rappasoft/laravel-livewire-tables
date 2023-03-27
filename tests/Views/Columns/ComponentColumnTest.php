<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

class ComponentColumnTest extends TestCase
{
    /** @test */
    public function can_set_the_column_title(): void
    {
        $column = ComponentColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    /** @test */
    public function can_not_set_component_column_as_label(): void
    {
        $this->expectException(DataTableConfigurationException::class);
        $row = Pet::find(1);

        $column = ComponentColumn::make('Name')->label(fn($row, Column $column) => "Test");
        $column->getContents($row);

    }
}
