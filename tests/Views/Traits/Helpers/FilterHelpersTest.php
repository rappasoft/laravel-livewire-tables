<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class FilterHelpersTest extends TestCase
{
    /** @test */
    public function can_get_filter_name(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertSame('Active', $filter->getName());
    }

    /** @test */
    public function can_get_filter_key(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertSame('active', $filter->getKey());
    }

    /** @test */
    public function can_get_filter_configs(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertSame([], $filter->getConfigs());

        $filter->config(['foo' => 'bar']);

        $this->assertSame(['foo' => 'bar'], $filter->getConfigs());
    }

    /** @test */
    public function get_a_single_filter_config(): void
    {
        $filter = SelectFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertSame('bar', $filter->getConfig('foo'));
    }

    /** @test */
    public function can_get_filter_keys(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertSame([], $filter->getKeys());

        $filter->options(['foo' => 'bar']);

        $this->assertSame(['foo'], $filter->getKeys());
    }

    /** @test */
    public function can_get_nested_filter_keys(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertSame([], $filter->getKeys());

        $filter->options(['foo' => ['bar' => 'baz']]);

        $this->assertSame(['bar'], $filter->getKeys());

        $filter->options(['foo' => collect(['bar' => 'baz'])]);

        $this->assertSame(['bar'], $filter->getKeys());
    }

    /** @test */
    public function can_get_filter_default_value(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertNull($filter->getDefaultValue());

        $filter = MultiSelectFilter::make('Active');

        $this->assertSame([], $filter->getDefaultValue());

        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertSame([], $filter->getDefaultValue());
    }

    /** @test */
    public function can_get_filter_callback(): void
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

    /** @test */
    public function can_get_filter_pill_title(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertSame('Active', $filter->getFilterPillTitle());

        $filter = SelectFilter::make('Active')
            ->setFilterPillTitle('User Status');

        $this->assertSame('User Status', $filter->getFilterPillTitle());
    }

    /** @test */
    public function can_get_filter_pill_value(): void
    {
        $filter = SelectFilter::make('Active')
            ->options(['foo' => 'bar']);

        $this->assertSame('bar', $filter->getFilterPillValue('foo'));

        $filter = SelectFilter::make('Active')
            ->options(['foo' => 'bar'])
            ->setFilterPillValues(['foo' => 'baz']);

        $this->assertSame('baz', $filter->getFilterPillValue('foo'));
    }

    /** @test */
    public function can_get_nested_filter_pill_value(): void
    {
        $filter = SelectFilter::make('Active')
            ->options(['foo' => ['bar' => 'baz']]);

        $this->assertSame('baz', $filter->getFilterPillValue('bar'));

        $filter = SelectFilter::make('Active')
            ->options(['foo' => ['bar' => 'baz']])
            ->setFilterPillValues(['bar' => 'etc']);

        $this->assertSame('etc', $filter->getFilterPillValue('bar'));
    }

    /** @test */
    public function can_check_if_filter_has_configs(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->hasConfigs());

        $filter = SelectFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfigs());
    }

    /** @test */
    public function can_check_filter_config_by_name(): void
    {
        $filter = SelectFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfig('foo'));
        $this->assertFalse($filter->hasConfig('bar'));
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_menus(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromMenus());
        $this->assertTrue($filter->isVisibleInMenus());

        $filter->hiddenFromMenus();

        $this->assertTrue($filter->isHiddenFromMenus());
        $this->assertFalse($filter->isVisibleInMenus());
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_pills(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromPills());
        $this->assertTrue($filter->isVisibleInPills());

        $filter->hiddenFromPills();

        $this->assertTrue($filter->isHiddenFromPills());
        $this->assertFalse($filter->isVisibleInPills());
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_count(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromFilterCount());
        $this->assertTrue($filter->isVisibleInFilterCount());

        $filter->hiddenFromFilterCount();

        $this->assertTrue($filter->isHiddenFromFilterCount());
        $this->assertFalse($filter->isVisibleInFilterCount());
    }

    /** @test */
    public function can_check_if_filter_is_reset_by_clear_button(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertTrue($filter->isResetByClearButton());

        $filter->notResetByClearButton();

        $this->assertFalse($filter->isResetByClearButton());
    }

    /** @test */
    public function can_check_if_filter_has_slidedown_row(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->hasFilterSlidedownRow());

        $filter->setFilterSlidedownRow('2');

        $this->assertTrue($filter->hasFilterSlidedownRow());

        $filter->setFilterSlidedownRow(3);

        $this->assertTrue($filter->hasFilterSlidedownRow());
    }

    /** @test */
    public function filter_slidedown_row_returns_int(): void
    {
        $filter = SelectFilter::make('Active');

        $filter->setFilterSlidedownRow(2);

        $this->assertIsInt($filter->getFilterSlidedownRow());

        $filter->setFilterSlidedownRow("3");

        $this->assertIsInt($filter->getFilterSlidedownRow());
    }

    /** @test */
    public function can_get_filter_slidedown_row(): void
    {
        $filter = SelectFilter::make('Active')->setFilterSlidedownRow("2");

        $this->assertSame(2, $filter->getFilterSlidedownRow());

        $filter->setFilterSlidedownRow(3);

        $this->assertSame(3, $filter->getFilterSlidedownRow());
    }

    /** @test */
    public function can_check_if_filter_has_slidedown_colspan(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->hasFilterSlidedownColspan());

        $filter->setFilterSlidedownColspan('2');

        $this->assertTrue($filter->hasFilterSlidedownColspan());

        $filter->setFilterSlidedownColspan(2);

        $this->assertTrue($filter->hasFilterSlidedownColspan());
    }

    /** @test */
    public function filter_slidedown_colspan_returns_int(): void
    {
        $filter = SelectFilter::make('Active');

        $filter->setFilterSlidedownColspan(2);

        $this->assertIsInt($filter->getFilterSlidedownColspan());

        $filter->setFilterSlidedownColspan("3");

        $this->assertIsInt($filter->getFilterSlidedownColspan());
    }

    /** @test */
    public function can_get_filter_slidedown_colspan(): void
    {
        $filter = SelectFilter::make('Active')->setFilterSlidedownColspan("2");

        $this->assertSame(2, $filter->getFilterSlidedownColspan());

        $filter->setFilterSlidedownColspan(3);

        $this->assertSame(3, $filter->getFilterSlidedownColspan());
    }
}
