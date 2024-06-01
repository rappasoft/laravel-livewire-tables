<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberRangeFilter;

final class NumberRangeFilterTest extends TestCase
{
    public function test_can_get_filter_name(): void
    {
        $filter = NumberRangeFilter::make('Active');
        // Should Match
        $this->assertSame('Active', $filter->getName());
    }

    public function test_can_get_filter_key(): void
    {
        $filter = NumberRangeFilter::make('Active');

        $this->assertSame('active', $filter->getKey());
    }

    public function test_can_get_filter_configs(): void
    {
        $filter = NumberRangeFilter::make('Active');

        $defaultConfig = config('livewire-tables.numberRange.defaultConfig');

        $this->assertSame($defaultConfig, $filter->getConfigs());

        $filter->config(['foo' => 'bar']);

        $this->assertSame(array_merge($defaultConfig, ['foo' => 'bar']), $filter->getConfigs());
    }

    public function test_get_a_single_filter_config(): void
    {
        $filter = NumberRangeFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertSame('bar', $filter->getConfig('foo'));
    }

    public function test_can_get_if_empty(): void
    {
        $filter = NumberRangeFilter::make('Active');
        $this->assertTrue($filter->isEmpty([]));
        $this->assertTrue($filter->isEmpty(''));
        $this->assertTrue($filter->isEmpty(['max' => 100]));
        $this->assertTrue($filter->isEmpty(['min' => 0]));
        $this->assertTrue($filter->isEmpty(['min' => '0']));
        $this->assertTrue($filter->isEmpty(['min' => '0', 'max' => '']));
        $this->assertTrue($filter->isEmpty(['min' => '0', 'max' => null]));
        $this->assertTrue($filter->isEmpty(['min' => null, 'max' => null]));
        $this->assertTrue($filter->isEmpty(['max' => null, 'min' => null]));
        $this->assertTrue($filter->isEmpty(['max' => null, 'min' => '4']));
        $this->assertTrue($filter->isEmpty(['min' => '62', 'max' => '']));
        $this->assertTrue($filter->isEmpty(['min' => '', 'max' => '3']));
        $this->assertTrue($filter->isEmpty(['min' => '', 'max' => '']));
        $this->assertTrue($filter->isEmpty(['min' => 0, 'max' => 100]));
        $this->assertFalse($filter->isEmpty(['min' => 0, 'max' => 50]));
        $this->assertFalse($filter->isEmpty(['min' => '0', 'max' => 50]));
        $this->assertFalse($filter->isEmpty(['min' => '0', 'max' => '50']));
        $this->assertFalse($filter->isEmpty(['min' => '10', 'max' => '100']));
        $this->assertFalse($filter->isEmpty(['min' => 10, 'max' => '100']));
    }

    public function test_can_check_validation_accepts_valid_values(): void
    {
        $filter = NumberRangeFilter::make('Active');
        $this->assertSame(['min' => 5, 'max' => 100], $filter->validate(['min' => '5', 'max' => '100']));
    }

    public function test_can_check_validation_rejects_invalid_values(): void
    {
        $filter = NumberRangeFilter::make('Active');
        $this->assertFalse($filter->validate(['min' => '0', 'max' => 'set']));
        $this->assertFalse($filter->validate(['min' => 'test', 'max' => '0']));
        $this->assertFalse($filter->validate(['min' => 'test', 'max' => 'test']));
        $this->assertSame(['min' => 15, 'max' => 50], $filter->validate(['min' => '15', 'max' => '50']));
    }

    public function test_can_check_validation_rejects_missing_values(): void
    {
        $filter = NumberRangeFilter::make('Active');
        $this->assertFalse($filter->validate(['min' => 10]));
        $this->assertFalse($filter->validate(['min' => 10]));
        $this->assertSame(['min' => 15, 'max' => 50], $filter->validate(['min' => 15, 'max' => 50]));
    }

