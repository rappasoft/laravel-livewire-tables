<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RelationshipHelpersTest extends TestCase
{
    /** @test */
    public function can_check_if_base_column(): void
    {
        $column = Column::make('ID');

        $this->assertTrue($column->isBaseColumn());

        $column = Column::make('ID', 'pets.id');

        $this->assertFalse($column->isBaseColumn());
    }

    /** @test */
    public function can_check_if_column_has_relations(): void
    {
        $column = Column::make('ID');

        $this->assertFalse($column->hasRelations());

        $column = Column::make('ID', 'pets.id');

        $this->assertTrue($column->hasRelations());
    }

    /** @test */
    public function can_get_column_relations(): void
    {
        $column = Column::make('ID');

        $this->assertSame([], $column->getRelations()->toArray());

        $column = Column::make('ID', 'pets.species.id');

        $this->assertSame(['pets', 'species'], $column->getRelations()->toArray());
    }

    /** @test */
    public function can_get_column_relation_string(): void
    {
        $column = Column::make('ID', 'pets.species.id');

        $this->assertSame('pets.species', $column->getRelationString());
    }
}
