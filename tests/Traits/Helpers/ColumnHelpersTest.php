<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ColumnHelpersTest extends TestCase
{
    /** @test */
    public function can_get_column_list(): void
    {
        $this->assertCount(6, $this->basicTable->getColumns()->toArray());
    }

    /** @test */
    public function can_get_column_by_column(): void
    {
        $column = $this->basicTable->getColumn('pets.id');

        $this->assertSame('id', $column->getField());
    }

    /** @test */
    public function can_get_column_by_select_name(): void
    {
        $column = $this->basicTable->getColumnBySelectName('id');

        $this->assertSame('id', $column->getField());
    }

    /** @test */
    public function can_get_column_count(): void
    {
        $this->assertSame(6, $this->basicTable->getColumnCount());
    }

    /** @test */
    public function can_tell_if_there_are_collapsable_columns(): void
    {
        $this->assertFalse($this->basicTable->hasCollapsedColumns());

        $this->assertFalse($this->basicTable->getColumnBySelectName('id')->shouldCollapseOnMobile());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();

        $this->assertTrue($this->basicTable->getColumnBySelectName('id')->shouldCollapseOnMobile());

        $this->assertTrue($this->basicTable->hasCollapsedColumns());
    }

    /** @test */
    public function can_tell_if_columns_should_collapse_on_mobile(): void
    {
        $this->assertFalse($this->basicTable->shouldCollapseOnMobile());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();

        $this->assertTrue($this->basicTable->shouldCollapseOnMobile());
    }

    /** @test */
    public function can_get_collapsed_mobile_columns(): void
    {
        $this->assertCount(0, $this->basicTable->getCollapsedMobileColumns());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();
        $this->basicTable->getColumnBySelectName('name')->collapseOnMobile();

        $this->assertCount(2, $this->basicTable->getCollapsedMobileColumns());

        $this->assertSame('ID', $this->basicTable->getCollapsedMobileColumns()[0]->getTitle());
        $this->assertSame('Name', $this->basicTable->getCollapsedMobileColumns()[1]->getTitle());
    }

    /** @test */
    public function can_get_collapsed_mobile_columns_count(): void
    {
        $this->assertSame(0, $this->basicTable->getCollapsedMobileColumnsCount());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();
        $this->basicTable->getColumnBySelectName('name')->collapseOnMobile();

        $this->assertSame(2, $this->basicTable->getCollapsedMobileColumnsCount());
    }

    /** @test */
    public function can_get_visible_mobile_columns(): void
    {
        $this->assertCount(6, $this->basicTable->getVisibleMobileColumns());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();
        $this->basicTable->getColumnBySelectName('name')->collapseOnMobile();

        $this->assertCount(4, $this->basicTable->getVisibleMobileColumns());
        $this->assertSame('Sort', $this->basicTable->getVisibleMobileColumns()->values()[0]->getTitle());
        $this->assertSame('Age', $this->basicTable->getVisibleMobileColumns()->values()[1]->getTitle());
        $this->assertSame('Breed', $this->basicTable->getVisibleMobileColumns()->values()[2]->getTitle());
        $this->assertSame('Other', $this->basicTable->getVisibleMobileColumns()->values()[3]->getTitle());
    }

    /** @test */
    public function can_get_visible_mobile_columns_count(): void
    {
        $this->assertSame(6, $this->basicTable->getVisibleMobileColumnsCount());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();
        $this->basicTable->getColumnBySelectName('name')->collapseOnMobile();

        $this->assertSame(4, $this->basicTable->getVisibleMobileColumnsCount());
    }

    /** @test */
    public function can_tell_if_columns_should_collapse_on_tablet(): void
    {
        $this->assertFalse($this->basicTable->shouldCollapseOnTablet());

        $this->basicTable->getColumnBySelectName('id')->collapseOnTablet();

        $this->assertTrue($this->basicTable->shouldCollapseOnTablet());
    }

    /** @test */
    public function can_get_collapsed_tablet_columns(): void
    {
        $this->assertCount(0, $this->basicTable->getCollapsedTabletColumns());

        $this->basicTable->getColumnBySelectName('id')->collapseOnTablet();
        $this->basicTable->getColumnBySelectName('name')->collapseOnTablet();

        $this->assertCount(2, $this->basicTable->getCollapsedTabletColumns());
        $this->assertSame('ID', $this->basicTable->getCollapsedTabletColumns()[0]->getTitle());
        $this->assertSame('Name', $this->basicTable->getCollapsedTabletColumns()[1]->getTitle());
    }

    /** @test */
    public function can_get_collapsed_tablet_columns_count(): void
    {
        $this->assertSame(0, $this->basicTable->getCollapsedTabletColumnsCount());

        $this->basicTable->getColumnBySelectName('id')->collapseOnTablet();
        $this->basicTable->getColumnBySelectName('name')->collapseOnTablet();

        $this->assertSame(2, $this->basicTable->getCollapsedTabletColumnsCount());
    }

    /** @test */
    public function can_get_visible_tablet_columns(): void
    {
        $this->assertCount(6, $this->basicTable->getVisibleTabletColumns());

        $this->basicTable->getColumnBySelectName('id')->collapseOnTablet();
        $this->basicTable->getColumnBySelectName('name')->collapseOnTablet();

        $this->assertCount(4, $this->basicTable->getVisibleTabletColumns());
        $this->assertSame('Sort', $this->basicTable->getVisibleTabletColumns()->values()[0]->getTitle());
        $this->assertSame('Age', $this->basicTable->getVisibleTabletColumns()->values()[1]->getTitle());
        $this->assertSame('Breed', $this->basicTable->getVisibleTabletColumns()->values()[2]->getTitle());
        $this->assertSame('Other', $this->basicTable->getVisibleTabletColumns()->values()[3]->getTitle());
    }

    /** @test */
    public function can_get_visible_tablet_columns_count(): void
    {
        $this->assertSame(6, $this->basicTable->getVisibleTabletColumnsCount());

        $this->basicTable->getColumnBySelectName('id')->collapseOnTablet();
        $this->basicTable->getColumnBySelectName('name')->collapseOnTablet();

        $this->assertSame(4, $this->basicTable->getVisibleTabletColumnsCount());
    }

    /** @test */
    public function can_get_selectable_columns(): void
    {
        $selectable = $this->basicTable->getSelectableColumns()
            ->map(fn (Column $column) => $column->getColumnSelectName())
            ->toArray();

        $this->assertSame(['id', 'sort', 'name', 'age', 'breed.name'], $selectable);
    }

    /** @test */
    public function can_get_searchable_columns(): void
    {
        $selectable = $this->basicTable->getSearchableColumns()
            ->map(fn (Column $column) => $column->getColumnSelectName())
            ->toArray();

        $this->assertSame(['name'], $selectable);
    }

    /** @test */
    public function can_get_a_list_of_column_relations(): void
    {
        $this->assertSame([['breed']], $this->basicTable->getColumnRelations());
    }

    /** @test */
    public function can_get_a_list_of_column_relation_strings(): void
    {
        $this->assertSame(['breed'], $this->basicTable->getColumnRelationStrings());
    }

    /** @test */
    public function can_check_if_column_is_reorder_column(): void
    {
        $column = Column::make('ID', 'id');
        $column->setComponent($this->basicTable);

        $this->assertFalse($column->isReorderColumn());

        $column = Column::make('Sort');
        $column->setComponent($this->basicTable);

        $this->assertTrue($column->isReorderColumn());
    }
}
