<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

#[Group('Columns')]
final class ButtonGroupColumnTest extends ColumnTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$columnInstance = ButtonGroupColumn::make('Name', 'name');
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
