<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;

final class ComponentConfigurationTest extends TestCase
{
    public function test_initial_wrapper_attributes_get_set(): void
    {
        $this->assertSame(['id' => 'datatable-'.$this->basicTable->getId()], $this->basicTable->getComponentWrapperAttributes());

        $this->basicTable->setComponentWrapperAttributes(['this' => 'that']);

        $this->assertSame($this->basicTable->getComponentWrapperAttributes(), ['this' => 'that']);
    }

    public function test_can_set_table_wrapper_attributes(): void
    {
        $this->assertSame($this->basicTable->getTableWrapperAttributes(), ['default' => true]);

        $this->basicTable->setTableWrapperAttributes(['this' => 'that']);

        $this->assertSame($this->basicTable->getTableWrapperAttributes(), ['this' => 'that']);
    }

    public function test_can_set_table_attributes(): void
    {
        $this->assertSame($this->basicTable->getTableAttributes(), ['id' => 'table-'.$this->basicTable->getTableName(), 'default' => true]);

        $this->basicTable->setTableAttributes(['this' => 'that']);

        $this->assertSame($this->basicTable->getTableAttributes(), ['id' => 'table-'.$this->basicTable->getTableName(), 'this' => 'that']);
    }

    public function test_can_override_table_default_id(): void
    {
        $this->assertSame($this->basicTable->getTableAttributes(), ['id' => 'table-'.$this->basicTable->getTableName(), 'default' => true]);

        $this->basicTable->setTableAttributes(['id' => 'newTableID', 'this' => 'that']);

        $this->assertSame($this->basicTable->getTableAttributes(), ['id' => 'newTableID', 'this' => 'that']);
    }

    public function test_can_set_thead_attributes(): void
    {
        $this->assertSame($this->basicTable->getTheadAttributes(), ['default' => true]);

        $this->basicTable->setTheadAttributes(['this' => 'that']);

        $this->assertSame($this->basicTable->getTheadAttributes(), ['this' => 'that']);
    }

    public function test_can_set_tbody_attributes(): void
    {
        $this->assertSame($this->basicTable->getTbodyAttributes(), ['default' => true]);

        $this->basicTable->setTbodyAttributes(['this' => 'that']);

        $this->assertSame($this->basicTable->getTbodyAttributes(), ['this' => 'that']);
    }

    public function test_can_set_th_attributes(): void
    {
        $this->basicTable->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return ['default' => false, 'this' => 'that'];
            }

