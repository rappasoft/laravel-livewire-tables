<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
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
    public function can_get_filter_default_value(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertNull($filter->getDefaultValue());

        $filter = MultiSelectFilter::make('Active');

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
}
