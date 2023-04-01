<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

abstract class FilterTestCase extends TestCase
{
    protected static $filterInstance;

    /** @test */
    public function can_get_filter_name(): void
    {
        $this->assertSame('Active', self::$filterInstance->getName());
    }

    /** @test */
    public function can_get_filter_key(): void
    {
        $this->assertSame('active', self::$filterInstance->getKey());
    }

    /** @test */
    public function can_get_filter_configs(): void
    {
        self::$filterInstance->config([]);

        $this->assertSame([], self::$filterInstance->getConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertSame(['foo' => 'bar'], self::$filterInstance->getConfigs());
    }

    /** @test */
    public function get_a_single_filter_config(): void
    {
        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertSame('bar', self::$filterInstance->getConfig('foo'));
    }

    /** @test */
    public function can_get_filter_default_value(): void
    {
        $this->assertNull(self::$filterInstance->getDefaultValue());
    }

    /** @test */
    public function can_get_filter_pill_title(): void
    {
        $this->assertSame('Active', self::$filterInstance->getFilterPillTitle());

        self::$filterInstance->setFilterPillTitle('User Date');

        $this->assertSame('User Date', self::$filterInstance->getFilterPillTitle());
    }

    /** @test */
    public function can_check_if_filter_has_configs(): void
    {
        self::$filterInstance->config([]);

        $this->assertFalse(self::$filterInstance->hasConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertTrue(self::$filterInstance->hasConfigs());
    }

    /** @test */
    public function can_check_filter_config_by_name(): void
    {
        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertTrue(self::$filterInstance->hasConfig('foo'));
        $this->assertFalse(self::$filterInstance->hasConfig('bar'));
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_menus(): void
    {
        $this->assertFalse(self::$filterInstance->isHiddenFromMenus());
        $this->assertTrue(self::$filterInstance->isVisibleInMenus());

        self::$filterInstance->hiddenFromMenus();

        $this->assertTrue(self::$filterInstance->isHiddenFromMenus());
        $this->assertFalse(self::$filterInstance->isVisibleInMenus());
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_pills(): void
    {
        $this->assertFalse(self::$filterInstance->isHiddenFromPills());
        $this->assertTrue(self::$filterInstance->isVisibleInPills());

        self::$filterInstance->hiddenFromPills();

        $this->assertTrue(self::$filterInstance->isHiddenFromPills());
        $this->assertFalse(self::$filterInstance->isVisibleInPills());
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_count(): void
    {
        $this->assertFalse(self::$filterInstance->isHiddenFromFilterCount());
        $this->assertTrue(self::$filterInstance->isVisibleInFilterCount());

        self::$filterInstance->hiddenFromFilterCount();

        $this->assertTrue(self::$filterInstance->isHiddenFromFilterCount());
        $this->assertFalse(self::$filterInstance->isVisibleInFilterCount());
    }

    /** @test */
    public function can_check_if_filter_is_reset_by_clear_button(): void
    {
        $this->assertTrue(self::$filterInstance->isResetByClearButton());

        self::$filterInstance->notResetByClearButton();

        $this->assertFalse(self::$filterInstance->isResetByClearButton());
    }
}