            return ['default' => true, 'here' => 'there'];
        });

        $this->assertSame($this->basicTable->getThAttributes($this->basicTable->columns()[0]), ['scope' => 'col', 'default' => false, 'default-colors' => false, 'default-styling' => false, 'this' => 'that']);
        $this->assertSame($this->basicTable->getThAttributes($this->basicTable->columns()[1]), ['scope' => 'col', 'default' => true, 'default-colors' => false, 'default-styling' => false, 'here' => 'there']);
    }

    public function test_can_set_th_sort_button_attributes(): void
    {
        $this->basicTable->setThSortButtonAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return ['default' => false, 'this' => 'that'];
            }

            return ['default' => true, 'here' => 'there'];
        });

        $this->assertSame($this->basicTable->getThSortButtonAttributes($this->basicTable->columns()[0]), ['default' => false, 'default-colors' => false, 'default-styling' => false,  'this' => 'that']);
        $this->assertSame($this->basicTable->getThSortButtonAttributes($this->basicTable->columns()[1]), ['default' => true, 'default-colors' => false, 'default-styling' => false, 'here' => 'there']);
    }

    public function test_can_set_th_sort_icon_attributes(): void
    {
        $this->basicTable->setThSortIconAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return ['default' => false, 'this' => 'that'];
            }

            return ['default' => true, 'here' => 'there'];
        });

        $this->assertSame($this->basicTable->getThSortIconAttributes($this->basicTable->columns()[0]), ['default' => false, 'default-colors' => false, 'default-styling' => false,  'this' => 'that']);
        $this->assertSame($this->basicTable->getThSortIconAttributes($this->basicTable->columns()[1]), ['default' => true, 'default-colors' => false, 'default-styling' => false, 'here' => 'there']);
    }

    public function test_can_set_tr_attributes(): void
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

    public function test_can_set_td_attributes(): void
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

    public function test_can_set_empty_message(): void
    {
        $this->basicTable->setEmptyMessage('My empty message');

        $this->assertEquals('My empty message', $this->basicTable->getEmptyMessage());
    }

    public function test_can_set_offline_indicator_status(): void
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

    public function test_can_set_default_sorting_labels(): void
    {
        $this->assertSame('A-Z', $this->basicTable->getDefaultSortingLabelAsc());
        $this->assertSame('Z-A', $this->basicTable->getDefaultSortingLabelDesc());

        $this->basicTable->setDefaultSortingLabels('1-2', '2-1');

        $this->assertSame('1-2', $this->basicTable->getDefaultSortingLabelAsc());
        $this->assertSame('2-1', $this->basicTable->getDefaultSortingLabelDesc());
    }

    public function test_can_set_query_string_status(): void
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

    public function test_can_set_eager_load_relations_status(): void
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

    public function test_can_set_collapsing_columns_status(): void
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

    public function test_can_set_tr_url(): void
    {
        $this->assertNull($this->basicTable->getTableRowUrl(1));

        $this->basicTable->setTableRowUrl(function ($row) {
            return 'https://example.com';
        });

        $this->assertSame($this->basicTable->getTableRowUrl(1), 'https://example.com');
    }

    public function test_can_set_tr_url_advanced(): void
    {
        $this->assertNull($this->basicTable->getTableRowUrl(1));
        $this->assertNull($this->basicTable->getTableRowUrl(2));

        $this->basicTable->setTableRowUrl(function ($row) {
            if ($row == 2) {
                return 'https://example2.com';
            }

            return 'https://example.com';

        });

        $this->assertSame($this->basicTable->getTableRowUrl(1), 'https://example.com');
        $this->assertSame($this->basicTable->getTableRowUrl(2), 'https://example2.com');

    }

    public function test_can_set_tr_url_target(): void
    {
        $this->assertNull($this->basicTable->getTableRowUrlTarget(1));

        $this->basicTable->setTableRowUrlTarget(function ($row) {
            return '_blank';
        });

        $this->assertSame($this->basicTable->getTableRowUrlTarget(1), '_blank');

    }

    public function test_can_set_tr_url_target_advanced(): void
    {
        $this->assertNull($this->basicTable->getTableRowUrl(1));
        $this->assertNull($this->basicTable->getTableRowUrl(2));

        $this->basicTable->setTableRowUrlTarget(function ($row) {
            if ($row == 2) {
                return 'navigate';
            }

            return '_blank';
        });

        $this->assertSame($this->basicTable->getTableRowUrlTarget(1), '_blank');
        $this->assertSame($this->basicTable->getTableRowUrlTarget(2), 'navigate');
    }

    public function test_can_set_hide_configurable_areas_when_reordering_status(): void
    {
        $this->assertTrue($this->basicTable->getHideConfigurableAreasWhenReorderingStatus());

        $this->basicTable->setHideConfigurableAreasWhenReorderingStatus(false);

        $this->assertFalse($this->basicTable->getHideConfigurableAreasWhenReorderingStatus());

        $this->basicTable->setHideConfigurableAreasWhenReorderingStatus(true);

        $this->assertTrue($this->basicTable->getHideConfigurableAreasWhenReorderingStatus());

        $this->basicTable->setHideConfigurableAreasWhenReorderingDisabled();

        $this->assertFalse($this->basicTable->getHideConfigurableAreasWhenReorderingStatus());

        $this->basicTable->setHideConfigurableAreasWhenReorderingEnabled();

        $this->basicTable->setHideConfigurableAreasWhenReorderingStatus(true);
    }

    public function test_no_extra_withs_by_default(): void
    {
        $this->assertFalse($this->basicTable->hasExtraWiths());
        $this->assertEmpty($this->basicTable->getExtraWiths());
    }

    public function test_can_add_extra_with(): void
    {
        $this->assertFalse($this->basicTable->hasExtraWiths());
        $this->assertEmpty($this->basicTable->getExtraWiths());
        $this->basicTable->addExtraWith('user');
        $this->assertTrue($this->basicTable->hasExtraWiths());
        $this->assertSame(['user'], $this->basicTable->getExtraWiths());
    }

    public function test_can_add_extra_withs(): void
    {
        $this->assertFalse($this->basicTable->hasExtraWiths());
        $this->assertEmpty($this->basicTable->getExtraWiths());
        $this->basicTable->addExtraWiths(['user', 'pets']);
        $this->assertTrue($this->basicTable->hasExtraWiths());
        $this->assertSame(['user', 'pets'], $this->basicTable->getExtraWiths());
    }

    public function test_can_set_extra_withs(): void
    {
        $this->assertFalse($this->basicTable->hasExtraWiths());
        $this->assertEmpty($this->basicTable->getExtraWiths());
        $this->basicTable->addExtraWith('test');
        $this->assertSame(['test'], $this->basicTable->getExtraWiths());
        $this->assertTrue($this->basicTable->hasExtraWiths());
        $this->basicTable->setExtraWiths(['user', 'pets']);
        $this->assertTrue($this->basicTable->hasExtraWiths());
        $this->assertSame(['user', 'pets'], $this->basicTable->getExtraWiths());
    }

    public function test_no_extra_with_counts_by_default(): void
    {
        $this->assertFalse($this->basicTable->hasExtraWithCounts());
        $this->assertEmpty($this->basicTable->getExtraWithCounts());
    }

    public function test_can_add_extra_with_count(): void
    {
        $this->assertFalse($this->basicTable->hasExtraWithCounts());
        $this->assertEmpty($this->basicTable->getExtraWithCounts());
        $this->basicTable->addExtraWithCount('users');
        $this->assertTrue($this->basicTable->hasExtraWithCounts());
        $this->assertSame(['users'], $this->basicTable->getExtraWithCounts());
    }

    public function test_can_add_extra_with_counts(): void
    {
        $this->assertFalse($this->basicTable->hasExtraWithCounts());
        $this->assertEmpty($this->basicTable->getExtraWithCounts());
        $this->basicTable->addExtraWithCounts(['user', 'pets']);
        $this->assertTrue($this->basicTable->hasExtraWithCounts());
        $this->assertSame(['user', 'pets'], $this->basicTable->getExtraWithCounts());
    }

    public function test_can_set_extra_with_counts(): void
    {
        $this->assertFalse($this->basicTable->hasExtraWithCounts());
        $this->assertEmpty($this->basicTable->getExtraWithCounts());
        $this->basicTable->addExtraWithCount('test');
        $this->assertSame(['test'], $this->basicTable->getExtraWithCounts());
        $this->assertTrue($this->basicTable->hasExtraWithCounts());
        $this->basicTable->setExtraWithCounts(['user', 'pets']);
        $this->assertTrue($this->basicTable->hasExtraWithCounts());
        $this->assertSame(['user', 'pets'], $this->basicTable->getExtraWithCounts());
    }

    public function test_no_extra_with_sums_by_default(): void
    {
        $this->assertFalse($this->basicTable->hasExtraWithSums());
        $this->assertEmpty($this->basicTable->getExtraWithSums());
    }

    public function test_can_add_extra_with_sum(): void
    {
        $this->assertFalse($this->basicTable->hasExtraWithSums());
        $this->assertEmpty($this->basicTable->getExtraWithSums());
        $this->basicTable->addExtraWithSum('users', 'age');
        $this->assertTrue($this->basicTable->hasExtraWithSums());
        $this->assertSame([['table' => 'users', 'field' => 'age']], $this->basicTable->getExtraWithSums());
    }

    public function test_no_extra_with_avgs_by_default(): void
    {
        $this->assertFalse($this->basicTable->hasExtraWiths());
        $this->assertEmpty($this->basicTable->getExtraWiths());
    }

    public function test_can_add_extra_with_avg(): void
    {
        $this->assertFalse($this->basicTable->hasExtraWithAvgs());
        $this->assertEmpty($this->basicTable->getExtraWithAvgs());
        $this->basicTable->addExtraWithAvg('user', 'age');
        $this->assertTrue($this->basicTable->hasExtraWithAvgs());
        $this->assertSame([['table' => 'user', 'field' => 'age']], $this->basicTable->getExtraWithAvgs());
    }

    public function test_can_set_collapsing_column_button_collapse_attributes(): void
    {
        $this->assertSame(['default-styling' => true, 'default-colors' => true], $this->basicTable->getCollapsingColumnButtonCollapseAttributes());

        $this->basicTable->setCollapsingColumnButtonCollapseAttributes(['class' => 'text-blue-500']);
        $this->assertSame(['default-styling' => false, 'default-colors' => false, 'class' => 'text-blue-500'], $this->basicTable->getCollapsingColumnButtonCollapseAttributes());

        $this->basicTable->setCollapsingColumnButtonCollapseAttributes(['class' => 'text-blue-500', 'default-styling' => true]);
        $this->assertSame(['default-styling' => true, 'default-colors' => false, 'class' => 'text-blue-500'], $this->basicTable->getCollapsingColumnButtonCollapseAttributes());

        $this->basicTable->setCollapsingColumnButtonCollapseAttributes(['class' => 'text-red-500', 'default-colors' => true]);
        $this->assertSame(['default-styling' => false, 'default-colors' => true, 'class' => 'text-red-500'], $this->basicTable->getCollapsingColumnButtonCollapseAttributes());

        $this->basicTable->setCollapsingColumnButtonCollapseAttributes(['default-styling' => true, 'class' => 'text-green-500', 'default-colors' => true]);
        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => 'text-green-500'], $this->basicTable->getCollapsingColumnButtonCollapseAttributes());

        $this->assertSame(['default-styling' => true, 'default-colors' => true], $this->basicTable->getCollapsingColumnButtonExpandAttributes());
    }

    public function test_can_set_collapsing_column_button_expand_attributes(): void
    {
        $this->assertSame(['default-styling' => true, 'default-colors' => true], $this->basicTable->getCollapsingColumnButtonExpandAttributes());

        $this->basicTable->setCollapsingColumnButtonExpandAttributes(['class' => 'text-blue-500']);
        $this->assertSame(['default-styling' => false, 'default-colors' => false, 'class' => 'text-blue-500'], $this->basicTable->getCollapsingColumnButtonExpandAttributes());

        $this->basicTable->setCollapsingColumnButtonExpandAttributes(['class' => 'text-blue-500', 'default-styling' => true]);
        $this->assertSame(['default-styling' => true, 'default-colors' => false, 'class' => 'text-blue-500'], $this->basicTable->getCollapsingColumnButtonExpandAttributes());

        $this->basicTable->setCollapsingColumnButtonExpandAttributes(['class' => 'text-red-500', 'default-colors' => true]);
        $this->assertSame(['default-styling' => false, 'default-colors' => true, 'class' => 'text-red-500'], $this->basicTable->getCollapsingColumnButtonExpandAttributes());

        $this->basicTable->setCollapsingColumnButtonExpandAttributes(['default-styling' => true, 'class' => 'text-green-500', 'default-colors' => true]);
        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => 'text-green-500'], $this->basicTable->getCollapsingColumnButtonExpandAttributes());

        $this->assertSame(['default-styling' => true, 'default-colors' => true], $this->basicTable->getCollapsingColumnButtonCollapseAttributes());

    }

    public function test_can_get_set_should_be_displayed(): void
    {
        $this->assertTrue($this->basicTable->getShouldBeDisplayed());
        $this->basicTable->setShouldBeHidden();
        $this->assertFalse($this->basicTable->getShouldBeDisplayed());
        $this->basicTable->setShouldBeDisplayed();
        $this->assertTrue($this->basicTable->getShouldBeDisplayed());
    }
}
