<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;

final class ComponentColumnTest extends TestCase
{
    public function test_component_column_attributes_callback_return_can_not_be_an_string()
    {
        $this->expectException(DataTableConfigurationException::class);
        ComponentColumn::make('Name')
            ->component('alert')
            ->attributes(fn () => 'string')->getContents(Pet::find(1));
    }

    public function test_component_column_component_has_to_be_an_string()
    {
        $column = ComponentColumn::make('Name')
            ->component('alert');
        $this->assertEquals('components.alert', $column->getComponentView());
    }

    public function test_component_column_component_view_has_to_be_set()
    {
        $this->expectException(DataTableConfigurationException::class);
        ComponentColumn::make('Name')
            ->getContents(Pet::find(1));
    }
}
