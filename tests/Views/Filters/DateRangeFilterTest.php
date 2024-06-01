<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

final class DateRangeFilterTest extends FilterTestCase
{
    public function test_can_get_filter_name(): void
    {
        $filter = DateRangeFilter::make('Active');
        // Matches
        $this->assertSame('Active', $filter->getName());
    }

    public function test_can_get_filter_key(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertSame('active', $filter->getKey());
    }

    public function test_can_get_filter_configs(): void
    {
        $filter = DateRangeFilter::make('Active');

        $defaultConfig = [
            'allowInput' => true,
            'altFormat' => 'F j, Y',
            'ariaDateFormat' => 'F j, Y',
            'dateFormat' => 'Y-m-d',
            'earliestDate' => null,
            'latestDate' => null,
        ];

        $this->assertSame($defaultConfig, $filter->getConfigs());

        $filter->config(['foo' => 'bar']);

        $this->assertSame(array_merge($defaultConfig, ['foo' => 'bar']), $filter->getConfigs());
    }

    public function test_get_a_single_filter_config(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertSame([
            'allowInput' => true,
            'altFormat' => 'F j, Y',
            'ariaDateFormat' => 'F j, Y',
            'dateFormat' => 'Y-m-d',
            'earliestDate' => null,
            'latestDate' => null,
        ], $filter->getConfigs());

        $filter->config(['foo' => 'bar']);

        $this->assertSame('bar', $filter->getConfig('foo'));
        $this->assertSame([
            'allowInput' => true,
            'altFormat' => 'F j, Y',
            'ariaDateFormat' => 'F j, Y',
            'dateFormat' => 'Y-m-d',
            'earliestDate' => null,
            'latestDate' => null,
            'foo' => 'bar'], $filter->getConfigs());

    }

    public function test_can_get_filter_options(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertSame([], $filter->getOptions());

        $filter->options(['foo' => 'bar']);

    }

    public function test_can_get_if_empty(): void
    {
        $filter = DateRangeFilter::make('Active');
        $this->assertTrue($filter->isEmpty(''));
        $this->assertFalse($filter->isEmpty(['minDate' => '2020-01-01', 'maxDate' => '2020-02-02']));
        $this->assertTrue($filter->isEmpty(['minDate' => '2020-01-01', 'maxDate' => null]));
        $this->assertTrue($filter->isEmpty(['minDate' => null, 'maxDate' => '2020-02-02']));

        $this->assertTrue($filter->isEmpty(['minDate' => '2020-01-01']));
        $this->assertFalse($filter->isEmpty([0 => '2020-01-01', 1 => '2020-02-02']));
        $this->assertFalse($filter->isEmpty(['2020-01-01', '2020-02-02']));
        $this->assertTrue($filter->isEmpty('test'));
    }

    public function test_can_check_validation_accepts_valid_values_array(): void
    {
        $filter = DateRangeFilter::make('Active');
        $this->assertSame(['minDate' => '2020-01-01', 'maxDate' => '2020-02-02'], $filter->validate(['2020-01-01', '2020-02-02']));
    }

    public function test_can_check_validation_accepts_valid_values_string(): void
    {
        $filter = DateRangeFilter::make('Active');
        $this->assertSame(['minDate' => '2020-01-01', 'maxDate' => '2020-02-02'], $filter->validate('2020-01-01 to 2020-02-02'));
        $this->assertFalse($filter->validate('2020-01-01 to '));
        $this->assertFalse($filter->validate(' to 2020-01-01'));
    }

    public function test_can_check_validation_rejects_invalid_values(): void
    {
        $filter = DateRangeFilter::make('Active');
        $this->assertSame(['minDate' => '2020-01-01', 'maxDate' => '2020-02-02'], $filter->validate(['minDate' => '2020-01-01', 'maxDate' => '2020-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2020-02-21', 'maxDate' => '2020-02-30']));
        $this->assertFalse($filter->validate(['minDate' => '2020-02-30', 'maxDate' => '2020-02-02']));
        $this->assertFalse($filter->validate(['minDate' => 'test', 'maxDate' => '2020-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2020-02-21', 'maxDate' => '2020-13-22']));
        $this->assertFalse($filter->validate(['minDate' => '2020-13-21', 'maxDate' => '2020-12-22']));
        $this->assertFalse($filter->validate(['minDate' => '12020-13-21', 'maxDate' => '2020-12-22']));
        $this->assertFalse($filter->validate(['minDate' => '2020-02-22', 'maxDate' => '2020-02-21']));
    }

    public function test_can_check_validation_rejects_invalid_earliest_latest_values(): void
    {
        $filter = DateRangeFilter::make('Active')->options(['earliestDate' => '20214-0111-01']);
        $this->assertFalse($filter->validate(['minDate' => '2020-02-21', 'maxDate' => '2020-02-30']));
    }

