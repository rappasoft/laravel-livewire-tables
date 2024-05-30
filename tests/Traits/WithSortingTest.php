<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class WithSortingTest extends TestCase
{
    public function test_cannot_call_sortBy_if_sorting_is_disabled(): void
    {
        $this->assertSame($this->basicTable->sortBy('id'), 'asc');

        $this->basicTable->setSortingDisabled();

        $this->assertNull($this->basicTable->sortBy('id'));
    }

    public function test_clear_sorts_if_single_sorting_and_setting_not_current_field(): void
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

    public function test_set_sort_asc_if_not_set(): void
    {
        $this->assertFalse($this->basicTable->hasSort('id'));

        $this->basicTable->sortBy('id');

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'asc']);
    }

    public function test_set_sort_desc_if_currently_asc(): void
    {
        $this->basicTable->setSort('id', 'asc');

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'asc']);

        $this->basicTable->sortBy('id');

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'desc']);
    }

    public function test_remove_sort_if_currently_desc(): void
    {
        $this->basicTable->setSort('id', 'desc');

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'desc']);

        $this->basicTable->sortBy('id');

        $this->assertFalse($this->basicTable->hasSort('id'));
    }

    public function test_sort_callback_gets_applied_if_specified(): void
    {
        // TODO
        $this->basicTable->clearSorts();
        $this->basicTable->sortBy('breed.name');
        $this->assertSame($this->basicTable->getSorts(), ['breed.name' => 'asc']);
    }

    public function test_cannot_set_sort_on_unsortable_column(): void
    {
        $this->basicTable->clearSorts();

        $this->assertFalse($this->basicTable->hasSort('age'));

        $this->basicTable->sortBy('age');

        $this->basicTable->applySorting();

        $this->assertStringNotContainsStringIgnoringCase('order by', $this->basicTable->getBuilder()->toSql());
    }

    public function test_sort_applies_to_query(): void
    {
        $this->basicTable->sortBy('id');

        $this->basicTable->applySorting();

        $this->assertStringContainsStringIgnoringCase('order by "id"', $this->basicTable->getBuilder()->toSql());
    }
}
