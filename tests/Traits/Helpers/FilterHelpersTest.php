<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

class FilterHelpersTest extends TestCase
{
    /** @test */
    public function can_get_filters_status(): void
    {
        $this->assertTrue($this->basicTable->filtersAreEnabled());

        $this->basicTable->setFiltersDisabled();

        $this->assertTrue($this->basicTable->filtersAreDisabled());

        $this->basicTable->setFiltersEnabled();

        $this->assertTrue($this->basicTable->filtersAreEnabled());
    }

    /** @test */
    public function can_get_filters_visibility_status(): void
    {
        $this->assertTrue($this->basicTable->filtersVisibilityIsEnabled());

        $this->basicTable->setFiltersVisibilityDisabled();

        $this->assertTrue($this->basicTable->filtersVisibilityIsDisabled());

        $this->basicTable->setFiltersVisibilityEnabled();

        $this->assertTrue($this->basicTable->filtersVisibilityIsEnabled());
    }

    /** @test */
    public function can_get_filter_pills_status(): void
    {
        $this->assertTrue($this->basicTable->filterPillsAreEnabled());

        $this->basicTable->setFilterPillsDisabled();

        $this->assertTrue($this->basicTable->filterPillsAreDisabled());

        $this->basicTable->setFilterPillsEnabled();

        $this->assertTrue($this->basicTable->filterPillsAreEnabled());
    }

    /** @test */
    public function can_check_if_component_has_filters(): void
    {
        $this->assertTrue($this->basicTable->hasFilters());
    }

    /** @test */
    public function can_get_component_filters(): void
    {
        $this->assertInstanceOf(MultiSelectFilter::class, $this->basicTable->getFilters()[0]);
    }

    /** @test */
    public function can_get_component_filter_count(): void
    {
        $this->assertEquals(1, $this->basicTable->getFiltersCount());
    }

    /** @test */
    public function can_get_component_filter_by_key(): void
    {
        $this->assertNotInstanceOf(MultiSelectFilter::class, $this->basicTable->getFilterByKey('test'));

        $this->assertInstanceOf(MultiSelectFilter::class, $this->basicTable->getFilterByKey('breed'));
    }

    /** @test */
    public function can_set_filter_value(): void
    {
        $this->basicTable->setFilter('breed', ['1']);

        $this->assertSame(['1'], $this->basicTable->getAppliedFilterWithValue('breed'));
    }

    /** @test */
    public function can_select_all_filter_options(): void
    {
        $this->basicTable->selectAllFilterOptions('breed');

        $this->assertSame([
            1,
            200,
            100,
            201,
            101,
            2,
            202,
            4,
            3,
            102,
        ], $this->basicTable->getAppliedFilterWithValue('breed'));
    }

    /** @test */
    public function can_set_filter_defaults(): void
    {
        $this->basicTable->setFilter('breed', ['1']);

        $this->assertSame(['1'], $this->basicTable->getAppliedFilterWithValue('breed'));

        $this->basicTable->setFilterDefaults();

        $this->assertSame(['breed' => []], $this->basicTable->getAppliedFilters());
    }

    /** @test */
    public function can_see_if_filters_set_with_values(): void
    {
        $this->assertFalse($this->basicTable->hasAppliedFiltersWithValues());

        $this->basicTable->setFilter('breed', ['1']);

        $this->assertTrue($this->basicTable->hasAppliedFiltersWithValues());
    }

    /** @test */
    public function can_get_all_applied_filters_with_values(): void
    {
        $this->basicTable->setFilter('breed', ['1']);

        $this->assertSame(['breed' => ['1']], $this->basicTable->getAppliedFiltersWithValues());
    }

    /** @test */
    public function can_get_all_applied_filters_with_values_count(): void
    {
        $this->assertSame(0, $this->basicTable->getAppliedFiltersWithValuesCount());

        $this->basicTable->setFilter('breed', ['1']);

        $this->assertSame(1, $this->basicTable->getAppliedFiltersWithValuesCount());
    }

    /** @test */
    public function can_check_if_filter_layout_is_popover(): void
    {
        $this->assertTrue($this->basicTable->isFilterLayoutPopover());
    }

    /** @test */
    public function can_check_if_filter_layout_is_slidedown(): void
    {
        $this->assertFalse($this->basicTable->isFilterLayoutSlideDown());

        $this->basicTable->setFilterLayoutSlideDown();

        $this->assertTrue($this->basicTable->isFilterLayoutSlideDown());
    }
}
