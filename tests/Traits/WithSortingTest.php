<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class WithSortingTest extends TestCase
{
    /** @test */
    public function cannot_call_sortBy_if_sorting_is_disabled(): void
    {
        $this->assertSame($this->basicTable->sortBy('id'), 'asc');

        $this->basicTable->setSortingDisabled();

        $this->assertNull($this->basicTable->sortBy('id'));
    }

    /** @test */
    public function clear_sorts_if_single_sorting_and_setting_not_current_field(): void
    {
        $this->basicTable->setSingleSortingDisabled();

        $this->basicTable->sortBy('id');
        $this->basicTable->sortBy('name');

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'asc', 'name' => 'asc']);

        $this->basicTable->clearSorts();

        $this->basicTable->setSingleSortingEnabled();

        $this->basicTable->sortBy('id');

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'asc']);

        $this->basicTable->sortBy('name');

        $this->assertSame($this->basicTable->getSorts(), ['name' => 'asc']);
    }

    /** @test */
    public function set_sort_asc_if_not_set(): void
    {
        $this->assertFalse($this->basicTable->hasSort('id'));

        $this->basicTable->sortBy('id');

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'asc']);
    }

    /** @test */
    public function set_sort_desc_if_currently_asc(): void
    {
        $this->basicTable->setSort('id', 'asc');

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'asc']);

        $this->basicTable->sortBy('id');

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'desc']);
    }

    /** @test */
    public function remove_sort_if_currently_desc(): void
    {
        $this->basicTable->setSort('id', 'desc');

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'desc']);

        $this->basicTable->sortBy('id');

        $this->assertFalse($this->basicTable->hasSort('id'));
    }

    /** @test */
    public function sort_callback_gets_applied_if_specified(): void
    {
        // TODO
        $this->basicTable->clearSorts();
        $this->basicTable->sortBy('breed.name');
        $this->assertSame($this->basicTable->getSorts(), ['breed.name' => 'asc']);
    }

    /** @test */
    public function sort_callback_gets_applied_if_specified_on_aliased_column(): void
    {
        // TODO
        $this->basicTableWithAlias->clearSorts();
        $this->basicTableWithAlias->sortBy('my_breed');
        $this->assertSame($this->basicTableWithAlias->getSorts(), ['my_breed' => 'asc']);
    }

    /** @test */
    public function cannot_set_sort_on_unsortable_column(): void
    {
        $this->basicTable->clearSorts();

        $this->assertFalse($this->basicTable->hasSort('age'));

        $this->basicTable->sortBy('age');

        $this->basicTable->applySorting();

        $this->assertStringNotContainsStringIgnoringCase('order by', $this->basicTable->getBuilder()->toSql());
    }

    /** @test */
    public function cannot_set_sort_using_from_name_when_using_alias(): void
    {
        $this->basicTableWithAlias->clearSorts();
        $this->basicTableWithAlias->sortBy('age');
        $this->basicTableWithAlias->applySorting();

        $this->assertStringNotContainsStringIgnoringCase('order by', $this->basicTableWithAlias->getBuilder()->toSql());
    }

    /** @test */
    public function sort_applies_to_query(): void
    {
        $this->basicTable->sortBy('id');

        $this->basicTable->applySorting();

        $this->assertStringContainsStringIgnoringCase('order by "id"', $this->basicTable->getBuilder()->toSql());
    }

    /** @test */
    public function sort_applies_to_query_with_alias(): void
    {
        $this->basicTableWithAlias->sortBy('my_id');

        $this->basicTableWithAlias->applySorting();

        $this->assertStringContainsStringIgnoringCase('order by "id"', $this->basicTableWithAlias->getBuilder()->toSql());
    }
}
