<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

abstract class FilterTestCase extends TestCase
{
    public $filterInstance;

    /** @test */
    public function can_get_filter_name(): void
    {
        $this->assertSame('Active', $this->filterInstance->getName());
    }

    /** @test */
    public function can_get_filter_key(): void
    {
        $this->assertSame('active', $this->filterInstance->getKey());
    }

    /** @test */
    public function can_get_filter_configs(): void
    {
        $this->assertSame([], $this->filterInstance->getConfigs());

        $filter->config(['foo' => 'bar']);

        $this->assertSame(['foo' => 'bar'], $this->filterInstance->getConfigs());
    }

    /** @test */
    public function get_a_single_filter_config(): void
    {
        $this->filterInstance->config(['foo' => 'bar']);

        $this->assertSame('bar', $this->filterInstance->getConfig('foo'));
    }

    /** @test */
    public function can_get_filter_default_value(): void
    {
        $this->assertNull($this->filterInstance->getDefaultValue());
    }

    /** @test */
    public function can_get_filter_callback(): void
    {
        $this->assertFalse($this->filterInstance->hasFilterCallback());

        $this->filterInstance->filter(function (Builder $builder, string $value) {
            return $builder->whereDate('created_at', ">=", $value);
        });

        $this->assertTrue($this->filterInstance->hasFilterCallback());
        $this->assertIsCallable($this->filterInstance->getFilterCallback());
    }

    /** @test */
    public function can_get_filter_pill_title(): void
    {
        $this->assertSame('Active', $this->filterInstance->getFilterPillTitle());

        $this->filterInstance->setFilterPillTitle('User Date');

        $this->assertSame('User Date', $this->filterInstance->getFilterPillTitle());
    }

    /** @test */
    public function can_check_if_filter_has_configs(): void
    {
        $this->assertFalse($this->filterInstance->hasConfigs());

        $this->filterInstance->config(['foo' => 'bar']);

        $this->assertTrue($this->filterInstance->hasConfigs());
    }

    /** @test */
    public function can_check_filter_config_by_name(): void
    {
        $this->filterInstance->config(['foo' => 'bar']);

        $this->assertTrue($this->filterInstance->hasConfig('foo'));
        $this->assertFalse($this->filterInstance->hasConfig('bar'));
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_menus(): void
    {
        $this->assertFalse($this->filterInstance->isHiddenFromMenus());
        $this->assertTrue($this->filterInstance->isVisibleInMenus());

        $this->filterInstance->hiddenFromMenus();

        $this->assertTrue($this->filterInstance->isHiddenFromMenus());
        $this->assertFalse($this->filterInstance->isVisibleInMenus());
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_pills(): void
    {
        $this->assertFalse($this->filterInstance->isHiddenFromPills());
        $this->assertTrue($this->filterInstance->isVisibleInPills());

        $this->filterInstance->hiddenFromPills();

        $this->assertTrue($this->filterInstance->isHiddenFromPills());
        $this->assertFalse($this->filterInstance->isVisibleInPills());
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_count(): void
    {
        $this->assertFalse($this->filterInstance->isHiddenFromFilterCount());
        $this->assertTrue($this->filterInstance->isVisibleInFilterCount());

        $this->filterInstance->hiddenFromFilterCount();

        $this->assertTrue($this->filterInstance->isHiddenFromFilterCount());
        $this->assertFalse($this->filterInstance->isVisibleInFilterCount());
    }

    /** @test */
    public function can_check_if_filter_is_reset_by_clear_button(): void
    {
        $this->assertTrue($this->filterInstance->isResetByClearButton());

        $this->filterInstance->notResetByClearButton();

        $this->assertFalse($this->filterInstance->isResetByClearButton());
    }
}
