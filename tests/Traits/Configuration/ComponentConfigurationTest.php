<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ComponentConfigurationTest extends TestCase
{
    /** @test */
    public function initial_wrapper_attributes_get_set(): void
    {
        $this->assertSame(['id' => 'datatable-'.$this->basicTable->id], $this->basicTable->getComponentWrapperAttributes());

        $this->basicTable->setComponentWrapperAttributes(['this' => 'that']);

        $this->assertSame($this->basicTable->getComponentWrapperAttributes(), ['this' => 'that']);
    }

    /** @test */
    public function can_set_table_wrapper_attributes(): void
    {
        $this->assertSame($this->basicTable->getTableWrapperAttributes(), ['default' => true]);

        $this->basicTable->setTableWrapperAttributes(['this' => 'that']);

        $this->assertSame($this->basicTable->getTableWrapperAttributes(), ['this' => 'that']);
    }

    /** @test */
    public function can_set_table_attributes(): void
    {
        $this->assertSame($this->basicTable->getTableAttributes(), ['default' => true]);

        $this->basicTable->setTableAttributes(['this' => 'that']);

        $this->assertSame($this->basicTable->getTableAttributes(), ['this' => 'that']);
    }

    /** @test */
    public function can_set_thead_attributes(): void
    {
        $this->assertSame($this->basicTable->getTheadAttributes(), ['default' => true]);

        $this->basicTable->setTheadAttributes(['this' => 'that']);

        $this->assertSame($this->basicTable->getTheadAttributes(), ['this' => 'that']);
    }

    /** @test */
    public function can_set_tbody_attributes(): void
    {
        $this->assertSame($this->basicTable->getTbodyAttributes(), ['default' => true]);

        $this->basicTable->setTbodyAttributes(['this' => 'that']);

        $this->assertSame($this->basicTable->getTbodyAttributes(), ['this' => 'that']);
    }

    /** @test */
    public function can_set_th_attributes(): void
    {
        $this->basicTable->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return ['default' => false, 'this' => 'that'];
            }

            return ['default' => true, 'here' => 'there'];
        });

        $this->assertSame($this->basicTable->getThAttributes($this->basicTable->columns()[0]), ['default' => false, 'this' => 'that']);
        $this->assertSame($this->basicTable->getThAttributes($this->basicTable->columns()[1]), ['default' => true, 'here' => 'there']);
    }

    /** @test */
    public function can_set_tr_attributes(): void
    {
        $this->basicTable->setTrAttributes(function (Model $row, $index) {
            if ($index === 0) {
                return ['default' => false, 'this' => 'that'];
            }

            return ['default' => true, 'here' => 'there'];
        });

        $this->assertSame($this->basicTable->getTrAttributes(Pet::find(1), 0), ['default' => false, 'this' => 'that']);
        $this->assertSame($this->basicTable->getTrAttributes(Pet::find(2), 1), ['default' => true, 'here' => 'there']);
    }

    /** @test */
    public function can_set_td_attributes(): void
    {
        $this->basicTable->setTdAttributes(function (Column $column, Model $row, $index) {
            if ($column->isField('id') && $index === 1) {
                return ['default' => false, 'this' => 'that'];
            }

            return ['default' => true, 'here' => 'there'];
        });

        $this->assertSame($this->basicTable->getTdAttributes($this->basicTable->columns()[1], Pet::find(1), 0, 1), ['default' => true, 'here' => 'there']);
        $this->assertSame($this->basicTable->getTdAttributes($this->basicTable->columns()[0], Pet::find(2), 1, 1), ['default' => false, 'this' => 'that']);
    }

    /** @test */
    public function can_set_empty_message(): void
    {
        $this->basicTable->setEmptyMessage('My empty message');

        $this->assertEquals('My empty message', $this->basicTable->getEmptyMessage());
    }

    /** @test */
    public function can_set_offline_indicator_status(): void
    {
        $this->assertTrue($this->basicTable->getOfflineIndicatorStatus());

        $this->basicTable->setOfflineIndicatorStatus(false);

        $this->assertFalse($this->basicTable->getOfflineIndicatorStatus());

        $this->basicTable->setOfflineIndicatorStatus(true);

        $this->assertTrue($this->basicTable->getOfflineIndicatorStatus());

        $this->basicTable->setOfflineIndicatorDisabled();

        $this->assertFalse($this->basicTable->getOfflineIndicatorStatus());

        $this->basicTable->setOfflineIndicatorEnabled();

        $this->basicTable->setOfflineIndicatorStatus(true);
    }

    /** @test */
    public function can_set_default_sorting_labels(): void
    {
        $this->assertSame('A-Z', $this->basicTable->getDefaultSortingLabelAsc());
        $this->assertSame('Z-A', $this->basicTable->getDefaultSortingLabelDesc());

        $this->basicTable->setDefaultSortingLabels('1-2', '2-1');

        $this->assertSame('1-2', $this->basicTable->getDefaultSortingLabelAsc());
        $this->assertSame('2-1', $this->basicTable->getDefaultSortingLabelDesc());
    }

    /** @test */
    public function can_set_query_string_status(): void
    {
        $this->assertTrue($this->basicTable->getQueryStringStatus());

        $this->basicTable->setQueryStringStatus(false);

        $this->assertFalse($this->basicTable->getQueryStringStatus());

        $this->basicTable->setQueryStringStatus(true);

        $this->assertTrue($this->basicTable->getQueryStringStatus());

        $this->basicTable->setQueryStringDisabled();

        $this->assertFalse($this->basicTable->getQueryStringStatus());

        $this->basicTable->setQueryStringEnabled();

        $this->assertTrue($this->basicTable->getQueryStringStatus());
    }

    /** @test */
    public function can_set_eager_load_relations_status(): void
    {
        $this->assertFalse($this->basicTable->getEagerLoadAllRelationsStatus());

        $this->basicTable->setEagerLoadAllRelationsStatus(true);

        $this->assertTrue($this->basicTable->getEagerLoadAllRelationsStatus());

        $this->basicTable->setEagerLoadAllRelationsStatus(false);

        $this->assertFalse($this->basicTable->getEagerLoadAllRelationsStatus());

        $this->basicTable->setEagerLoadAllRelationsEnabled();

        $this->assertTrue($this->basicTable->getEagerLoadAllRelationsStatus());

        $this->basicTable->setEagerLoadAllRelationsDisabled();

        $this->assertFalse($this->basicTable->getEagerLoadAllRelationsStatus());
    }

    /** @test */
    public function can_set_collapsing_columns_status(): void
    {
        $this->assertTrue($this->basicTable->getCollapsingColumnsStatus());

        $this->basicTable->setCollapsingColumnsStatus(false);

        $this->assertFalse($this->basicTable->getCollapsingColumnsStatus());

        $this->basicTable->setCollapsingColumnsStatus(true);

        $this->assertTrue($this->basicTable->getCollapsingColumnsStatus());

        $this->basicTable->setCollapsingColumnsDisabled();

        $this->assertFalse($this->basicTable->getCollapsingColumnsStatus());

        $this->basicTable->setCollapsingColumnsEnabled();

        $this->assertTrue($this->basicTable->getCollapsingColumnsStatus());
    }

    /** @test */
    public function can_set_tr_url(): void
    {
        $this->assertNull($this->basicTable->getTableRowUrl(1));

        $this->basicTable->setTableRowUrl(function ($row) {
            return 'https://example.com';
        });

        $this->assertSame($this->basicTable->getTableRowUrl(1), 'https://example.com');
    }

    /** @test */
    public function can_set_tr_url_target(): void
    {
        $this->assertNull($this->basicTable->getTableRowUrlTarget(1));

        $this->basicTable->setTableRowUrlTarget(function ($row) {
            return '_blank';
        });

        $this->assertSame($this->basicTable->getTableRowUrlTarget(1), '_blank');
    }
}
