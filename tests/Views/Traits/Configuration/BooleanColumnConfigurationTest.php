<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Traits\Configuration;

use Closure;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

final class BooleanColumnConfigurationTest extends TestCase
{
    public function test_boolean_column_can_set_callback(): void
    {
        $column = BooleanColumn::make('Name');

        $this->assertFalse($column->hasCallback());

        $column->setCallback(fn ($value) => (bool) $value === true);

        $this->assertTrue($column->hasCallback());

        $this->assertTrue($column->getCallback() instanceof Closure);
    }

    public function test_boolean_column_can_set_success_value(): void
    {
        $column = BooleanColumn::make('Name');

        $this->assertTrue($column->getSuccessValue());

        $column->setSuccessValue(false);

        $this->assertFalse($column->getSuccessValue());
    }

    public function test_boolean_column_can_set_view(): void
    {
        $column = BooleanColumn::make('Name');

        $this->assertSame('livewire-tables::includes.columns.boolean', $column->getView());

        $column->setView('livewire-tables::includes.columns.boolean2');

        $this->assertSame('livewire-tables::includes.columns.boolean2', $column->getView());
    }
}
