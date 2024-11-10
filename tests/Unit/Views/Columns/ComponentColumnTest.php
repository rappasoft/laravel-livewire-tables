<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;

final class ComponentColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = ComponentColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    public function test_can_not_set_component_column_as_label(): void
    {
        $this->expectException(DataTableConfigurationException::class);
        $row = Pet::find(1);

        $column = ComponentColumn::make('Name')->label(fn ($row, Column $column) => 'Test');
        $column->getContents($row);
    }

    public function test_can_not_be_both_collapsible_on_mobile_and_on_tablet(): void
    {
        $this->expectException(DataTableConfigurationException::class);
        $column = ComponentColumn::make('Name', 'name')->collapseOnMobile()->collapseOnTablet();
        $row = Pet::find(1);
        $column->getContents($row);

    }
}
