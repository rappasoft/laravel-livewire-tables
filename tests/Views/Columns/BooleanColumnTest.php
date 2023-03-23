<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

class BooleanColumnTest extends TestCase
{
    /** @test */
    public function can_set_the_column_title(): void
    {
        $column = BooleanColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    /** @test */
    public function can_render_field(): void
    {
        $column = BooleanColumn::make('Name')->getContents(Pet::find(1));
        $this->assertNotEmpty($column);

    }

    /** @test */
    public function can_not_render_field_if_no_title(): void
    {
        $this->expectException(\ArgumentCountError::class);

        BooleanColumn::make()->getContents(Pet::find(1));
    }

    /** @test */
    public function can_render_field_if_title_callback(): void
    {
        $column = BooleanColumn::make('Name')->getContents(Pet::find(1));

        $this->assertNotEmpty($column);
    }

    /** @test */
    public function can_set_truthy_value(): void
    {
        $column = BooleanColumn::make('Name')->setSuccessValue(false)->getContents(Pet::find(1));

        $this->assertNotEmpty($column);
    }    

    /** @test */
    public function can_return_status_true(): void
    {
        $row = Pet::find(1);
        $value = true;
        $column = BooleanColumn::make('Name')->setCallback(function(string $value, $row) {
            return $row->id === 1;
        });
        $curVal = $column->hasCallback() ? call_user_func($column->getCallback(), $value, $row) : (bool)$value === true;
        $this->assertSame($curVal, true);
    }    

    /** @test */
    public function can_return_status_false(): void
    {
        $row = Pet::find(1);
        $value = true;
        $column = BooleanColumn::make('Name')->setCallback(function(string $value, $row) {
            return $row->id === 2;
        });
        $curVal = $column->hasCallback() ? call_user_func($column->getCallback(), $value, $row) : (bool)$value === true;
        $this->assertSame($curVal, false);
    }    
}
