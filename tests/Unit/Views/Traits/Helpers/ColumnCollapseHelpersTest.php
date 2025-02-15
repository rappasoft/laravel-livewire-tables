<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Traits\Helpers;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;

#[Group('Columns')]
final class ColumnCollapseHelpersTest extends TestCase
{
    public function test_can_check_if_column_should_collapse_on_mobile(): void
    {
        $column = Column::make('My Title');

        $this->assertFalse($column->shouldCollapseOnMobile());
        $this->assertFalse($column->shouldCollapseSometimes());
        $this->assertTrue($column->shouldNeverCollapse());
        $this->assertTrue($column->shouldCollapseNever());

        $column->collapseOnMobile();

        $this->assertTrue($column->shouldCollapseOnMobile());
        $this->assertTrue($column->shouldCollapseSometimes());
        $this->assertFalse($column->shouldNeverCollapse());
        $this->assertFalse($column->shouldCollapseNever());

    }

    public function test_can_check_if_column_should_collapse_on_tablet(): void
    {
        $column = Column::make('My Title');

        $this->assertFalse($column->shouldCollapseOnTablet());
        $this->assertFalse($column->shouldCollapseSometimes());
        $this->assertTrue($column->shouldNeverCollapse());
        $this->assertTrue($column->shouldCollapseNever());

        $column->collapseOnTablet();

        $this->assertTrue($column->shouldCollapseOnTablet());
        $this->assertTrue($column->shouldCollapseSometimes());
        $this->assertFalse($column->shouldNeverCollapse());
        $this->assertFalse($column->shouldCollapseNever());

    }

    public function test_can_check_if_column_should_collapse_always(): void
    {
        $column = Column::make('My Title');

        $this->assertFalse($column->shouldCollapseAlways());
        $this->assertFalse($column->shouldCollapseSometimes());
        $this->assertTrue($column->shouldNeverCollapse());
        $this->assertTrue($column->shouldCollapseNever());

        $column->collapseAlways();

        $this->assertTrue($column->shouldCollapseAlways());
        $this->assertTrue($column->shouldCollapseSometimes());
        $this->assertFalse($column->shouldNeverCollapse());
        $this->assertFalse($column->shouldCollapseNever());

    }
}
