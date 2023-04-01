<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class DateFilterTest extends TestCase
{
    /** @test */
    public function can_get_filter_name(): void
    {
        $filter = DateFilter::make('Active');

        $this->assertSame('Active', $filter->getName());
    }

    /** @test */
    public function can_get_filter_key(): void
    {
        $filter = DateFilter::make('Active');

        $this->assertSame('active', $filter->getKey());
    }

    /** @test */
    public function can_get_filter_configs(): void
    {
        $filter = DateFilter::make('Active');

        $this->assertSame([], $filter->getConfigs());

        $filter->config(['foo' => 'bar']);

        $this->assertSame(['foo' => 'bar'], $filter->getConfigs());
    }

    /** @test */
    public function get_a_single_filter_config(): void
    {
        $filter = DateFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertSame('bar', $filter->getConfig('foo'));
    }

    /** @test */
    public function can_get_filter_default_value(): void
    {
        $filter = DateFilter::make('Active');

        $this->assertNull($filter->getDefaultValue());
    }

    /** @test */
    public function can_get_filter_callback(): void
    {
        $filter = DateFilter::make('Active');

        $this->assertFalse($filter->hasFilterCallback());

        $filter = DateFilter::make('Active')
            ->filter(function (Builder $builder, string $value) {
                return $builder->whereDate('created_at', ">=", $value);
            });

        $this->assertTrue($filter->hasFilterCallback());
        $this->assertIsCallable($filter->getFilterCallback());
    }

    /** @test */
    public function can_get_filter_pill_title(): void
    {
        $filter = DateFilter::make('Active');

        $this->assertSame('Active', $filter->getFilterPillTitle());

        $filter = DateFilter::make('Active')
            ->setFilterPillTitle('User Date');

        $this->assertSame('User Date', $filter->getFilterPillTitle());
    }

    /** @test */
    public function can_check_if_filter_has_configs(): void
    {
        $filter = DateFilter::make('Active');

        $this->assertFalse($filter->hasConfigs());

        $filter = DateFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfigs());
    }

    /** @test */
    public function can_check_filter_config_by_name(): void
    {
        $filter = DateFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfig('foo'));
        $this->assertFalse($filter->hasConfig('bar'));
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_menus(): void
    {
        $filter = DateFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromMenus());
        $this->assertTrue($filter->isVisibleInMenus());

        $filter->hiddenFromMenus();

        $this->assertTrue($filter->isHiddenFromMenus());
        $this->assertFalse($filter->isVisibleInMenus());
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_pills(): void
    {
        $filter = DateFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromPills());
        $this->assertTrue($filter->isVisibleInPills());

        $filter->hiddenFromPills();

        $this->assertTrue($filter->isHiddenFromPills());
        $this->assertFalse($filter->isVisibleInPills());
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_count(): void
    {
        $filter = DateFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromFilterCount());
        $this->assertTrue($filter->isVisibleInFilterCount());

        $filter->hiddenFromFilterCount();

        $this->assertTrue($filter->isHiddenFromFilterCount());
        $this->assertFalse($filter->isVisibleInFilterCount());
    }

    /** @test */
    public function can_check_if_filter_is_reset_by_clear_button(): void
    {
        $filter = DateFilter::make('Active');

        $this->assertTrue($filter->isResetByClearButton());

        $filter->notResetByClearButton();

        $this->assertFalse($filter->isResetByClearButton());
    }
    
    /** @test */
    public function can_not_set_date_filter_to_non_number(): void
    {
        $filter = DateFilter::make('Created Date');
        $this->assertFalse($filter->validate('test'));
    }

    /** @test */
    public function can_not_set_date_filter_to_number(): void
    {
        $filter = DateFilter::make('Created Date');
        $this->assertFalse($filter->validate(123));
        $this->assertFalse($filter->validate('123'));
    }

    /** @test */
    public function can_not_set_date_filter_to_invalid_date(): void
    {
        $filter = DateFilter::make('Created Date');
        $this->assertFalse($filter->validate('123'));
        $this->assertFalse($filter->validate('Test'));
        $this->assertFalse($filter->validate('12/01/2001'));
        $this->assertFalse($filter->validate('12/01/201'));
        $this->assertFalse($filter->validate('12-01-201'));
        $this->assertFalse($filter->validate('12-01-2014'));
        $this->assertFalse($filter->validate('2014/01/01'));
        $this->assertSame('2020-01-01', $filter->validate('2020-01-01'));
    }

    /** @test */
    public function can_get_if_date_filter_empty(): void
    {
        $filter = DateFilter::make('Active');
        $this->assertTrue($filter->isEmpty(''));
    }

    /** @test */
    public function can_not_set_date_filter_to_invalid_date_custom_format(): void
    {
        $filter = DateFilter::make('Created Date');
        $this->assertFalse($filter->validate('123'));
        $this->assertFalse($filter->validate('Test'));
        $this->assertFalse($filter->validate('12/01/2001'));
        $this->assertFalse($filter->validate('12/01/201'));
        $this->assertFalse($filter->validate('12-01-201'));
        $this->assertFalse($filter->validate('12-01-2014'));
        $this->assertFalse($filter->validate('2014/01/01'));
        $this->assertSame('2020-01-01', $filter->validate('2020-01-01'));
    }
}
