<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Exceptions\NoColumnsException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

final class ColumnHelpersTest extends TestCase
{
    public function test_can_get_column_list(): void
    {
        $this->assertCount(9, $this->basicTable->getColumns()->toArray());
    }

    public function test_can_append_column(): void
    {
        $this->assertCount(9, $this->basicTable->getColumns()->toArray());

        $this->basicTable->setAppendedColumns([Column::make('IDLabel')->label(function ($row) {
            return 'Test';
        })]);

        $this->basicTable->setColumns();

        $this->assertCount(10, $this->basicTable->getColumns()->toArray());

    }

    public function test_can_prepend_column(): void
    {
        $this->assertCount(9, $this->basicTable->getColumns()->toArray());

        $this->basicTable->setPrependedColumns([Column::make('IDLabel')->label(function ($row) {
            return 'Test';
        })]);

        $this->basicTable->setColumns();

        $this->assertCount(10, $this->basicTable->getColumns()->toArray());
    }

    public function test_can_get_column_by_column(): void
    {
        $column = $this->basicTable->getColumn('pets.id');

        $this->assertSame('id', $column->getField());
    }

    public function test_can_get_column_by_select_name(): void
    {
        $column = $this->basicTable->getColumnBySelectName('id');

        $this->assertSame('id', $column->getField());
    }

    public function test_can_get_column_count(): void
    {
        $this->assertSame(9, $this->basicTable->getColumnCount());
    }

    public function test_can_tell_if_there_are_collapsable_columns(): void
    {
        $this->assertFalse($this->basicTable->hasCollapsedColumns());

        $this->assertFalse($this->basicTable->getColumnBySelectName('id')->shouldCollapseOnMobile());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertTrue($this->basicTable->getColumnBySelectName('id')->shouldCollapseOnMobile());

        $this->assertTrue($this->basicTable->hasCollapsedColumns());
    }

    public function test_can_tell_if_columns_should_collapse_on_mobile(): void
    {
        $this->assertFalse($this->basicTable->shouldCollapseOnMobile());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertTrue($this->basicTable->shouldCollapseOnMobile());
    }

    public function test_can_get_collapsed_mobile_columns(): void
    {
        $this->assertCount(0, $this->basicTable->getCollapsedMobileColumns());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();
        $this->basicTable->getColumnBySelectName('name')->collapseOnMobile();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertCount(2, $this->basicTable->getCollapsedMobileColumns());
        $this->assertSame('ID', $this->basicTable->getCollapsedMobileColumns()[0]->getTitle());
        $this->assertSame('Name', $this->basicTable->getCollapsedMobileColumns()[1]->getTitle());
    }

    public function test_can_get_collapsed_mobile_columns_count(): void
    {
        $this->assertSame(0, $this->basicTable->getCollapsedMobileColumnsCount());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();
        $this->basicTable->getColumnBySelectName('name')->collapseOnMobile();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertSame(2, $this->basicTable->getCollapsedMobileColumnsCount());
    }

    public function test_can_get_visible_mobile_columns(): void
    {
        $this->assertCount(9, $this->basicTable->getVisibleMobileColumns());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();
        $this->basicTable->getColumnBySelectName('name')->collapseOnMobile();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertCount(7, $this->basicTable->getVisibleMobileColumns());
        $this->assertSame('Sort', $this->basicTable->getVisibleMobileColumns()->values()[0]->getTitle());
        $this->assertSame('Age', $this->basicTable->getVisibleMobileColumns()->values()[1]->getTitle());
        $this->assertSame('Breed', $this->basicTable->getVisibleMobileColumns()->values()[2]->getTitle());
        $this->assertSame('Other', $this->basicTable->getVisibleMobileColumns()->values()[3]->getTitle());
    }

    public function test_can_get_visible_mobile_columns_count(): void
    {
        $this->assertSame(9, $this->basicTable->getVisibleMobileColumnsCount());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();
        $this->basicTable->getColumnBySelectName('name')->collapseOnMobile();

        $this->assertSame(7, $this->basicTable->getVisibleMobileColumnsCount());
    }

    public function test_can_tell_if_columns_should_collapse_on_tablet(): void
    {
        $this->assertFalse($this->basicTable->shouldCollapseOnTablet());

        $this->basicTable->getColumnBySelectName('id')->collapseOnTablet();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertTrue($this->basicTable->shouldCollapseOnTablet());
    }

