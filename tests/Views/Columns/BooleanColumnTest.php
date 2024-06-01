<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

final class BooleanColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = BooleanColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    public function test_can_render_field(): void
    {
        $column = BooleanColumn::make('Name')->getContents(Pet::find(1));
        $this->assertNotEmpty($column);
    }

    public function test_can_not_render_field_if_no_title(): void
    {
        $this->expectException(\ArgumentCountError::class);

        BooleanColumn::make()->getContents(Pet::find(1));
    }

    public function test_can_render_field_if_title_callback(): void
    {
        $column = BooleanColumn::make('Name')->getContents(Pet::find(1));

        $this->assertNotEmpty($column);
    }

    public function test_can_set_truthy_value(): void
    {
        $column = BooleanColumn::make('Name')->setSuccessValue(false)->getContents(Pet::find(1));

        $this->assertNotEmpty($column);
    }

    public function test_can_set_boolean_column_icons(): void
    {
        $column = BooleanColumn::make('Name')->setSuccessValue(false)->icons();

        $this->assertSame('icons', $column->getType());
    }

    public function test_can_set_boolean_column_yesno(): void
    {
        $column = BooleanColumn::make('Name')->setSuccessValue(false)->yesNo();

        $this->assertSame('yes-no', $column->getType());
    }

    public function test_can_return_status_true(): void
    {
        $row = Pet::find(1);
        $value = true;
        $column = BooleanColumn::make('Name')->setCallback(function (string $value, $row) {
            return $row->id === 1;
        });
        $curVal = $column->hasCallback() ? call_user_func($column->getCallback(), $value, $row) : (bool) $value === true;
        $this->assertSame($curVal, true);
    }

    public function test_can_return_status_false(): void
    {
        $row = Pet::find(1);
        $value = true;
        $column = BooleanColumn::make('Name')->setCallback(function (string $value, $row) {
            return $row->id === 2;
        });
        $curVal = $column->hasCallback() ? call_user_func($column->getCallback(), $value, $row) : (bool) $value === true;
        $this->assertSame($curVal, false);
    }
}
