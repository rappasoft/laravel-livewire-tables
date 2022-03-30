<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class SortingHelpersTest extends TestCase
{
    /** @test */
    public function can_get_sorting_status(): void
    {
        $this->assertTrue($this->basicTable->sortingIsEnabled());

        $this->basicTable->setSortingDisabled();

        $this->assertTrue($this->basicTable->sortingIsDisabled());
    }

    /** @test */
    public function can_get_single_sorting_status(): void
    {
        $this->assertTrue($this->basicTable->singleSortingIsEnabled());

        $this->basicTable->setSingleSortingDisabled();

        $this->assertTrue($this->basicTable->singleSortingIsDisabled());
    }

    /** @test */
    public function can_set_sorts_array(): void
    {
        $this->basicTable->setSorts(['id' => 'asc', 'name' => 'desc']);

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'asc', 'name' => 'desc']);
    }

    /** @test */
    public function can_get_sorts_array(): void
    {
        $this->basicTable->setSorts(['id' => 'asc', 'name' => 'desc']);

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'asc', 'name' => 'desc']);
    }

    /** @test */
    public function can_get_single_sort_by_field(): void
    {
        $this->basicTable->setSorts(['id' => 'asc']);

        $this->assertSame($this->basicTable->getSort('id'), 'asc');
        $this->assertNull($this->basicTable->getSort('name'));
    }

    /** @test */
    public function can_set_single_sort_by_field_and_direction(): void
    {
        $this->assertEmpty($this->basicTable->getSorts());

        $this->basicTable->setSort('id', 'asc');
        $this->basicTable->setSort('name', 'desc');

        $this->assertSame($this->basicTable->getSorts(), ['id' => 'asc', 'name' => 'desc']);
    }

    /** @test */
    public function can_check_if_any_sorts(): void
    {
        $this->basicTable->setSorts(['id' => 'asc', 'name' => 'desc']);

        $this->assertTrue($this->basicTable->hasSorts());

        $this->basicTable->clearSorts();

        $this->assertFalse($this->basicTable->hasSorts());
    }

    /** @test */
    public function can_check_single_sort_by_field(): void
    {
        $this->basicTable->setSorts(['id' => 'asc']);

        $this->assertTrue($this->basicTable->hasSort('id'));
        $this->assertFalse($this->basicTable->hasSort('name'));
    }

    /** @test */
    public function can_clear_sorts_array(): void
    {
        $this->basicTable->setSorts(['id' => 'asc', 'name' => 'desc']);

        $this->assertTrue($this->basicTable->hasSorts());

        $this->basicTable->clearSorts();

        $this->assertFalse($this->basicTable->hasSorts());
    }

    /** @test */
    public function can_clear_single_sort_by_field(): void
    {
        $this->basicTable->setSorts(['id' => 'asc', 'name' => 'desc']);

        $this->assertTrue($this->basicTable->hasSort('id'));

        $this->basicTable->clearSort('id');

        $this->assertFalse($this->basicTable->hasSort('id'));
    }

    /** @test */
    public function can_set_sort_field_asc(): void
    {
        $this->basicTable->setSorts(['id' => 'desc']);

        $this->assertSame($this->basicTable->getSort('id'), 'desc');

        $this->basicTable->setSortAsc('id');

        $this->assertSame($this->basicTable->getSort('id'), 'asc');
    }

    /** @test */
    public function can_set_sort_field_desc(): void
    {
        $this->basicTable->setSorts(['id' => 'asc']);

        $this->assertSame($this->basicTable->getSort('id'), 'asc');

        $this->basicTable->setSortDesc('id');

        $this->assertSame($this->basicTable->getSort('id'), 'desc');
    }

    /** @test */
    public function can_check_if_sort_field_currently_asc(): void
    {
        $this->basicTable->setSorts(['id' => 'asc']);

        $this->assertTrue($this->basicTable->isSortAsc('id'));
        $this->assertFalse($this->basicTable->isSortDesc('id'));
    }

    /** @test */
    public function can_check_if_sort_field_currently_desc(): void
    {
        $this->basicTable->setSorts(['id' => 'desc']);

        $this->assertTrue($this->basicTable->isSortDesc('id'));
        $this->assertFalse($this->basicTable->isSortAsc('id'));
    }

    /** @test */
    public function can_check_default_sort_status(): void
    {
        $this->assertFalse($this->basicTable->hasDefaultSort());

        $this->basicTable->setDefaultSort('id');

        $this->assertTrue($this->basicTable->hasDefaultSort());
    }

    /** @test */
    public function can_get_sorting_pills_status(): void
    {
        $this->assertTrue($this->basicTable->sortingPillsAreEnabled());

        $this->basicTable->setSortingPillsDisabled();

        $this->assertTrue($this->basicTable->sortingPillsAreDisabled());

        $this->basicTable->setSortingPillsEnabled();

        $this->assertTrue($this->basicTable->sortingPillsAreEnabled());
    }
}