    public function test_can_get_collapsed_tablet_columns(): void
    {
        $this->assertCount(0, $this->basicTable->getCollapsedTabletColumns());

        $this->basicTable->getColumnBySelectName('id')->collapseOnTablet();
        $this->basicTable->getColumnBySelectName('name')->collapseOnTablet();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertCount(2, $this->basicTable->getCollapsedTabletColumns());
        $this->assertSame('ID', $this->basicTable->getCollapsedTabletColumns()[0]->getTitle());
        $this->assertSame('Name', $this->basicTable->getCollapsedTabletColumns()[1]->getTitle());
    }

    public function test_can_get_collapsed_tablet_columns_count(): void
    {
        $this->assertSame(0, $this->basicTable->getCollapsedTabletColumnsCount());

        $this->basicTable->getColumnBySelectName('id')->collapseOnTablet();
        $this->basicTable->getColumnBySelectName('name')->collapseOnTablet();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertSame(2, $this->basicTable->getCollapsedTabletColumnsCount());
    }

    public function test_can_get_visible_tablet_columns(): void
    {
        $this->assertCount(9, $this->basicTable->getVisibleTabletColumns());

        $this->basicTable->getColumnBySelectName('id')->collapseOnTablet();
        $this->basicTable->getColumnBySelectName('name')->collapseOnTablet();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertCount(7, $this->basicTable->getVisibleTabletColumns());
        $this->assertSame('Sort', $this->basicTable->getVisibleTabletColumns()->values()[0]->getTitle());
        $this->assertSame('Age', $this->basicTable->getVisibleTabletColumns()->values()[1]->getTitle());
        $this->assertSame('Breed', $this->basicTable->getVisibleTabletColumns()->values()[2]->getTitle());
        $this->assertSame('Other', $this->basicTable->getVisibleTabletColumns()->values()[3]->getTitle());
    }

    public function test_can_get_visible_tablet_columns_count(): void
    {
        $this->assertSame(9, $this->basicTable->getVisibleTabletColumnsCount());

        $this->basicTable->getColumnBySelectName('id')->collapseOnTablet();
        $this->basicTable->getColumnBySelectName('name')->collapseOnTablet();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertSame(7, $this->basicTable->getVisibleTabletColumnsCount());
    }

    // / *** ** //

    public function test_can_tell_if_columns_should_collapse_always(): void
    {
        $this->assertFalse($this->basicTable->shouldCollapseAlways());

        $this->basicTable->getColumnBySelectName('id')->collapseAlways();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertTrue($this->basicTable->shouldCollapseAlways());
    }

    public function test_can_get_always_collapsed_columns(): void
    {
        $this->assertCount(0, $this->basicTable->getCollapsedAlwaysColumns());

        $this->basicTable->getColumnBySelectName('id')->collapseAlways();
        $this->basicTable->getColumnBySelectName('name')->collapseAlways();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertCount(2, $this->basicTable->getCollapsedAlwaysColumns());
        $this->assertSame('ID', $this->basicTable->getCollapsedAlwaysColumns()[0]->getTitle());
        $this->assertSame('Name', $this->basicTable->getCollapsedAlwaysColumns()[1]->getTitle());
    }

    public function test_can_get_always_collapsed_columns_count(): void
    {
        $this->assertSame(0, $this->basicTable->getCollapsedAlwaysColumnsCount());

        $this->basicTable->getColumnBySelectName('id')->collapseAlways();
        $this->basicTable->getColumnBySelectName('name')->collapseAlways();

        $this->basicTable->unsetCollapsedStatuses();

        $this->assertSame(2, $this->basicTable->getCollapsedAlwaysColumnsCount());
    }

    /*public function test_can_get_selectable_columns(): void
    {
        $selectable = $this->basicTable->getSelectableColumns()
            ->map(fn (Column $column) => $column->getColumnSelectName())
            ->toArray();

        $this->assertSame(['id', 'name', 'age', 'breed.name', 'last_visit'], $selectable);
    }*/

    public function test_can_get_searchable_columns(): void
    {
        $selectable = $this->basicTable->getSearchableColumns()
            ->map(fn (Column $column) => $column->getColumnSelectName())
            ->toArray();

        $this->assertSame(['name', 'breed.name'], $selectable);
    }

