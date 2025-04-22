<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use Illuminate\Database\Eloquent\Model;
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

    public static function setup_with_public_methods()
    {
        \Livewire\Livewire::component('test-livewire-column-component', \Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\TestLivewireColumnComponent::class);

        $row = Pet::find(1);

        $temp = (new class('name', 'name') extends LivewireComponentColumn
        {
            public function pubRetrieveAttributes(Model $row)
            {
                return $this->retrieveAttributes($row);
            }

            public function pubImplodeAttributes(array $attributes)
            {
                return $this->implodeAttributes($attributes);
            }

            public function pubGetBlade(array $attributes, string $key)
            {
                return $this->getBlade($attributes, $key);
            }

            public function pubGetHtmlString(array $attributes, string $key)
            {
                return $this->getHtmlString($attributes, $key);
            }
        })->component('test-livewire-column-component')->attributes(function ($columnValue, $row) {
            return [
                'type' => 'test',
                'name' => $row->name,
            ];
        });

        $temp->setTable('test-table');

        return $temp;
    }

    public function test_can_get_attributes_correctly(): void
    {
        $row = Pet::find(1);
        $temp = self::setup_with_public_methods();
        $key = 'test-table-'.$row->{$row->getKeyName()};

        $this->assertSame(['type' => 'test', 'name' => 'Cartman'], $temp->pubRetrieveAttributes($row));

        $this->assertSame(':type="$type" :name="$name"', $temp->pubImplodeAttributes($temp->pubRetrieveAttributes($row)));
    }

    public function test_can_get_blade_correctly(): void
    {
        $row = Pet::find(1);
        $temp = self::setup_with_public_methods();
        $key = 'test-table-'.$row->{$row->getKeyName()};

        $this->assertStringContainsString('wire:snapshot="{&quot;data&quot;:{&quot;id&quot;:null,&quot;name&quot;:&quot;Cartman&quot;,&quot;value&quot;:null,&quot;type&quot;:&quot;test&quot;}', $temp->pubGetBlade($temp->pubRetrieveAttributes($row), $key));

        $this->assertStringContainsString('<div>Name:Cartman</div><div>Type:test</div>', $temp->pubGetBlade($temp->pubRetrieveAttributes($row), $key));
    }

    public function test_can_get_html_string_correctly(): void
    {
        $row = Pet::find(1);
        $temp = self::setup_with_public_methods();
        $key = 'test-table-'.$row->{$row->getKeyName()};

        $this->assertStringContainsString('<div>Name:Cartman</div><div>Type:test</div>', $temp->pubGetHtmlString($temp->pubRetrieveAttributes($row), $key));
    }

    public function test_can_get_contents_correctly(): void
    {
        $row = Pet::find(1);
        $temp = self::setup_with_public_methods();
        $key = 'test-table-'.$row->{$row->getKeyName()};

        $this->assertStringContainsString('<div>Name:Cartman</div><div>Type:test</div>', $temp->getContents($row));
    }
}