    public function test_can_check_validation_rejects_values_over_configmax(): void
    {
        $filter = NumberRangeFilter::make('Active')->config(['minRange' => '0', 'maxRange' => '100']);
        $this->assertFalse($filter->validate(['min' => '15', 'max' => '5000']));
        $this->assertFalse($filter->validate(['min' => '6', 'max' => '5000']));
        $this->assertSame(['min' => 15, 'max' => 50], $filter->validate(['min' => '15', 'max' => '50']));
    }

    public function test_can_check_validation_rejects_values_below_configmax(): void
    {
        $filter = NumberRangeFilter::make('Active')->config(['minRange' => '0', 'maxRange' => '100']);
        $this->assertFalse($filter->validate(['min' => '-46', 'max' => '50']));
        $this->assertFalse($filter->validate(['min' => '-6', 'max' => '22']));
        $this->assertSame(['min' => 15, 'max' => 50], $filter->validate(['min' => '15', 'max' => '50']));
    }

    public function test_can_check_validation_flips_values_min_larger_than_max(): void
    {
        $filter = NumberRangeFilter::make('Active')->config(['minRange' => '0', 'maxRange' => '100']);
        $this->assertFalse($filter->validate(['min' => '-46', 'max' => '50']));
        $this->assertFalse($filter->validate(['min' => '-6', 'max' => '22']));
        $this->assertSame(['min' => 50, 'max' => 80], $filter->validate(['min' => '80', 'max' => '50']));
    }

    public function test_can_check_validation_flips_values_max_smaller_than_min_orderflipped(): void
    {
        $filter = NumberRangeFilter::make('Active')->config(['minRange' => '0', 'maxRange' => '100']);
        $this->assertFalse($filter->validate(['min' => '146', 'max' => '50']));
        $this->assertFalse($filter->validate(['min' => '-6', 'max' => '22']));
        $this->assertFalse($filter->validate(['min' => '30', 'max' => '-5']));
        $this->assertFalse($filter->validate(['min' => '30', 'max' => '125']));

        $this->assertSame(['min' => 50, 'max' => 80], $filter->validate(['max' => '50', 'min' => '80']));
    }

    public function test_can_check_validation_fails_values_empty_string(): void
    {
        $filter = NumberRangeFilter::make('Active')->config(['minRange' => '0', 'maxRange' => '100']);
        $this->assertFalse($filter->validate(['']));
        $this->assertFalse($filter->validate(['min' => '-6', 'max' => '22']));
        $this->assertSame(['min' => 50, 'max' => 80], $filter->validate(['min' => '80', 'max' => '50']));
    }

    public function test_can_check_validation_fails_values_null_values(): void
    {
        $filter = NumberRangeFilter::make('Active')->config(['minRange' => 0, 'maxRange' => 100]);
        $this->assertFalse($filter->validate(['min' => 22, 'max' => null]));
        $this->assertFalse($filter->validate(['min' => null, 'max' => 22]));
        $this->assertSame(['min' => 0, 'max' => 22], $filter->validate(['min' => '', 'max' => 22]));
        $this->assertSame(['min' => 0, 'max' => 22], $filter->validate(['min' => '22', 'max' => '']));

        $this->assertSame(['min' => 50, 'max' => 80], $filter->validate(['min' => '80', 'max' => '50']));
    }

    public function test_filter_pill_values_can_be_set_for_numberrange(): void
    {
        $filter = NumberRangeFilter::make('Active')->config(['minRange' => '10', 'maxRange' => '100']);

        $this->assertEquals('Min:25, Max:50', $filter->getFilterPillValue(['min' => '25', 'max' => '50']));
        $this->assertEquals('', $filter->getFilterPillValue(['min' => '30', 'max' => '166']));
        $this->assertEquals('', $filter->getFilterPillValue(['min' => '5', 'max' => '53']));
        $this->assertEquals('', $filter->getFilterPillValue(['min' => 'd0', 'max' => '76']));
    }

    public function test_can_check_validation_fails_non_numeric_values(): void
    {
        $filter = NumberRangeFilter::make('Active')->config(['minRange' => '0', 'maxRange' => '100']);
        $this->assertSame(['min' => 0, 'max' => 48], $filter->validate(['min' => 0, 'max' => 48]));
        $this->assertSame(['min' => 0, 'max' => 38], $filter->validate(['min' => 38, 'max' => 'test']));

        $this->assertSame(['min' => 50, 'max' => 80], $filter->validate(['min' => 50, 'max' => 80]));
    }

