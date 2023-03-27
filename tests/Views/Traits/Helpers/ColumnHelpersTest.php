<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Traits\Helpers;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ColumnHelpersTest extends TestCase
{
    /** @test */
    public function can_get_column_from(): void
    {
        $column = Column::make('Name');

        $this->assertNull($column->getFrom());

        $column = Column::make('Name', 'name');

        $this->assertSame('name', $column->getFrom());
    }

    /** @test */
    public function can_check_if_column_has_from(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->hasFrom());

        $column = Column::make('Name', 'name');

        $this->assertTrue($column->hasFrom());
    }

    /** @test */
    public function can_get_column_title(): void
    {
        $column = Column::make('Name');

        $this->assertSame('Name', $column->getTitle());
    }

    /** @test */
    public function can_get_column_field(): void
    {
        $column = Column::make('Name', 'name');

        $this->assertSame('name', $column->getField());
    }

    /** @test */
    public function can_check_if_column_has_field(): void
    {
        $column = Column::make('Name', 'name');

        $this->assertTrue($column->hasField());

        $column->label(fn () => 'Name');

        $this->assertFalse($column->hasField());
    }

    /** @test */
    public function can_remove_field_with_label(): void
    {
        $column = Column::make('My Title', 'my_title')->label(fn () => 'My Label');

        $this->assertNull($column->getFrom());
        $this->assertNull($column->getField());
    }

    /** @test */
    public function can_check_if_column_is_label(): void
    {
        $column = Column::make('My Title');

        $this->assertFalse($column->isLabel());

        $column->label(fn () => 'My Label');

        $this->assertTrue($column->isLabel());
    }

    /** @test */
    public function can_check_if_column_should_collapse_on_mobile(): void
    {
        $column = Column::make('My Title');

        $this->assertFalse($column->shouldCollapseOnMobile());

        $column->collapseOnMobile();

        $this->assertTrue($column->shouldCollapseOnMobile());
    }

    /** @test */
    public function can_check_if_column_should_collapse_on_tablet(): void
    {
        $column = Column::make('My Title');

        $this->assertFalse($column->shouldCollapseOnTablet());

        $column->collapseOnTablet();

        $this->assertTrue($column->shouldCollapseOnTablet());
    }

    /** @test */
    public function can_set_custom_sorting_pill_title(): void
    {
        $column = Column::make('My Title');

        $this->assertNull($column->getCustomSortingPillTitle());

        $column->setSortingPillTitle('New Title');

        $this->assertSame('New Title', $column->getCustomSortingPillTitle());
    }

    /** @test */
    public function can_set_custom_sorting_pill_directions(): void
    {
        $column = Column::make('My Title');

        $this->assertFalse($column->hasCustomSortingPillDirections());

        $column->setSortingPillDirections('1-2', '2-1');

        $this->assertTrue($column->hasCustomSortingPillDirections());
        $this->assertSame('1-2', $column->getCustomSortingPillDirections('asc'));
        $this->assertSame('2-1', $column->getCustomSortingPillDirections('desc'));
    }

    /** @test */
    public function can_check_if_field_is_relation(): void
    {
        $column = Column::make('My Title');

        $this->assertCount(0, $column->getRelations());

        $column = Column::make('Address', 'address.group.name');

        $this->assertCount(2, $column->getRelations());
    }

    /** @test */
    public function can_check_if_column_is_same_by_field(): void
    {
        $column = Column::make('My Title');

        $this->assertTrue($column->isField('my_title'));
        $this->assertFalse($column->isField('name'));
    }

    /** @test */
    public function can_check_if_column_is_sortable(): void
    {
        $column = Column::make('My Title');

        $this->assertFalse($column->isSortable());

        $column->sortable();

        $this->assertTrue($column->isSortable());

        $column->label(fn () => 'My Label');

        $this->assertFalse($column->isSortable());
    }

    /** @test */
    public function can_check_if_column_has_a_sort_callback(): void
    {
        $column = Column::make('My Title')->sortable();

        $this->assertFalse($column->hasSortCallback());

        $column = Column::make('My Title')->sortable(function (Builder $builder, string $direction) {
            return $builder->orderBy('name', $direction);
        });

        $this->assertTrue($column->hasSortCallback());
    }

    /** @test */
    public function can_get_column_sort_callback(): void
    {
        $column = Column::make('My Title')->sortable();

        $this->assertNull($column->getSortCallback());

        $column = Column::make('My Title')->sortable(function (Builder $builder, string $direction) {
            return $builder->orderBy('name', $direction);
        });

        $this->assertIsCallable($column->getSortCallback());
    }

    /** @test */
    public function can_get_column_table(): void
    {
        $column = Column::make('My Title');

        $this->assertNull($column->getTable());

        $column->setTable('users');

        $this->assertSame('users', $column->getTable());
    }

    /** @test */
    public function can_get_full_column_name(): void
    {
        $column = Column::make('Name', 'name');

        $column->setTable('users');

        $this->assertSame('users.name', $column->getColumn());

        $column = Column::make('Address Group', 'address.group.name');

        $column->setTable('addresses');

        $this->assertSame('addresses.name', $column->getColumn());
    }

    /** @test */
    public function can_get_full_column_select_name(): void
    {
        $column = Column::make('Name', 'name');

        $column->setTable('users');

        $this->assertSame('name', $column->getColumnSelectName());

        $column = Column::make('Address Group', 'address.group.name');

        $column->setTable('addresses');

        $this->assertSame('address.group.name', $column->getColumnSelectName());
    }

    /** @test */
    public function can_check_if_column_matches_column_name(): void
    {
        $column = Column::make('Name', 'name');
        $column->setTable('users');

        $this->assertTrue($column->isColumn('users.name'));
        $this->assertFalse($column->isColumn('name'));

        $column = Column::make('Address Group', 'address.group.name');
        $column->setTable('addresses');

        $this->assertTrue($column->isColumn('addresses.name'));
        $this->assertFalse($column->isColumn('address.group.name'));
    }

    /** @test */
    public function can_check_if_column_matches_column_select(): void
    {
        $column = Column::make('Name', 'name');
        $column->setTable('users');

        $this->assertTrue($column->isColumnBySelectName('name'));
        $this->assertFalse($column->isColumnBySelectName('users.name'));

        $column = Column::make('Address Group', 'address.group.name');
        $column->setTable('addresses');

        $this->assertTrue($column->isColumnBySelectName('address.group.name'));
        $this->assertFalse($column->isColumnBySelectName('addresses.name'));
    }

    /** @test */
    public function can_check_if_eager_loading_relations_is_enabled(): void
    {
        $column = Column::make('My Title');

        $this->assertFalse($column->eagerLoadRelationsIsEnabled());

        $column->eagerLoadRelations();

        $this->assertTrue($column->eagerLoadRelationsIsEnabled());
    }

    /** @test */
    public function can_get_colspan_count(): void
    {
        $this->basicTable->setBulkActionsDisabled();

        $this->assertEquals(6, $this->basicTable->getColspanCount());

        // TODO: Not working
//        $this->basicTable->setReorderEnabled();
//        $this->basicTable->setHideBulkActionsWhenEmptyEnabled();
//
//        $this->assertEquals(5, $this->basicTable->getColspanCount());
//
//        $this->basicTable->setCurrentlyReorderingEnabled();
//
//        $this->assertEquals(6, $this->basicTable->getColspanCount());
//
//        $this->basicTable->setBulkActionsEnabled();
//
//        $this->assertEquals(7, $this->basicTable->getColspanCount());
    }

    /** @test */
    public function can_get_column_formatter(): void
    {
        $column = Column::make('Name');

        $this->assertFalse($column->hasFormatter());
        $this->assertNull($column->getFormatCallback());

        $column->format(fn ($value) => $value);

        $this->assertInstanceOf(Closure::class, $column->getFormatCallback());
    }

    /** @test */
    public function can_check_if_column_has_secondary_header(): void
    {
        $column = Column::make('ID', 'id');

        $this->assertFalse($column->hasSecondaryHeader());
        $this->assertFalse($column->hasSecondaryHeaderCallback());

        $column = Column::make('ID', 'id')
            ->secondaryHeader(fn ($rows) => 'Hi');

        $this->assertTrue($column->hasSecondaryHeader());
        $this->assertTrue($column->hasSecondaryHeaderCallback());
        $this->assertIsCallable($column->getSecondaryHeaderCallback());
        $this->assertSame('Hi', $column->getSecondaryHeaderContents([]));
    }

    /** @test */
    public function can_check_if_column_has_footer(): void
    {
        $column = Column::make('ID', 'id');

        $this->assertFalse($column->hasFooter());
        $this->assertFalse($column->hasFooterCallback());

        $column = Column::make('ID', 'id')
            ->footer(fn ($rows) => 'Hi');

        $this->assertTrue($column->hasFooter());
        $this->assertTrue($column->hasFooterCallback());
        $this->assertIsCallable($column->getFooterCallback());
        $this->assertSame('Hi', $column->getFooterContents([]));
    }
}
