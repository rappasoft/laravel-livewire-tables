<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\LivewireComponentColumn;

final class LivewireComponentColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = LivewireComponentColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    public function test_can_not_be_a_label(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $column = LivewireComponentColumn::make('Total Users')->label(fn () => 'My Label')->getContents(Pet::find(1));

    }

    public function test_can_add_livewire_component(): void
    {
        $column = LivewireComponentColumn::make('Name', 'name');

        $this->assertFalse($column->hasLivewireComponent());
        $column->component('test-component');
        $this->assertTrue($column->hasLivewireComponent());
    }

    public function test_can_get_livewire_component(): void
    {
        $column = LivewireComponentColumn::make('Name', 'name');

        $this->assertFalse($column->hasLivewireComponent());
        $this->assertNull($column->getLivewireComponent());

        $column->component('test-component');

        $this->assertTrue($column->hasLivewireComponent());
        $this->assertSame('test-component', $column->getLivewireComponent());
    }

    public function test_can_not_avoid_defining_livewire_component(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $contents = LivewireComponentColumn::make('Total Users')->getContents(Pet::find(1));

    }

    public function test_attributes_should_return_array(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $column = LivewireComponentColumn::make('Total Users')->attributes(fn ($value, $row, Column $column) => 'test');

        $column->getContents(Pet::find(1));
    }
}
