<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;

#[Group('Filters')]
final class NumberFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = NumberFilter::make('Active');
        self::$extraFilterInputAttributes = [
            'max' => null,
            'min' => null,
            'placeholder' => null,
            'type' => 'number',
            'wire:key' => 'test123-filter-number-active',
        ];

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
        $this->assertSame([], self::$filterInstance->getConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertSame(['foo' => 'bar'], self::$filterInstance->getConfigs());
    }

    public function test_get_a_single_filter_config(): void
    {
        self::$filterInstance
            ->config(['foo' => 'bar']);

        $this->assertSame('bar', self::$filterInstance->getConfig('foo'));
    }

    public function test_can_get_filter_default_value(): void
    {
        $this->assertNull(self::$filterInstance->getDefaultValue());
    }

    public function test_can_get_filter_callback(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterCallback());

        self::$filterInstance
            ->filter(function (Builder $builder, int $value) {
                return $builder->where('breed_id', '>', $value);
            });

        $this->assertTrue(self::$filterInstance->hasFilterCallback());
        $this->assertIsCallable(self::$filterInstance->getFilterCallback());
    }

    public function test_can_get_filter_pill_title(): void
    {
        $this->assertSame('Active', self::$filterInstance->getFilterPillTitle());

        self::$filterInstance->setFilterPillTitle('User Status');

        $this->assertSame('User Status', self::$filterInstance->getFilterPillTitle());
    }

    public function test_can_check_if_filter_has_configs(): void
    {
        $this->assertFalse(self::$filterInstance->hasConfigs());

        self::$filterInstance
            ->config(['foo' => 'bar']);

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

    public function test_can_not_set_number_filter_to_non_number(): void
    {
        $this->assertFalse(self::$filterInstance->validate('test'));
        $this->assertFalse(self::$filterInstance->validate(['test']));
    }

    public function test_can_set_number_filter_to_number(): void
    {
        $this->assertSame(123, self::$filterInstance->validate(123));
        $this->assertSame(123.51, self::$filterInstance->validate(123.51));
        $this->assertSame(123, self::$filterInstance->validate('123'));
        $this->assertSame(123.51, self::$filterInstance->validate('123.51'));

    }

    public function test_can_get_if_number_filter_empty(): void
    {
        $this->assertTrue(self::$filterInstance->isEmpty(''));
        $this->assertTrue(self::$filterInstance->isEmpty('q'));
        $this->assertFalse(self::$filterInstance->isEmpty('123'));
    }

    public function test_can_check_if_can_set_default_value(): void
    {
        $this->assertNull(self::$filterInstance->getFilterDefaultValue());

        self::$filterInstance->setFilterDefaultValue(123);

        $this->assertSame('123', self::$filterInstance->getFilterDefaultValue());
    }

    public function test_can_set_custom_filter_view(): void
    {
        $this->assertSame('livewire-tables::components.tools.filters.number', self::$filterInstance->getViewPath());
        self::$filterInstance->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', self::$filterInstance->getViewPath());
    }
}
