<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class WithSortingTest extends TestCase
{
    /** @test */
    public function cannot_call_sortBy_if_sorting_is_disabled(): void
    {
        $sort = $this->basicTable->sortBy('id');

        $this->assertSame($sort, 'asc');

        $this->basicTable->setSortingDisabled();

        $sort = $this->basicTable->sortBy('id');

        $this->assertNull($sort);
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
        $this->assertTrue(true);
    }
}
