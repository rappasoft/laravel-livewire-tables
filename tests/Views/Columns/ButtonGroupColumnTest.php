<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class ButtonGroupColumnTest extends TestCase
{
    /** @test */
    public function can_set_the_column_title(): void
    {
        $column = ButtonGroupColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    /** @test */
    public function can_set_the_column_alias(): void
    {
        $column = ButtonGroupColumn::make('Name', 'name', 'my_name');

        $this->assertSame('my_name', $column->getAlias());
    }

    /** @test */
    public function can_render_field(): void
    {
        $column = ButtonGroupColumn::make('Name')->getContents(Pet::find(1));
        $this->assertNotEmpty($column);
    }

    /** @test */
    public function can_not_render_field_if_no_title(): void
    {
        $this->expectException(\ArgumentCountError::class);

        ButtonGroupColumn::make()->getContents(Pet::find(1));
    }

    /** @test */
    public function can_render_field_if_title_callback(): void
    {
        $column = ButtonGroupColumn::make('Name')->getContents(Pet::find(1));

        $this->assertNotEmpty($column);
    }
}
