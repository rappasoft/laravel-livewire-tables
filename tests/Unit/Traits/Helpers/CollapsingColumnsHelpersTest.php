<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Exceptions\NoColumnsException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

final class CollapsingColumnsHelpersTest extends TestCase
{
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

    public function test_can_get_collapsed_columns_for_content(): void
    {
        $this->assertCount(0, $this->basicTable->getCollapsedMobileColumns());
        $this->assertCount(0, $this->basicTable->getCollapsedTabletColumns());

        $this->basicTable->getColumnBySelectName('id')->collapseOnMobile();
        $this->basicTable->getColumnBySelectName('name')->collapseOnTablet();
        $this->basicTable->getColumnBySelectName('age')->collapseAlways();
        $this->basicTable->unsetCollapsedStatuses();

        $this->assertCount(1, $this->basicTable->getCollapsedMobileColumns());
        $this->assertCount(1, $this->basicTable->getCollapsedTabletColumns());
        $this->assertCount(1, $this->basicTable->getCollapsedAlwaysColumns());

        $this->assertSame(3, $this->basicTable->getCollapsedColumnsForContent()->count());

        $this->assertSame('ID', $this->basicTable->getCollapsedColumnsForContent()->first()->getTitle());
        $this->assertSame('Age', $this->basicTable->getCollapsedColumnsForContent()->last()->getTitle());
        $this->assertSame('Name', $this->basicTable->getCollapsedColumnsForContent()->slice(1)->first()->getTitle());

    }
}
