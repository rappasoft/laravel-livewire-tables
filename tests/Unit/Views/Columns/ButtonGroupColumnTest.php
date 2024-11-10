<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

final class ButtonGroupColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = ButtonGroupColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    public function test_can_render_field(): void
    {
        $column = ButtonGroupColumn::make('Name')->getContents(Pet::find(1));
        $this->assertNotEmpty($column);
    }

    public function test_can_not_render_field_if_no_title(): void
    {
        $this->expectException(\ArgumentCountError::class);

        ButtonGroupColumn::make()->getContents(Pet::find(1));
    }

    public function test_can_render_field_if_title_callback(): void
    {
        $column = ButtonGroupColumn::make('Name')->getContents(Pet::find(1));

        $this->assertNotEmpty($column);
    }
}
