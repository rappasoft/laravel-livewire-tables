<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

final class ColumnConfigurationTest extends TestCase
{
    public function test_can_set_column_to_eager_load_relations(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->eagerLoadRelationsIsEnabled());

        $column = Column::make('Name')->eagerLoadRelations();

        $this->assertTrue($column->eagerLoadRelationsIsEnabled());
    }

    public function test_can_set_column_format(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->hasFormatter());

        $column->format(fn ($value) => $value);

        $this->assertTrue($column->hasFormatter());
    }

    public function test_can_set_column_wants_html(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->isHtml());

        $column->html();

        $this->assertTrue($column->isHtml());
    }

    public function test_can_hide_column(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->isHidden());
        $this->assertTrue($column->isVisible());

        $column->hideIf(true);

        $this->assertTrue($column->isHidden());
        $this->assertFalse($column->isVisible());
    }

    public function test_can_exclude_from_column_select(): void
    {
        $column = Column::make('Name');

        $this->assertTrue($column->isSelectable());

        $column->excludeFromColumnSelect();

        $this->assertFalse($column->isSelectable());
    }

    public function test_can_make_column_unclickable(): void
    {
        $column = Column::make('Name');

        $this->basicTable->setTableRowUrl(fn ($row) => 'https://example.com');
        $column->setHasTableRowUrl($this->basicTable->hasTableRowUrl());

        $this->assertTrue($column->isClickable());

        $column->unclickable();

        $this->assertFalse($column->isClickable());
    }

    public function test_can_deselect_column(): void
    {
        $column = Column::make('Name');

        $this->assertTrue($column->isSelected());

        $column->deselected();

        $this->assertFalse($column->isSelected());
    }

    public function test_can_deselect_if_column_via_callback(): void
    {
        $column = Column::make('Name');

        $this->assertTrue($column->isSelected());

        $column->deselectedIf(fn () => 2 > 4);

        $this->assertTrue($column->isSelected());

        $column->deselectedIf(fn () => 6 > 4);

        $this->assertFalse($column->isSelected());
    }

    public function test_can_select_if_column_via_callback(): void
    {
        $column = Column::make('Name 2');

        $this->assertTrue($column->isSelected());

        $column->selectedIf(fn () => 1 > 4);

        $this->assertFalse($column->isSelected());

        $column->selectedIf(fn () => 6 > 4);

        $this->assertTrue($column->isSelected());
    }

    public function test_can_select_if_column_via_bool(): void
    {
        $column = Column::make('Name 3');

        $this->assertTrue($column->isSelected());

        $column->selectedIf(false);

        $this->assertFalse($column->isSelected());

        $column->selectedIf(true);

        $this->assertTrue($column->isSelected());
    }

    public function test_can_deselect_if_column_via_bool(): void
    {
        $column = Column::make('Name 3');

        $this->assertTrue($column->isSelected());

        $column->deselectedIf(true);

        $this->assertFalse($column->isSelected());

        $column->deselectedIf(false);

        $this->assertTrue($column->isSelected());

    }

    public function test_can_set_secondary_header_as_filter(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->hasSecondaryHeader());

        $column->secondaryHeader($this->basicTable->getFilterByKey('breed'));

        $this->assertTrue($column->hasSecondaryHeader());
        $this->assertInstanceOf(Filter::class, $column->getSecondaryHeaderCallback());
    }

    public function test_can_set_footer_as_filter(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->hasFooter());

        $column->footer($this->basicTable->getFilterByKey('breed'));

        $this->assertTrue($column->hasFooter());
        $this->assertInstanceOf(Filter::class, $column->getFooterCallback());
    }
}
