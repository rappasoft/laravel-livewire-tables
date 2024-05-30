<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Traits\Configuration;

use Closure;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;

final class ComponentColumnConfigurationTest extends TestCase
{
    public function test_component_column_can_set_slot_callback(): void
    {
        $column = ComponentColumn::make('Name');

        $this->assertFalse($column->hasSlotCallback());

        $column->slot(fn ($value) => $value);

        $this->assertTrue($column->hasSlotCallback());

        $this->assertTrue($column->getSlotCallback() instanceof Closure);
    }

    public function test_component_column_can_set_attributes_callback(): void
    {
        $column = ComponentColumn::make('Name');

        $this->assertFalse($column->hasAttributesCallback());

        $column->attributes(fn ($value) => $value);

        $this->assertTrue($column->hasAttributesCallback());

        $this->assertTrue($column->getAttributesCallback() instanceof Closure);
    }
}
