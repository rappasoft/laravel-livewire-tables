<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ColumnConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_column_to_eager_load_relations(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->eagerLoadRelationsIsEnabled());

        $column = Column::make('Name')->eagerLoadRelations();

        $this->assertTrue($column->eagerLoadRelationsIsEnabled());
    }

    /** @test */
    public function can_set_component_on_column(): void
    {
        $column = Column::make('Name');

        $this->assertNull($column->getComponent());

        $column->setComponent($this->basicTable);

        $this->assertSame($this->basicTable, $column->getComponent());
    }

    /** @test */
    public function can_set_column_format(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->hasFormatter());

        $column->format(fn ($value) => $value);

        $this->assertTrue($column->hasFormatter());
    }

    /** @test */
    public function can_set_column_wants_html(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->isHtml());

        $column->html();

        $this->assertTrue($column->isHtml());
    }

    /** @test */
    public function can_hide_column(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->isHidden());
        $this->assertTrue($column->isVisible());

        $column->hideIf(true);

        $this->assertTrue($column->isHidden());
        $this->assertFalse($column->isVisible());
    }

    /** @test */
    public function can_exclude_from_column_select(): void
    {
        $column = Column::make('Name');

        $this->assertTrue($column->isSelectable());

        $column->excludeFromColumnSelect();

        $this->assertFalse($column->isSelectable());
    }

    /** @test */
    public function can_make_column_unclickable(): void
    {
        $column = Column::make('Name');

        $column->setComponent($this->basicTable);
        
        $this->basicTable->setTableRowUrl(fn ($row) => 'https://example.com');

        $this->assertTrue($column->isClickable());

        $column->unclickable();

        $this->assertFalse($column->isClickable());
    }
}