    public function test_can_check_validation_rejects_values_fault_configs(): void
    {
        $filter = NumberRangeFilter::make('Active')->config(['minRange' => 0, 'maxRange' => 100]);
        $this->assertFalse($filter->validate(['min' => -6, 'max' => 2200]));
        $this->assertSame(['min' => 15, 'max' => 50], $filter->validate(['min' => 15, 'max' => 50]));
    }

    public function test_can_get_filter_options(): void
    {
        $filter = NumberRangeFilter::make('Active');

        $this->assertSame(config('livewire-tables.numberRange.defaultOptions'), $filter->getOptions());

        $filter->options(['foo' => 'bar']);
        $this->assertSame(['min' => 0, 'max' => 100, 'foo' => 'bar'], $filter->getOptions());
    }

    public function test_can_get_filter_keys(): void
    {
        $filter = NumberRangeFilter::make('Active');

        $this->assertSame(['min', 'max'], $filter->getKeys());
    }

    public function test_can_get_filter_default_value(): void
    {
        $filter = NumberRangeFilter::make('Active');

        $this->assertSame([], $filter->getDefaultValue());
    }

    public function test_can_get_filter_callback(): void
    {
        $filter = NumberRangeFilter::make('Active');

        $this->assertFalse($filter->hasFilterCallback());

        $filter = NumberRangeFilter::make('Active')
            ->filter(function (Builder $builder, array $values) {
                return $builder->where('breed_id', '>', $values['min'])
                    ->where('breed_id', '<', $values['max']);
            });

        $this->assertTrue($filter->hasFilterCallback());
        $this->assertIsCallable($filter->getFilterCallback());
    }

    public function test_can_get_filter_pill_title(): void
    {
        $filter = NumberRangeFilter::make('Active');

        $this->assertSame('Active', $filter->getFilterPillTitle());

        $filter = NumberRangeFilter::make('Active')
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
        $filter = NumberRangeFilter::make('Active');

        $this->assertTrue($filter->hasConfigs());

        $filter->config();

        $this->assertTrue($filter->hasConfigs());

    }

    public function test_can_check_filter_config_by_name(): void
    {
        $filter = NumberRangeFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfig('foo'));
        $this->assertFalse($filter->hasConfig('bar'));
    }

    public function test_can_check_if_filter_is_hidden_from_menus(): void
    {
        $filter = NumberRangeFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromMenus());
        $this->assertTrue($filter->isVisibleInMenus());

        $filter->hiddenFromMenus();

        $this->assertTrue($filter->isHiddenFromMenus());
        $this->assertFalse($filter->isVisibleInMenus());
    }

    public function test_can_check_if_filter_is_hidden_from_pills(): void
    {
        $filter = NumberRangeFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromPills());
        $this->assertTrue($filter->isVisibleInPills());

        $filter->hiddenFromPills();

        $this->assertTrue($filter->isHiddenFromPills());
        $this->assertFalse($filter->isVisibleInPills());
    }

    public function test_can_check_if_filter_is_hidden_from_count(): void
    {
        $filter = NumberRangeFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromFilterCount());
        $this->assertTrue($filter->isVisibleInFilterCount());

        $filter->hiddenFromFilterCount();

        $this->assertTrue($filter->isHiddenFromFilterCount());
        $this->assertFalse($filter->isVisibleInFilterCount());
    }

    public function test_can_check_if_filter_is_reset_by_clear_button(): void
    {
        $filter = NumberRangeFilter::make('Active');

        $this->assertTrue($filter->isResetByClearButton());

        $filter->notResetByClearButton();

        $this->assertFalse($filter->isResetByClearButton());
    }

    public function test_can_set_custom_filter_view(): void
    {
        $filter = NumberRangeFilter::make('Active');
        $this->assertSame('livewire-tables::components.tools.filters.number-range', $filter->getViewPath());
        $filter->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', $filter->getViewPath());
    }
}