    public function test_can_check_validation_rejects_invalid_latest_latest_values(): void
    {
        $filter = DateRangeFilter::make('Active')->config(['latestDate' => '2191-111-11']);
        $this->assertFalse($filter->validate(['minDate' => '2020-02-21', 'maxDate' => '2020-02-30']));
    }

    public function test_can_check_validation_rejects_values_before_earliest_or_after_latest_with_dateformat(): void
    {
        $filter = DateRangeFilter::make('Active')->config(['dateFormat' => 'Y-m-d', 'earliestDate' => '2020-01-01', 'latestDate' => '2020-10-10']);
        $this->assertSame(['minDate' => '2020-01-02', 'maxDate' => '2020-02-02'], $filter->validate(['minDate' => '2020-01-02', 'maxDate' => '2020-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2020-04-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2019-01-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2020-01-05', 'maxDate' => '2021-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2021-01-05', 'maxDate' => '2021-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2021-01-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2019-01-05', 'maxDate' => '2019-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2021-01-05', 'maxDate' => '2021-02-02']));
    }

    public function test_can_check_validation_rejects_values_before_earliest_or_after_latest_default_dateformat(): void
    {
        $filter = DateRangeFilter::make('Active')->config(['earliestDate' => '2020-01-01', 'latestDate' => '2020-10-10']);
        $this->assertSame(['minDate' => '2020-01-02', 'maxDate' => '2020-02-02'], $filter->validate(['minDate' => '2020-01-02', 'maxDate' => '2020-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2020-04-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2019-01-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2020-01-05', 'maxDate' => '2021-02-02']));

        $this->assertFalse($filter->validate(['minDate' => '2021-01-05', 'maxDate' => '2021-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2021-01-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2019-01-05', 'maxDate' => '2019-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '2021-01-05', 'maxDate' => '2021-02-02']));
    }

    public function test_can_check_validation_rejects_values_2_dateformat(): void
    {
        $filter = DateRangeFilter::make('Active')->config(['earliestDate' => '2020-01-01', 'latestDate' => '2020-10-10']);
        $this->assertSame(['minDate' => '2020-01-02', 'maxDate' => '2020-03-02'], $filter->validate(['minDate' => '2020-01-02', 'maxDate' => '2020-03-02']));
        $this->assertFalse($filter->validate(['minDate' => '2020-01-05', 'maxDate' => '2020-02-30']));
    }

    public function test_can_check_date_format_can_be_changed(): void
    {
        $filter = DateRangeFilter::make('Active')->config(['dateFormat' => 'd-m-Y', 'earliestDate' => '01-01-2020', 'latestDate' => '12-10-2020']);
        $this->assertSame(['minDate' => '02-01-2020', 'maxDate' => '02-03-2020'], $filter->validate(['minDate' => '02-01-2020', 'maxDate' => '02-03-2020']));
        $this->assertFalse($filter->validate(['minDate' => '2020-04-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse($filter->validate(['minDate' => '10-12-2020', 'maxDate' => '12-12-2020']));
    }

    public function test_filter_pill_values_can_be_set_for_daterange(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertEquals('February 2, 2020 to February 5, 2020', $filter->getFilterPillValue(['minDate' => '2020-02-02', 'maxDate' => '2020-02-05']));

        $this->assertEquals('February 2, 2010 to February 5, 2020', $filter->getFilterPillValue(['minDate' => '2010-02-02', 'maxDate' => '2020-02-05']));
    }

    public function test_filter_pill_values_cannot_be_set_for_invalid_dates(): void
    {
        $filter = DateRangeFilter::make('Active')->options(['dateFormat' => 'd-m-Y', 'earliestDate' => '01-01-2020', 'latestDate' => '1d-10-2020']);

        $this->assertEquals('', $filter->getFilterPillValue(['minDate' => '20q0-02-02', 'maxDate' => '2020-02-05']));
        $this->assertEquals('', $filter->getFilterPillValue(['minDate' => '2020-02-02', 'maxDate' => '2020-13-05']));
        $this->assertEquals('February 2, 2010 to February 5, 2020', $filter->getFilterPillValue(['minDate' => '2010-02-02', 'maxDate' => '2020-02-05']));
    }

    public function test_filter_pill_values_can_be_set_for_daterange_limits(): void
    {
        $filter = DateRangeFilter::make('Active')->options(['ariaDateFormat' => 'F j, Y', 'earliestDate' => '2020-01-01', 'latestDate' => '2022-01-01']);

        $this->assertEquals('February 2, 2020 to February 5, 2020', $filter->getFilterPillValue(['minDate' => '2020-02-02', 'maxDate' => '2020-02-05']));
        $this->assertEquals('February 2, 2010 to February 5, 2020', $filter->getFilterPillValue(['minDate' => '2010-02-02', 'maxDate' => '2020-02-05']));
    }

    public function test_filter_pill_values_can_be_set_for_daterange_customformat(): void
    {
        $filter = DateRangeFilter::make('Active')->config(['ariaDateFormat' => 'Y', 'latestDate' => '2022-01-01']);

        $this->assertEquals('2020 to 2021', $filter->getFilterPillValue(['minDate' => '2020-02-02', 'maxDate' => '2021-02-05']));
        $this->assertEquals('', $filter->getFilterPillValue(['minDate' => '20220-02-02', 'maxDate' => '2020-02-05']));
    }

    public function test_can_get_filter_keys(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertSame(['minDate' => '', 'maxDate' => ''], $filter->getKeys());
    }

    public function test_can_get_filter_default_value(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertSame([], $filter->getDefaultValue());
    }

    public function test_can_get_filter_callback(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertFalse($filter->hasFilterCallback());

        $filter = DateRangeFilter::make('Active')
            ->filter(function (Builder $builder, array $values) {
                return $builder->where('last_visit', '>=', $values['minDate'])
                    ->where('last_visit', '<=', $values['maxDate']);
            });

        $this->assertTrue($filter->hasFilterCallback());
        $this->assertIsCallable($filter->getFilterCallback());
    }

    public function test_can_get_filter_pill_title(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertSame('Active', $filter->getFilterPillTitle());

        $filter = DateRangeFilter::make('Active')
            ->setFilterPillTitle('User Status');

        $this->assertSame('User Status', $filter->getFilterPillTitle());
    }

    /*
    public function test_can_get_filter_pill_value(): void
    {
        $filter = NumberRangeFilter::make('Active')
            ->options(['foo' => 'bar']);

        $this->assertSame('bar', $filter->getFilterPillValue('foo'));

        $filter = NumberRangeFilter::make('Active')
            ->options(['foo' => 'bar'])
            ->setFilterPillValues(['foo' => 'baz']);

        $this->assertSame('baz', $filter->getFilterPillValue('foo'));
    }*/

    /*
    public function test_can_get_nested_filter_pill_value(): void
    {
        $filter = NumberRangeFilter::make('Active')
            ->options(['foo' => ['bar' => 'baz']]);

        $this->assertSame('baz', $filter->getFilterPillValue('bar'));

        $filter = NumberRangeFilter::make('Active')
            ->options(['foo' => ['bar' => 'baz']])
            ->setFilterPillValues(['bar' => 'etc']);

        $this->assertSame('etc', $filter->getFilterPillValue('bar'));
    }*/

    public function test_can_check_if_filter_has_configs(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertTrue($filter->hasConfigs());

        $filter->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfigs());

    }

    public function test_can_check_filter_config_by_name(): void
    {
        $filter = DateRangeFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfig('foo'));
        $this->assertFalse($filter->hasConfig('bar'));
    }

    public function test_can_check_if_filter_is_hidden_from_menus(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromMenus());
        $this->assertTrue($filter->isVisibleInMenus());

        $filter->hiddenFromMenus();

        $this->assertTrue($filter->isHiddenFromMenus());
        $this->assertFalse($filter->isVisibleInMenus());
    }

    public function test_can_check_if_filter_is_hidden_from_pills(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromPills());
        $this->assertTrue($filter->isVisibleInPills());

        $filter->hiddenFromPills();

        $this->assertTrue($filter->isHiddenFromPills());
        $this->assertFalse($filter->isVisibleInPills());
    }

    public function test_can_check_if_filter_is_hidden_from_count(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromFilterCount());
        $this->assertTrue($filter->isVisibleInFilterCount());

        $filter->hiddenFromFilterCount();

        $this->assertTrue($filter->isHiddenFromFilterCount());
        $this->assertFalse($filter->isVisibleInFilterCount());
    }

    public function test_can_check_if_filter_is_reset_by_clear_button(): void
    {
        $filter = DateRangeFilter::make('Active');

        $this->assertTrue($filter->isResetByClearButton());

        $filter->notResetByClearButton();

        $this->assertFalse($filter->isResetByClearButton());
    }

    public function test_can_get_datestring(): void
    {
        $filter = DateRangeFilter::make('Active');
        $this->assertSame('', $filter->getDateString(''));
        $this->assertSame('2020-01-01 to 2020-02-02', $filter->getDateString(['2020-02-02', '2020-01-01']));
        $this->assertSame('2021-03-03 to 2021-04-04', $filter->getDateString(['minDate' => '2021-03-03', 'maxDate' => '2021-04-04']));
        $this->assertSame('2022-05-05 to 2022-06-06', $filter->getDateString('2022-05-05,to,2022-06-06'));
    }

    public function test_can_set_custom_filter_view(): void
    {
        $filter = DateRangeFilter::make('Active');
        $this->assertSame('livewire-tables::components.tools.filters.date-range', $filter->getViewPath());
        $filter->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', $filter->getViewPath());
    }
}
