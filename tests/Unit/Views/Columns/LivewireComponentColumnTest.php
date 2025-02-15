<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LivewireComponentColumn;

#[Group('Columns')]
final class LivewireComponentColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = LivewireComponentColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    public function test_can_not_be_a_label_without_component(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $column = LivewireComponentColumn::make('Total Users')->label(fn () => 'My Label')->getContents(Pet::find(1));

    }

    public function test_can_not_be_a_label_with_component(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $column = LivewireComponentColumn::make('Total Users')->component('test-component')->label(fn () => 'My Label')->getContents(Pet::find(1));

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
        $col = LivewireComponentColumn::make('Name');

        $contents = $col->getContents(Pet::find(1));

    }

    public function test_attributes_should_return_array(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $column = LivewireComponentColumn::make('Name')->component('test-component')->attributes(fn ($value, $row, Column $column) => 'test');

        $column->getContents(Pet::find(1));
    }

    public function test_can_check_attribute_callback_presence(): void
    {
        $column = LivewireComponentColumn::make('Name', 'name')->component('test-component');
        $this->assertFalse($column->hasAttributesCallback());
    }

    public function test_can_set_attribute_callback(): void
    {
        $column = LivewireComponentColumn::make('Name', 'name')->component('test-component');
        $this->assertFalse($column->hasAttributesCallback());

        $column->attributes(function ($row) {
            return [
                'class' => '!rounded-lg self-center',
                'default' => true,
            ];
        });

        $this->assertTrue($column->hasAttributesCallback());
    }
}
