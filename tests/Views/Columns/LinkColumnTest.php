<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class LinkColumnTest extends TestCase
{
    /** @test */
    public function can_set_the_column_title(): void
    {
        $column = LinkColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    /** @test */
    public function can_set_the_column_alias(): void
    {
        $column = LinkColumn::make('Name', 'name')
            ->setAlias('my_name');

        $this->assertSame('my_name', $column->getAlias());
    }

    /** @test */
    public function can_not_infer_field_name_from_title_if_no_from(): void
    {
        $column = LinkColumn::make('My Title');

        $this->assertNull($column->getField());
    }

    /** @test */
    public function can_not_render_field_if_no_title_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        LinkColumn::make('Name')->getContents(Pet::find(1));
    }

    /** @test */
    public function can_not_render_field_if_no_location_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        LinkColumn::make('Name')->title(fn ($row) => 'Edit')->getContents(Pet::find(1));
    }

    /** @test */
    public function can_render_field_if_title_and_location_callback(): void
    {
        $column = LinkColumn::make('Name')->title(fn ($row) => 'Edit')->location(fn ($row) => 'test'.$row->id)->getContents(Pet::find(1));

        $this->assertNotEmpty($column);
    }
}
