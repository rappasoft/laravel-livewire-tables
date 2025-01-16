<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberRangeFilter;

#[Group('Filters')]
final class NumberRangeFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = NumberRangeFilter::make('Active');

    }

    public function test_can_get_filter_name(): void
    {
        // Should Match
        $this->assertSame('Active', self::$filterInstance->getName());
    }

    public function test_can_get_filter_key(): void
    {

        $this->assertSame('active', self::$filterInstance->getKey());
    }

    public function test_can_get_filter_configs(): void
    {

        $defaultConfig = config('livewire-tables.numberRange.defaultConfig');

        $this->assertSame($defaultConfig, self::$filterInstance->getConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertSame(array_merge($defaultConfig, ['foo' => 'bar']), self::$filterInstance->getConfigs());
    }

    public function test_get_a_single_filter_config(): void
    {
        self::$filterInstance
            ->config(['foo' => 'bar']);

        $this->assertSame('bar', self::$filterInstance->getConfig('foo'));
    }

    public function test_can_get_if_empty(): void
    {
        $this->assertTrue(self::$filterInstance->isEmpty([]));
        $this->assertTrue(self::$filterInstance->isEmpty(''));
        $this->assertTrue(self::$filterInstance->isEmpty(['max' => 100]));
        $this->assertTrue(self::$filterInstance->isEmpty(['min' => 0]));
        $this->assertTrue(self::$filterInstance->isEmpty(['min' => '0']));
        $this->assertTrue(self::$filterInstance->isEmpty(['min' => '0', 'max' => '']));
        $this->assertTrue(self::$filterInstance->isEmpty(['min' => '0', 'max' => null]));
        $this->assertTrue(self::$filterInstance->isEmpty(['min' => null, 'max' => null]));
        $this->assertTrue(self::$filterInstance->isEmpty(['max' => null, 'min' => null]));
        $this->assertTrue(self::$filterInstance->isEmpty(['max' => null, 'min' => '4']));
        $this->assertTrue(self::$filterInstance->isEmpty(['min' => '62', 'max' => '']));
        $this->assertTrue(self::$filterInstance->isEmpty(['min' => '', 'max' => '3']));
        $this->assertTrue(self::$filterInstance->isEmpty(['min' => '', 'max' => '']));
        $this->assertTrue(self::$filterInstance->isEmpty(['min' => 0, 'max' => 100]));
        $this->assertFalse(self::$filterInstance->isEmpty(['min' => 0, 'max' => 50]));
        $this->assertFalse(self::$filterInstance->isEmpty(['min' => '0', 'max' => 50]));
        $this->assertFalse(self::$filterInstance->isEmpty(['min' => '0', 'max' => '50']));
        $this->assertFalse(self::$filterInstance->isEmpty(['min' => '10', 'max' => '100']));
        $this->assertFalse(self::$filterInstance->isEmpty(['min' => 10, 'max' => '100']));
    }

    public function test_can_check_validation_accepts_valid_values(): void
    {
        $this->assertSame(['min' => 5, 'max' => 100], self::$filterInstance->validate(['min' => '5', 'max' => '100']));
    }

    public function test_can_check_validation_rejects_invalid_values(): void
    {
        $this->assertFalse(self::$filterInstance->validate(['min' => '0', 'max' => 'set']));
        $this->assertFalse(self::$filterInstance->validate(['min' => 'test', 'max' => '0']));
        $this->assertFalse(self::$filterInstance->validate(['min' => 'test', 'max' => 'test']));
        $this->assertSame(['min' => 15, 'max' => 50], self::$filterInstance->validate(['min' => '15', 'max' => '50']));
    }

    public function test_can_check_validation_rejects_missing_values(): void
    {
        $this->assertFalse(self::$filterInstance->validate(['min' => 10]));
        $this->assertFalse(self::$filterInstance->validate(['min' => 10]));
        $this->assertSame(['min' => 15, 'max' => 50], self::$filterInstance->validate(['min' => 15, 'max' => 50]));
    }

    public function test_can_check_validation_rejects_values_over_configmax(): void
    {
        self::$filterInstance->config(['minRange' => '0', 'maxRange' => '100']);
        $this->assertFalse(self::$filterInstance->validate(['min' => '15', 'max' => '5000']));
        $this->assertFalse(self::$filterInstance->validate(['min' => '6', 'max' => '5000']));
        $this->assertSame(['min' => 15, 'max' => 50], self::$filterInstance->validate(['min' => '15', 'max' => '50']));
    }

    public function test_can_check_validation_rejects_values_below_configmax(): void
    {
        self::$filterInstance->config(['minRange' => '0', 'maxRange' => '100']);
        $this->assertFalse(self::$filterInstance->validate(['min' => '-46', 'max' => '50']));
        $this->assertFalse(self::$filterInstance->validate(['min' => '-6', 'max' => '22']));
        $this->assertSame(['min' => 15, 'max' => 50], self::$filterInstance->validate(['min' => '15', 'max' => '50']));
    }

    public function test_can_check_validation_flips_values_min_larger_than_max(): void
    {
        self::$filterInstance->config(['minRange' => '0', 'maxRange' => '100']);
        $this->assertFalse(self::$filterInstance->validate(['min' => '-46', 'max' => '50']));
        $this->assertFalse(self::$filterInstance->validate(['min' => '-6', 'max' => '22']));
        $this->assertSame(['min' => 50, 'max' => 80], self::$filterInstance->validate(['min' => '80', 'max' => '50']));
    }

    public function test_can_check_validation_flips_values_max_smaller_than_min_orderflipped(): void
    {
        self::$filterInstance->config(['minRange' => '0', 'maxRange' => '100']);
        $this->assertFalse(self::$filterInstance->validate(['min' => '146', 'max' => '50']));
        $this->assertFalse(self::$filterInstance->validate(['min' => '-6', 'max' => '22']));
        $this->assertFalse(self::$filterInstance->validate(['min' => '30', 'max' => '-5']));
        $this->assertFalse(self::$filterInstance->validate(['min' => '30', 'max' => '125']));

        $this->assertSame(['min' => 50, 'max' => 80], self::$filterInstance->validate(['max' => '50', 'min' => '80']));
    }

    public function test_can_check_validation_fails_values_empty_string(): void
    {
        self::$filterInstance->config(['minRange' => '0', 'maxRange' => '100']);
        $this->assertFalse(self::$filterInstance->validate(['']));
        $this->assertFalse(self::$filterInstance->validate(['min' => '-6', 'max' => '22']));
        $this->assertSame(['min' => 50, 'max' => 80], self::$filterInstance->validate(['min' => '80', 'max' => '50']));
    }

    public function test_can_check_validation_fails_values_null_values(): void
    {
        self::$filterInstance->config(['minRange' => 0, 'maxRange' => 100]);
        $this->assertFalse(self::$filterInstance->validate(['min' => 22, 'max' => null]));
        $this->assertFalse(self::$filterInstance->validate(['min' => null, 'max' => 22]));
        $this->assertSame(['min' => 0, 'max' => 22], self::$filterInstance->validate(['min' => '', 'max' => 22]));
        $this->assertSame(['min' => 0, 'max' => 22], self::$filterInstance->validate(['min' => '22', 'max' => '']));

        $this->assertSame(['min' => 50, 'max' => 80], self::$filterInstance->validate(['min' => '80', 'max' => '50']));
    }

    public function test_filter_pill_values_can_be_set_for_numberrange(): void
    {
        self::$filterInstance->config(['minRange' => '10', 'maxRange' => '100']);

        $this->assertEquals('Min:25, Max:50', self::$filterInstance->getFilterPillValue(['min' => '25', 'max' => '50']));
        $this->assertEquals('', self::$filterInstance->getFilterPillValue(['min' => '30', 'max' => '166']));
        $this->assertEquals('', self::$filterInstance->getFilterPillValue(['min' => '5', 'max' => '53']));
        $this->assertEquals('', self::$filterInstance->getFilterPillValue(['min' => 'd0', 'max' => '76']));
    }

    public function test_can_check_validation_fails_non_numeric_values(): void
    {
        self::$filterInstance->config(['minRange' => '0', 'maxRange' => '100']);
        $this->assertSame(['min' => 0, 'max' => 48], self::$filterInstance->validate(['min' => 0, 'max' => 48]));
        $this->assertSame(['min' => 0, 'max' => 38], self::$filterInstance->validate(['min' => 38, 'max' => 'test']));

        $this->assertSame(['min' => 50, 'max' => 80], self::$filterInstance->validate(['min' => 50, 'max' => 80]));
    }

    public function test_can_check_validation_rejects_values_fault_configs(): void
    {
        self::$filterInstance->config(['minRange' => 0, 'maxRange' => 100]);
        $this->assertFalse(self::$filterInstance->validate(['min' => -6, 'max' => 2200]));
        $this->assertSame(['min' => 15, 'max' => 50], self::$filterInstance->validate(['min' => 15, 'max' => 50]));
    }

    public function test_can_get_filter_options(): void
    {
        $this->assertSame(config('livewire-tables.numberRange.defaultOptions'), self::$filterInstance->getOptions());

        self::$filterInstance->options(['foo' => 'bar']);
        $this->assertSame(['min' => 0, 'max' => 100, 'foo' => 'bar'], self::$filterInstance->getOptions());
    }

    public function test_can_get_filter_keys(): void
    {
        $this->assertSame(['min', 'max'], self::$filterInstance->getKeys());
    }

    public function test_can_get_filter_default_value(): void
    {
        $this->assertSame([], self::$filterInstance->getDefaultValue());
    }

    public function test_can_get_filter_callback(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterCallback());

        self::$filterInstance
            ->filter(function (Builder $builder, array $values) {
                return $builder->where('breed_id', '>', $values['min'])
                    ->where('breed_id', '<', $values['max']);
            });

        $this->assertTrue(self::$filterInstance->hasFilterCallback());
        $this->assertIsCallable(self::$filterInstance->getFilterCallback());
    }

    public function test_can_get_filter_pill_title(): void
    {
        $this->assertSame('Active', self::$filterInstance->getFilterPillTitle());

        self::$filterInstance
            ->setFilterPillTitle('User Status');

        $this->assertSame('User Status', self::$filterInstance->getFilterPillTitle());
    }

    /*
    public function test_can_get_filter_pill_value(): void
    {
        $filter = NumberRangeFilter::make('Active')
            ->options(['foo' => 'bar']);

        $this->assertSame('bar', self::$filterInstance->getFilterPillValue('foo'));

        $filter = NumberRangeFilter::make('Active')
            ->options(['foo' => 'bar'])
            ->setFilterPillValues(['foo' => 'baz']);

        $this->assertSame('baz', self::$filterInstance->getFilterPillValue('foo'));
    }*/

    /*
    public function test_can_get_nested_filter_pill_value(): void
    {
        $filter = NumberRangeFilter::make('Active')
            ->options(['foo' => ['bar' => 'baz']]);

        $this->assertSame('baz', self::$filterInstance->getFilterPillValue('bar'));

        $filter = NumberRangeFilter::make('Active')
            ->options(['foo' => ['bar' => 'baz']])
            ->setFilterPillValues(['bar' => 'etc']);

        $this->assertSame('etc', self::$filterInstance->getFilterPillValue('bar'));
    }*/

    public function test_can_check_if_filter_has_configs(): void
    {
        $this->assertTrue(self::$filterInstance->hasConfigs());

        self::$filterInstance->config();

        $this->assertTrue(self::$filterInstance->hasConfigs());

    }

    public function test_can_check_filter_config_by_name(): void
    {
        self::$filterInstance
            ->config(['foo' => 'bar']);

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

    public function test_can_set_custom_filter_view(): void
    {
        $this->assertSame('livewire-tables::components.tools.filters.number-range', self::$filterInstance->getViewPath());
        self::$filterInstance->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', self::$filterInstance->getViewPath());
    }
}
