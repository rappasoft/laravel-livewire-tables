<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class FilterHelpersTest extends TestCase
{

    public function test_can_get_filter_name(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertSame('Active', $filter->getName());
    }


    public function test_can_get_filter_key(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertSame('active', $filter->getKey());
    }


    public function test_can_get_filter_configs(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertSame([], $filter->getConfigs());

        $filter->config(['foo' => 'bar']);

        $this->assertSame(['foo' => 'bar'], $filter->getConfigs());
    }


    public function test_get_a_single_filter_config(): void
    {
        $filter = SelectFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertSame('bar', $filter->getConfig('foo'));
    }


    public function test_can_get_filter_keys(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertSame([], $filter->getKeys());

        $filter->options(['foo' => 'bar']);

        $this->assertSame(['foo'], $filter->getKeys());
    }


    public function test_can_get_nested_filter_keys(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertSame([], $filter->getKeys());

        $filter->options(['foo' => ['bar' => 'baz']]);

        $this->assertSame(['bar'], $filter->getKeys());

        $filter->options(['foo' => collect(['bar' => 'baz'])]);

        $this->assertSame(['bar'], $filter->getKeys());
    }


    public function test_can_get_filter_default_value(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertNull($filter->getDefaultValue());

        $filter = MultiSelectFilter::make('Active');

        $this->assertSame([], $filter->getDefaultValue());

        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertSame([], $filter->getDefaultValue());
    }


    public function test_can_get_filter_callback(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->hasFilterCallback());

        $filter = SelectFilter::make('Active')
            ->filter(function (Builder $builder, array $values) {
                return $builder->whereIn('breed_id', $values);
            });

        $this->assertTrue($filter->hasFilterCallback());
        $this->assertIsCallable($filter->getFilterCallback());
    }


    public function test_can_get_filter_pill_title(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertSame('Active', $filter->getFilterPillTitle());

        $filter = SelectFilter::make('Active')
            ->setFilterPillTitle('User Status');

        $this->assertSame('User Status', $filter->getFilterPillTitle());
    }


    public function test_can_get_filter_pill_value(): void
    {
        $filter = SelectFilter::make('Active')
            ->options(['foo' => 'bar']);

        $this->assertSame('bar', $filter->getFilterPillValue('foo'));

        $filter = SelectFilter::make('Active')
            ->options(['foo' => 'bar'])
            ->setFilterPillValues(['foo' => 'baz']);

        $this->assertSame('baz', $filter->getFilterPillValue('foo'));
    }


    public function test_can_get_nested_filter_pill_value(): void
    {
        $filter = SelectFilter::make('Active')
            ->options(['foo' => ['bar' => 'baz']]);

        $this->assertSame('baz', $filter->getFilterPillValue('bar'));

        $filter = SelectFilter::make('Active')
            ->options(['foo' => ['bar' => 'baz']])
            ->setFilterPillValues(['bar' => 'etc']);

        $this->assertSame('etc', $filter->getFilterPillValue('bar'));
    }


    public function test_can_check_if_filter_has_configs(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->hasConfigs());

        $filter = SelectFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfigs());
    }


    public function test_can_check_filter_config_by_name(): void
    {
        $filter = SelectFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfig('foo'));
        $this->assertFalse($filter->hasConfig('bar'));
    }


    public function test_can_check_if_filter_is_hidden_from_menus(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromMenus());
        $this->assertTrue($filter->isVisibleInMenus());

        $filter->hiddenFromMenus();

        $this->assertTrue($filter->isHiddenFromMenus());
        $this->assertFalse($filter->isVisibleInMenus());
    }


    public function test_can_check_if_filter_is_hidden_from_pills(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromPills());
        $this->assertTrue($filter->isVisibleInPills());

        $filter->hiddenFromPills();

        $this->assertTrue($filter->isHiddenFromPills());
        $this->assertFalse($filter->isVisibleInPills());
    }


    public function test_can_check_if_filter_is_hidden_from_count(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromFilterCount());
        $this->assertTrue($filter->isVisibleInFilterCount());

        $filter->hiddenFromFilterCount();

        $this->assertTrue($filter->isHiddenFromFilterCount());
        $this->assertFalse($filter->isVisibleInFilterCount());
    }


    public function test_can_check_if_filter_is_reset_by_clear_button(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertTrue($filter->isResetByClearButton());

        $filter->notResetByClearButton();

        $this->assertFalse($filter->isResetByClearButton());
    }


    public function test_can_check_if_filter_has_slidedown_row(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->hasFilterSlidedownRow());

        $filter->setFilterSlidedownRow('2');

        $this->assertTrue($filter->hasFilterSlidedownRow());

        $filter->setFilterSlidedownRow(3);

        $this->assertTrue($filter->hasFilterSlidedownRow());
    }


    public function test_filter_slidedown_row_returns_int(): void
    {
        $filter = SelectFilter::make('Active');

        $filter->setFilterSlidedownRow(2);

        $this->assertIsInt($filter->getFilterSlidedownRow());

        $filter->setFilterSlidedownRow('3');

        $this->assertIsInt($filter->getFilterSlidedownRow());
    }


    public function test_can_get_filter_slidedown_row(): void
    {
        $filter = SelectFilter::make('Active')->setFilterSlidedownRow('2');

        $this->assertSame(2, $filter->getFilterSlidedownRow());

        $filter->setFilterSlidedownRow(3);

        $this->assertSame(3, $filter->getFilterSlidedownRow());
    }


    public function test_can_check_if_filter_has_slidedown_colspan(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->hasFilterSlidedownColspan());

        $filter->setFilterSlidedownColspan('2');

        $this->assertTrue($filter->hasFilterSlidedownColspan());

        $filter->setFilterSlidedownColspan(2);

        $this->assertTrue($filter->hasFilterSlidedownColspan());
    }


    public function test_filter_slidedown_colspan_returns_int(): void
    {
        $filter = SelectFilter::make('Active');

        $filter->setFilterSlidedownColspan(2);

        $this->assertIsInt($filter->getFilterSlidedownColspan());

        $filter->setFilterSlidedownColspan('3');

        $this->assertIsInt($filter->getFilterSlidedownColspan());
    }


    public function test_can_get_filter_slidedown_colspan(): void
    {
        $filter = SelectFilter::make('Active')->setFilterSlidedownColspan('2');

        $this->assertSame(2, $filter->getFilterSlidedownColspan());

        $filter->setFilterSlidedownColspan(3);

        $this->assertSame(3, $filter->getFilterSlidedownColspan());
    }


    public function test_can_get_filter_default_value_component_level_array(): void
    {
        $filter = MultiSelectFilter::make('Active')->options(['foo' => 'bar', 'lorem' => 'ipsum'])->setFilterDefaultValue(['lorem']);
        $this->assertSame(['lorem'], $filter->getFilterDefaultValue());
    }


    public function test_can_get_filter_has_default_value_component_level_array(): void
    {
        $filter = MultiSelectFilter::make('Active')->options(['foo' => 'bar', 'lorem' => 'ipsum']);
        $this->assertFalse($filter->hasFilterDefaultValue());
        $filter->setFilterDefaultValue(['foo']);
        $this->assertTrue($filter->hasFilterDefaultValue());
    }


    public function test_can_get_filter_default_value_component_level_text(): void
    {
        $filter = TextFilter::make('Active')->setFilterDefaultValue('lorem');
        $this->assertSame('lorem', $filter->getFilterDefaultValue());
    }


    public function test_can_get_filter_has_default_value_component_level_text(): void
    {
        $filter = TextFilter::make('Active');
        $this->assertFalse($filter->hasFilterDefaultValue());
        $filter->setFilterDefaultValue('foo');
        $this->assertTrue($filter->hasFilterDefaultValue());
    }


    public function test_can_get_filter_custom_filter_pills_blade(): void
    {
        $filter = TextFilter::make('Active');
        $this->assertFalse($filter->hasCustomPillBlade());
        $filter->setFilterPillBlade('foo');
        $this->assertTrue($filter->hasCustomPillBlade());
        $this->assertSame('foo', $filter->getCustomPillBlade());
    }


    public function test_can_get_filter_label_attributes(): void
    {
        $filter1 = TextFilter::make('Filter1');
        $filter2 = TextFilter::make('Filter2')->setFilterLabelAttributes(
            ['class' => 'text-xl', 'default' => true]
        );
        $filter3 = TextFilter::make('Filter3')->setFilterLabelAttributes(
            ['class' => 'text-2xl', 'default' => false]
        );

        $this->assertFalse($filter1->hasFilterLabelAttributes());
        $this->assertTrue($filter2->hasFilterLabelAttributes());
        $this->assertTrue($filter3->hasFilterLabelAttributes());

        $this->assertSame($filter1->getFilterLabelAttributes(), ['default' => true]);
        $this->assertSame($filter2->getFilterLabelAttributes(), ['default' => true, 'class' => 'text-xl']);
        $this->assertSame($filter3->getFilterLabelAttributes(), ['default' => false, 'class' => 'text-2xl']);

        $filter1->setFilterLabelAttributes(
            ['class' => 'text-3xl', 'default' => false]
        );
        $this->assertTrue($filter1->hasFilterLabelAttributes());
        $this->assertSame($filter1->getFilterLabelAttributes(), ['default' => false, 'class' => 'text-3xl']);

    }


    public function test_can_get_filter_wire_key(): void
    {
        $filter1 = TextFilter::make('Filter1');
        $tableName = 'test1';
        $filterType = 'textfilter';
        $filterKey = $filter1->getKey();

        $this->assertSame($filter1->generateWireKey($tableName, $filterType), $tableName.'-filter-'.$filterType.'-'.$filterKey);
    }


    public function test_can_get_filter_wire_key_custom_position(): void
    {
        $filter1 = TextFilter::make('Filter1');
        $tableName = 'test1';
        $filterType = 'textfilter';
        $customPosition = 'header';

        $filterKey = $filter1->getKey();
        $filter1->setFilterPosition($customPosition);
        $this->assertTrue($filter1->hasCustomPosition());

        $this->assertSame($filter1->generateWireKey($tableName, $filterType), $tableName.'-filter-'.$filterType.'-'.$filterKey.'-'.$customPosition);
    }


    public function test_can_get_filter_display_data(): void
    {
        $filter1 = TextFilter::make('Filter1');

        $testGenericData = [
            'filterLayout' => 'tailwind',
            'tableName' => 'test123',
            'isTailwind' => true,
            'isBootstrap' => false,
            'isBootstrap4' => false,
            'isBootstrap5' => false,
        ];

        $filter1->setGenericDisplayData($testGenericData);

        $this->assertSame($testGenericData['filterLayout'], $filter1->getFilterDisplayData()['filterLayout']);
        $this->assertSame($testGenericData['tableName'], $filter1->getFilterDisplayData()['tableName']);
        $this->assertSame($testGenericData['isTailwind'], $filter1->getFilterDisplayData()['isTailwind']);
        $this->assertSame($testGenericData['isBootstrap'], $filter1->getFilterDisplayData()['isBootstrap']);
        $this->assertSame($testGenericData['isBootstrap4'], $filter1->getFilterDisplayData()['isBootstrap4']);
        $this->assertSame($testGenericData['isBootstrap5'], $filter1->getFilterDisplayData()['isBootstrap5']);
        $this->assertSame($filter1, $filter1->getFilterDisplayData()['filter']);
    }
}
