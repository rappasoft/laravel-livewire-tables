<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LivewireComponentColumn;

#[Group('Columns')]
final class LivewireComponentColumnTest extends ColumnTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$columnInstance = LivewireComponentColumn::make('Name', 'name');
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
        $this->assertFalse(self::$columnInstance->hasLivewireComponent());
        self::$columnInstance->component('test-component');
        $this->assertTrue(self::$columnInstance->hasLivewireComponent());
    }

    public function test_can_get_livewire_component(): void
    {
        $this->assertFalse(self::$columnInstance->hasLivewireComponent());
        $this->assertNull(self::$columnInstance->getLivewireComponent());

        self::$columnInstance->component('test-component');

        $this->assertTrue(self::$columnInstance->hasLivewireComponent());
        $this->assertSame('test-component', self::$columnInstance->getLivewireComponent());
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
        self::$columnInstance->component('test-component');
        $this->assertFalse(self::$columnInstance->hasAttributesCallback());
    }

    public function test_can_set_attribute_callback(): void
    {
        self::$columnInstance->component('test-component');
        $this->assertFalse(self::$columnInstance->hasAttributesCallback());

        self::$columnInstance->attributes(function ($row) {
            return [
                'class' => '!rounded-lg self-center',
                'default' => true,
            ];
        });

        $this->assertTrue(self::$columnInstance->hasAttributesCallback());
    }
}
