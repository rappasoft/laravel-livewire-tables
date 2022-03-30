<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ColumnTest extends TestCase
{
    /** @test */
    public function can_set_the_column_title(): void
    {
        $column = Column::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    /** @test */
    public function can_infer_field_name_from_title_if_no_from(): void
    {
        $column = Column::make('My Title');

        $this->assertSame('my_title', $column->getField());
    }

    /** @test */
    public function can_set_base_field_from_from(): void
    {
        $column = Column::make('Name', 'name');

        $this->assertSame('name', $column->getField());
    }

    /** @test */
    public function can_set_relation_field_from_from(): void
    {
        $column = Column::make('Name', 'address.group.name');

        $this->assertSame('name', $column->getField());
    }

    /** @test */
    public function can_set_relations_from_from(): void
    {
        $column = Column::make('Name', 'address.group.name');

        $this->assertSame(['address', 'group'], $column->getRelations()->toArray());
        $this->assertSame('address.group', $column->getRelationString());
    }

    /** @test */
    public function can_get_contents_of_column(): void
    {
        // TODO: Figure out how to call getContents on a row object to verify that way
        $rows = $this->basicTable->getRows();
        $this->assertSame('Cartman', $rows->first()->name);
        $this->assertSame('Norwegian Forest', $rows->first()['breed.name']);
    }

    /** @test */
    public function column_table_gets_set_for_base_and_relationship_columns(): void
    {
        $column = $this->basicTable->getColumnBySelectName('name');

        $this->assertSame('pets', $column->getTable());

        $column = $this->basicTable->getColumnBySelectName('breed.name');

        $this->assertSame('breeds', $column->getTable());
    }
}
