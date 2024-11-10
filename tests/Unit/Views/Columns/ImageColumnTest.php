<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

final class ImageColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = ImageColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    public function test_can_not_infer_field_name_from_title_if_no_from(): void
    {
        $column = ImageColumn::make('My Title');

        $this->assertNull($column->getField());
    }

    public function test_can_not_render_field_if_no_location_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        ImageColumn::make('Name')->getContents(Pet::find(1));
    }

    public function test_can_not_render_field_if_no_title(): void
    {
        $this->expectException(\ArgumentCountError::class);

        ImageColumn::make()->getContents(Pet::find(1));
    }

    public function test_can_render_field_if_title_and_location_callback(): void
    {
        $column = ImageColumn::make('Name')->location(fn ($row) => 'test'.$row->id)->getContents(Pet::find(1));

        $this->assertNotEmpty($column);
    }
}
