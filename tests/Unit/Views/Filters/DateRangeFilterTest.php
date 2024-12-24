<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

#[Group('Filters')]
final class DateRangeFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = DateRangeFilter::make('Active');
    }

    public function test_can_get_filter_name(): void
    {
        $this->assertSame('Active', self::$filterInstance->getName());
    }

    public function test_can_get_filter_key(): void
    {
        $this->assertSame('active', self::$filterInstance->getKey());
    }

    public function test_can_get_filter_configs(): void
    {
        $defaultConfig = [
            'allowInput' => true,
            'altFormat' => 'F j, Y',
            'ariaDateFormat' => 'F j, Y',
            'dateFormat' => 'Y-m-d',
            'earliestDate' => null,
            'latestDate' => null,
            'locale' => 'en',
        ];

        $this->assertSame($defaultConfig, self::$filterInstance->getConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertSame(array_merge($defaultConfig, ['foo' => 'bar']), self::$filterInstance->getConfigs());
    }

    public function test_get_a_single_filter_config(): void
    {
        $this->assertSame([
            'allowInput' => true,
            'altFormat' => 'F j, Y',
            'ariaDateFormat' => 'F j, Y',
            'dateFormat' => 'Y-m-d',
            'earliestDate' => null,
            'latestDate' => null,
            'locale' => 'en',
        ], self::$filterInstance->getConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertSame('bar', self::$filterInstance->getConfig('foo'));
        $this->assertSame([
            'allowInput' => true,
            'altFormat' => 'F j, Y',
            'ariaDateFormat' => 'F j, Y',
            'dateFormat' => 'Y-m-d',
            'earliestDate' => null,
            'latestDate' => null,
            'locale' => 'en',
            'foo' => 'bar',
        ],
            self::$filterInstance->getConfigs()
        );

    }

    public function test_can_change_locale(): void
    {
        $this->assertSame([
            'allowInput' => true,
            'altFormat' => 'F j, Y',
            'ariaDateFormat' => 'F j, Y',
            'dateFormat' => 'Y-m-d',
            'earliestDate' => null,
            'latestDate' => null,
            'locale' => 'en',
        ],
            self::$filterInstance->getConfigs()
        );

        self::$filterInstance->config(['locale' => 'fr']);

        $this->assertSame([
            'allowInput' => true,
            'altFormat' => 'F j, Y',
            'ariaDateFormat' => 'F j, Y',
            'dateFormat' => 'Y-m-d',
            'earliestDate' => null,
            'latestDate' => null,
            'locale' => 'fr',
        ],
            self::$filterInstance->getConfigs()
        );
    }

    public function test_can_get_filter_options(): void
    {

        $this->assertSame([], self::$filterInstance->getOptions());

        self::$filterInstance->options(['foo' => 'bar']);

        $this->assertSame(['foo' => 'bar'], self::$filterInstance->getOptions());
    }

    public function test_can_get_if_empty(): void
    {
        $this->assertTrue(self::$filterInstance->isEmpty(''));
        $this->assertFalse(self::$filterInstance->isEmpty(['minDate' => '2020-01-01', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->isEmpty([0 => '2020-01-01', 1 => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->isEmpty(['2020-01-01', '2020-02-02']));
        $this->assertTrue(self::$filterInstance->isEmpty(['minDate' => '2020-01-01', 'maxDate' => null]));
        $this->assertTrue(self::$filterInstance->isEmpty(['minDate' => null, 'maxDate' => '2020-02-02']));
        $this->assertTrue(self::$filterInstance->isEmpty(['minDate' => '2020-01-01']));
        $this->assertTrue(self::$filterInstance->isEmpty(['minDate' => '2020-01-01', '']));
        $this->assertTrue(self::$filterInstance->isEmpty(['2020-01-01']));
        $this->assertTrue(self::$filterInstance->isEmpty('test'));
    }

    public function test_can_check_validation_accepts_valid_values_array(): void
    {
        $this->assertSame(
            ['minDate' => '2020-01-01', 'maxDate' => '2020-02-02'],
            self::$filterInstance->validate(['2020-01-01', '2020-02-02'])
        );
    }

    public function test_can_check_validation_accepts_valid_values_string(): void
    {
        $this->assertSame(
            ['minDate' => '2020-01-01', 'maxDate' => '2020-02-02'],
            self::$filterInstance->validate('2020-01-01 to 2020-02-02')
        );
        $this->assertFalse(self::$filterInstance->validate('2020-01-01 to '));
        $this->assertFalse(self::$filterInstance->validate(' to 2020-01-01'));
    }

    public function test_can_check_validation_rejects_invalid_values(): void
    {
        $this->assertSame(['minDate' => '2020-01-01', 'maxDate' => '2020-02-02'], self::$filterInstance->validate(['minDate' => '2020-01-01', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-02-21', 'maxDate' => '2020-02-30']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-02-30', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => 'test', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-02-21', 'maxDate' => '2020-13-22']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-13-21', 'maxDate' => '2020-12-22']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '12020-13-21', 'maxDate' => '2020-12-22']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-02-22', 'maxDate' => '2020-02-21']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-02-22', 'maxDate' => 'test']));
    }

    public function test_can_check_validation_rejects_invalid_earliest_latest_values(): void
    {
        self::$filterInstance->options(['earliestDate' => '20214-0111-01']);
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-02-21', 'maxDate' => '2020-02-30']));
    }

    public function test_can_check_validation_rejects_invalid_latest_latest_values(): void
    {
        self::$filterInstance->config(['latestDate' => '2191-111-11']);
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-02-21', 'maxDate' => '2020-02-30']));
    }

    public function test_can_check_validation_rejects_values_before_earliest_or_after_latest_with_dateformat(): void
    {
        self::$filterInstance->config(['dateFormat' => 'Y-m-d', 'earliestDate' => '2020-01-01', 'latestDate' => '2020-10-10']);
        $this->assertSame(['minDate' => '2020-01-02', 'maxDate' => '2020-02-02'], self::$filterInstance->validate(['minDate' => '2020-01-02', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-04-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2019-01-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-01-05', 'maxDate' => '2021-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2021-01-05', 'maxDate' => '2021-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2021-01-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2019-01-05', 'maxDate' => '2019-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2021-01-05', 'maxDate' => '2021-02-02']));
    }

    public function test_can_check_validation_rejects_values_before_earliest_or_after_latest_default_dateformat(): void
    {
        self::$filterInstance->config(['earliestDate' => '2020-01-01', 'latestDate' => '2020-10-10']);
        $this->assertSame(['minDate' => '2020-01-02', 'maxDate' => '2020-02-02'], self::$filterInstance->validate(['minDate' => '2020-01-02', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-04-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2019-01-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-01-05', 'maxDate' => '2021-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2021-01-05', 'maxDate' => '2021-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2021-01-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2019-01-05', 'maxDate' => '2019-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2021-01-05', 'maxDate' => '2021-02-02']));
    }

    public function test_can_check_validation_rejects_values_2_dateformat(): void
    {
        self::$filterInstance->config(['earliestDate' => '2020-01-01', 'latestDate' => '2020-10-10']);
        $this->assertSame(['minDate' => '2020-01-02', 'maxDate' => '2020-03-02'], self::$filterInstance->validate(['minDate' => '2020-01-02', 'maxDate' => '2020-03-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-01-05', 'maxDate' => '2020-02-30']));
    }

    public function test_can_check_date_format_can_be_changed(): void
    {
        self::$filterInstance->config(['dateFormat' => 'd-m-Y', 'earliestDate' => '01-01-2020', 'latestDate' => '12-10-2020']);
        $this->assertSame(['minDate' => '02-01-2020', 'maxDate' => '02-03-2020'], self::$filterInstance->validate(['minDate' => '02-01-2020', 'maxDate' => '02-03-2020']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '2020-04-05', 'maxDate' => '2020-02-02']));
        $this->assertFalse(self::$filterInstance->validate(['minDate' => '10-12-2020', 'maxDate' => '12-12-2020']));
    }

    public function test_filter_pill_values_can_be_set_for_daterange(): void
    {
        $this->assertEquals('February 2, 2020 to February 5, 2020', self::$filterInstance->getFilterPillValue(['minDate' => '2020-02-02', 'maxDate' => '2020-02-05']));
        $this->assertEquals('February 2, 2010 to February 5, 2020', self::$filterInstance->getFilterPillValue(['minDate' => '2010-02-02', 'maxDate' => '2020-02-05']));
    }

    public function test_filter_pill_values_cannot_be_set_for_invalid_dates(): void
    {
        self::$filterInstance->options(['dateFormat' => 'd-m-Y', 'earliestDate' => '01-01-2020', 'latestDate' => '1d-10-2020']);

        $this->assertEquals('', self::$filterInstance->getFilterPillValue(['minDate' => '20q0-02-02', 'maxDate' => '2020-02-05']));
        $this->assertEquals('', self::$filterInstance->getFilterPillValue(['minDate' => '2020-02-02', 'maxDate' => '2020-13-05']));
        $this->assertEquals('February 2, 2010 to February 5, 2020', self::$filterInstance->getFilterPillValue(['minDate' => '2010-02-02', 'maxDate' => '2020-02-05']));
    }

    public function test_filter_pill_values_can_be_set_for_daterange_limits(): void
    {
        self::$filterInstance->options(['ariaDateFormat' => 'F j, Y', 'earliestDate' => '2020-01-01', 'latestDate' => '2022-01-01']);

        $this->assertEquals('February 2, 2020 to February 5, 2020', self::$filterInstance->getFilterPillValue(['minDate' => '2020-02-02', 'maxDate' => '2020-02-05']));
        $this->assertEquals('February 2, 2010 to February 5, 2020', self::$filterInstance->getFilterPillValue(['minDate' => '2010-02-02', 'maxDate' => '2020-02-05']));
    }

    public function test_filter_pill_values_can_be_set_for_daterange_customformat(): void
    {
        self::$filterInstance->config(['ariaDateFormat' => 'Y', 'latestDate' => '2022-01-01']);

        $this->assertEquals('2020 to 2021', self::$filterInstance->getFilterPillValue(['minDate' => '2020-02-02', 'maxDate' => '2021-02-05']));
        $this->assertEquals('', self::$filterInstance->getFilterPillValue(['minDate' => '20220-02-02', 'maxDate' => '2020-02-05']));
    }

    public function test_can_get_filter_keys(): void
    {
        $this->assertSame(['minDate' => '', 'maxDate' => ''], self::$filterInstance->getKeys());
    }

    public function test_can_get_filter_default_value(): void
    {
        $this->assertSame([], self::$filterInstance->getDefaultValue());
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
        $this->assertSame('Active', self::$filterInstance->getFilterPillTitle());

        self::$filterInstance->setFilterPillTitle('User Status');

        $this->assertSame('User Status', self::$filterInstance->getFilterPillTitle());
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
        $this->assertTrue(self::$filterInstance->hasConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertTrue(self::$filterInstance->hasConfigs());

    }

    public function test_can_check_filter_config_by_name(): void
    {
        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertTrue(self::$filterInstance->hasConfig('foo'));
        $this->assertFalse(self::$filterInstance->hasConfig('bar'));
    }

    public function test_can_check_if_filter_is_hidden_from_menus(): void
    {
        $this->assertFalse(self::$filterInstance->isHiddenFromMenus());
        $this->assertTrue(self::$filterInstance->isVisibleInMenus());

        self::$filterInstance->hiddenFromMenus();

        $this->assertTrue(self::$filterInstance->isHiddenFromMenus());
        $this->assertFalse(self::$filterInstance->isVisibleInMenus());
    }

    public function test_can_check_if_filter_is_hidden_from_pills(): void
    {
        $this->assertFalse(self::$filterInstance->isHiddenFromPills());
        $this->assertTrue(self::$filterInstance->isVisibleInPills());

        self::$filterInstance->hiddenFromPills();

        $this->assertTrue(self::$filterInstance->isHiddenFromPills());
        $this->assertFalse(self::$filterInstance->isVisibleInPills());
    }

    public function test_can_check_if_filter_is_hidden_from_count(): void
    {
        $this->assertFalse(self::$filterInstance->isHiddenFromFilterCount());
        $this->assertTrue(self::$filterInstance->isVisibleInFilterCount());

        self::$filterInstance->hiddenFromFilterCount();

        $this->assertTrue(self::$filterInstance->isHiddenFromFilterCount());
        $this->assertFalse(self::$filterInstance->isVisibleInFilterCount());
    }

    public function test_can_check_if_filter_is_reset_by_clear_button(): void
    {
        $this->assertTrue(self::$filterInstance->isResetByClearButton());

        self::$filterInstance->notResetByClearButton();

        $this->assertFalse(self::$filterInstance->isResetByClearButton());
    }

    public function test_can_get_datestring(): void
    {
        $this->assertSame('', self::$filterInstance->getDateString(''));
        $this->assertSame('2020-01-01 to 2020-02-02', self::$filterInstance->getDateString(['2020-02-02', '2020-01-01']));
        $this->assertSame('2021-03-03 to 2021-04-04', self::$filterInstance->getDateString(['minDate' => '2021-03-03', 'maxDate' => '2021-04-04']));
        $this->assertSame('2022-05-05 to 2022-06-06', self::$filterInstance->getDateString('2022-05-05,to,2022-06-06'));
    }

    public function test_can_set_custom_filter_view(): void
    {
        $this->assertSame('livewire-tables::components.tools.filters.date-range', self::$filterInstance->getViewPath());
        self::$filterInstance->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', self::$filterInstance->getViewPath());
    }

    public function test_can_set_default_value_by_string(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterDefaultValue());
        self::$filterInstance->setFilterDefaultValue('2024-04-04');
        $this->assertTrue(self::$filterInstance->hasFilterDefaultValue());
        $this->assertSame(['minDate' => '2024-04-04', 'maxDate' => '2024-04-04'], self::$filterInstance->getFilterDefaultValue());

    }

    public function test_can_set_default_value_by_named_array(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterDefaultValue());
        self::$filterInstance->setFilterDefaultValue(['minDate' => '2024-05-04', 'maxDate' => '2024-06-04']);
        $this->assertTrue(self::$filterInstance->hasFilterDefaultValue());
        $this->assertSame(['minDate' => '2024-05-04', 'maxDate' => '2024-06-04'], self::$filterInstance->getFilterDefaultValue());

    }

    public function test_can_set_default_value_by_short_named_array(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterDefaultValue());
        self::$filterInstance->setFilterDefaultValue(['min' => '2024-05-04', 'max' => '2024-06-04']);
        $this->assertTrue(self::$filterInstance->hasFilterDefaultValue());
        $this->assertSame(['minDate' => '2024-05-04', 'maxDate' => '2024-06-04'], self::$filterInstance->getFilterDefaultValue());

    }

    public function test_can_set_default_value_by_numbered_array(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterDefaultValue());
        self::$filterInstance->setFilterDefaultValue(['2024-06-04', '2024-07-04']);
        $this->assertTrue(self::$filterInstance->hasFilterDefaultValue());
        $this->assertSame(['minDate' => '2024-06-04', 'maxDate' => '2024-07-04'], self::$filterInstance->getFilterDefaultValue());
    }

    public function test_check_if_has_locale(): void
    {
        $this->assertFalse(self::$filterInstance->hasPillsLocale());
        self::$filterInstance->setPillsLocale('fr');
        $this->assertTrue(self::$filterInstance->hasPillsLocale());
    }

    public function test_check_if_can_get_locale(): void
    {
        $this->assertFalse(self::$filterInstance->hasPillsLocale());
        $this->assertSame('en', self::$filterInstance->getPillsLocale());
        self::$filterInstance->setPillsLocale('fr');
        $this->assertTrue(self::$filterInstance->hasPillsLocale());
        $this->assertSame('fr', self::$filterInstance->getPillsLocale());
        self::$filterInstance->setPillsLocale('de');
        $this->assertSame('de', self::$filterInstance->getPillsLocale());
        $this->assertTrue(self::$filterInstance->hasPillsLocale());
    }
}
