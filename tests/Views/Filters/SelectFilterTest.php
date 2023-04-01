<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class SelectFilterTest extends TestCase
{
    public function testArraySetup(): array
    {
        $optionsArray = ['Cartman', 'Tux', 'May', 'Ben', 'Chico'];
        $this->assertNotEmpty($optionsArray);

        return $optionsArray;
    }

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
    public function can_get_filter_default_value(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertNull($filter->getDefaultValue());
    }

    /** @test */
    public function can_get_filter_callback(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->hasFilterCallback());

        $filter = SelectFilter::make('Active')
            ->filter(function (Builder $builder, int $value) {
                return $builder->where('name', "=", $value);
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
    
    /**
    * @test
    * @depends testArraySetup
    */
    public function can_not_set_filter_to_number(array $optionsArray): void
    {
        $filter = SelectFilter::make('BreedID')->options($optionsArray);
        $this->assertFalse($filter->validate(123));
        $this->assertFalse($filter->validate('123'));
    }
    
    /**
    * @test
    * @depends testArraySetup
    */
    public function can_not_set_filter_to_text(array $optionsArray): void
    {
        $filter = SelectFilter::make('BreedID')->options($optionsArray);
        $this->assertFalse($filter->validate('test'));
    }

        /**
    * @test
    * @depends testArraySetup
    */
    public function can_set_filter_to_valid(array $optionsArray): void
    {
        $filter = SelectFilter::make('BreedID')->options($optionsArray);
        $this->assertSame('1', $filter->validate('1'));
    }

    /**
    * @test
    * @depends testArraySetup
    */
    public function can_get_if_filter_empty(array $optionsArray): void
    {
        $filter = SelectFilter::make('BreedID')->options($optionsArray);
        $this->assertTrue($filter->isEmpty(''));
        $this->assertFalse($filter->isEmpty('123'));
        $this->assertFalse($filter->isEmpty('test'));
    }
}