    public function test_can_get_a_list_of_column_relations(): void
    {
        $this->assertSame([['breed']], $this->basicTable->getColumnRelations());
    }

    public function test_can_get_a_list_of_column_relation_strings(): void
    {
        $this->assertSame(['breed'], $this->basicTable->getColumnRelationStrings());
    }

    public function test_can_check_if_column_is_reorder_column(): void
    {
        $column = Column::make('ID', 'id');

        $this->assertFalse($column->getIsReorderColumn());

        $column = Column::make('Sort');
        $column->setIsReorderColumn($this->basicTable->getDefaultReorderColumn() == $column->getField());

        $this->assertTrue($column->getIsReorderColumn());
    }

    public function test_can_check_if_column_has_secondary_header(): void
    {
        $column = $this->basicTable->getColumnBySelectName('name');
        $this->assertTrue($column->hasSecondaryHeaderCallback());
        $callback = $column->getSecondaryHeaderCallback();
        $this->assertTrue($callback instanceof TextFilter);
    }

    public function test_can_check_if_column_has_secondary_header_filter(): void
    {
        $column = $this->basicTable->getColumnBySelectName('breed.name');
        $this->assertTrue($column->hasSecondaryHeader());
        $this->assertTrue($column->hasSecondaryHeaderCallback());

        $contents = $column->getSecondaryHeaderFilter($this->basicTable->getFilterByKey($column->getSecondaryHeaderCallback()), $this->basicTable->getFilterGenericData());
        // $contents = $column->getSecondaryHeaderFilter($this->basicTable->getFilterByKey('breed'));
        $this->assertStringContainsString('id="table-filter-breed-8-header"', $contents);
    }

    public function test_can_check_if_column_has_custom_slug(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->hasCustomSlug());

        $column->setCustomSlug('test123');

        $this->assertTrue($column->hasCustomSlug());
    }

    public function test_can_column_custom_slug_returns(): void
    {
        $column = Column::make('Name');

        $this->assertSame(\Illuminate\Support\Str::slug($column->getTitle()), $column->getSlug());

        $column->setCustomSlug('test123');

        $this->assertSame(\Illuminate\Support\Str::slug('test123'), $column->getSlug());
    }

    public function test_can_check_if_column_label_should_be_shown(): void
    {
        $column = Column::make('ID', 'id');

        $this->assertTrue($column->getColumnLabelStatus());

        $column2 = Column::make('ID', 'id')
            ->setColumnLabelStatusDisabled()
            ->footer(fn ($rows) => 'Hi');

        $this->assertFalse($column2->getColumnLabelStatus());

        $column3 = Column::make('ID', 'id')
            ->setColumnLabelStatusEnabled()
            ->footer(fn ($rows) => 'Hi');

        $this->assertTrue($column3->getColumnLabelStatus());
        $this->assertFalse($column2->getColumnLabelStatus());
    }

    public function test_can_check_if_column_label_has_attributes(): void
    {
        $column = Column::make('ID', 'id');

        $this->assertFalse($column->hasLabelAttributes());

        $column->setLabelAttributes(['class' => 'text-xl']);

        $this->assertTrue($column->hasLabelAttributes());

        $this->assertSame(['class' => 'text-xl', 'default' => false, 'default-colors' => false, 'default-styling' => false], $column->getLabelAttributes());

        $column->setLabelAttributes(['class' => 'text-xl', 'default' => true]);

        $this->assertSame(['class' => 'text-xl', 'default' => true, 'default-colors' => false, 'default-styling' => false], $column->getLabelAttributes());

    }

    public function test_throws_error_if_no_columns_are_defined(): void
    {
        $this->expectException(NoColumnsException::class);

        $testTable = new class extends PetsTable
        {
            public function columns(): array
            {
                return [];
            }
        };
        $testTable->mountManagesFilters();
        $testTable->configure();
        $testTable->boot();
        $testTable->bootedComponentUtilities();
        $testTable->bootedManagesFilters();
        $testTable->bootedWithColumns();
        $testTable->bootedWithColumnSelect();
        $testTable->bootedWithSecondaryHeader();
        $testTable->booted();

    }
}
