<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use Illuminate\Support\Facades\Blade;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Components\TestComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;

#[Group('Columns')]
final class ComponentColumnTest extends ColumnTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$columnInstance = ComponentColumn::make('Name', 'name');
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
        $column = self::$columnInstance->collapseOnMobile()->collapseOnTablet();
        $row = Pet::find(1);
        $column->getContents($row);

    }

    public function test_can_set_custom_slot(): void
    {
        $column = ComponentColumn::make('Age 2', 'age')
            ->attributes(fn ($value, $row, Column $column) => [
                'age' => $row->age,
            ])
            ->slot(fn ($value, $row, Column $column) => [
                ($row->age < 2) => 'test1',
                ($row->age > 2) => 'test2',
            ]);
        $this->assertTrue($column->hasSlotCallback());
    }

    public function test_can_get_custom_slot(): void
    {

        $column = ComponentColumn::make('Age 2', 'age')
            ->attributes(fn ($value, $row, Column $column) => [
                'age' => $row->age,
            ])
            ->slot(fn ($value, $row, Column $column) => (($row->age < 10) ? 'youngslot' : 'oldslot'))
            ->component('test-component');

        $pet1 = Pet::where('age', '>', 11)->first();
        $pet1_contents = $column->getContents($pet1);
        $this->assertSame('oldslot', $pet1_contents->getData()['slot']->__toString());

        $pet2 = Pet::where('age', '<', 5)->first();
        $pet2_contents = $column->getContents($pet2);
        $this->assertSame('youngslot', $pet2_contents->getData()['slot']->__toString());

    }

    public function test_can_get_attributes(): void
    {

        $column = ComponentColumn::make('Age 2', 'age')
            ->attributes(fn ($value, $row, Column $column) => [
                'age' => $row->age,
            ])
            ->slot(fn ($value, $row, Column $column) => (($row->age < 10) ? 'youngslot' : 'oldslot'))
            ->component('test-component');

        $pet1 = Pet::where('age', '>', 11)->first();
        $pet1_contents = $column->getContents($pet1);
        $this->assertSame(22, $pet1_contents->getData()['attributes']['age']);

        $pet2 = Pet::where('age', '<', 5)->first();
        $pet2_contents = $column->getContents($pet2);
        $this->assertSame(2, $pet2_contents->getData()['attributes']['age']);

    }

    public function test_can_not_return_invalid_attributes_return(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $column = ComponentColumn::make('Total Users')
            ->component('test-component')
            ->attributes(fn ($value, $row, Column $column) => (string) 'test');

        $contents = $column->getContents(Pet::find(1));

        $this->assertSame('<div>2420</div>', $contents);

    }
}
