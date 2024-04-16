<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;

class MultiSelectDropdownFilterTest extends TestCase
{
    public array $optionsArray = [];

    public function testArraySetup(): array
    {
        $this->optionsArray = $optionsArray = array_values(['Cartman', 'Tux', 'May', 'Ben', 'Chico']);
        $this->assertNotEmpty($optionsArray);

        return $optionsArray;
    }

    /** @test */
    public function can_get_filter_name(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertSame('Active', $filter->getName());
    }

    /** @test */
    public function can_get_filter_key(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertSame('active', $filter->getKey());
    }

    /** @test */
    public function can_get_filter_configs(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertSame([], $filter->getConfigs());

        $filter->config(['foo' => 'bar']);

        $this->assertSame(['foo' => 'bar'], $filter->getConfigs());
    }

    /** @test */
    public function get_a_single_filter_config(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertSame('bar', $filter->getConfig('foo'));
    }

    /** @test */
    public function can_get_filter_default_value(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertSame([], $filter->getDefaultValue());
    }

    /** @test */
    public function can_get_filter_callback(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertFalse($filter->hasFilterCallback());

        $filter = MultiSelectDropdownFilter::make('Active')
            ->filter(function (Builder $builder, int $value) {
                return $builder->where('name', '=', $value);
            });

        $this->assertTrue($filter->hasFilterCallback());
        $this->assertIsCallable($filter->getFilterCallback());
    }

    /** @test */
    public function can_get_filter_pill_title(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertSame('Active', $filter->getFilterPillTitle());

        $filter = MultiSelectDropdownFilter::make('Active')
            ->setFilterPillTitle('User Status');

        $this->assertSame('User Status', $filter->getFilterPillTitle());
    }

    /**
     * @test
     *
     * @depends testArraySetup
     */
    public function can_get_filter_pill_value(array $optionsArray): void
    {
        $filter = MultiSelectDropdownFilter::make('Active')->options($optionsArray);
        $this->assertSame($optionsArray[1], $filter->getFilterPillValue(['1']));
        $this->assertSame($optionsArray[1].', '.$optionsArray[2], $filter->getFilterPillValue(['1', '2']));
    }

    /** @test */
    public function can_check_if_filter_has_configs(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertFalse($filter->hasConfigs());

        $filter = MultiSelectDropdownFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfigs());
    }

    /** @test */
    public function can_check_filter_config_by_name(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfig('foo'));
        $this->assertFalse($filter->hasConfig('bar'));
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_menus(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromMenus());
        $this->assertTrue($filter->isVisibleInMenus());

        $filter->hiddenFromMenus();

        $this->assertTrue($filter->isHiddenFromMenus());
        $this->assertFalse($filter->isVisibleInMenus());
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_pills(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromPills());
        $this->assertTrue($filter->isVisibleInPills());

        $filter->hiddenFromPills();

        $this->assertTrue($filter->isHiddenFromPills());
        $this->assertFalse($filter->isVisibleInPills());
    }

    /** @test */
    public function can_check_if_filter_is_hidden_from_count(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromFilterCount());
        $this->assertTrue($filter->isVisibleInFilterCount());

        $filter->hiddenFromFilterCount();

        $this->assertTrue($filter->isHiddenFromFilterCount());
        $this->assertFalse($filter->isVisibleInFilterCount());
    }

    /** @test */
    public function can_check_if_filter_is_reset_by_clear_button(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active');

        $this->assertTrue($filter->isResetByClearButton());

        $filter->notResetByClearButton();

        $this->assertFalse($filter->isResetByClearButton());
    }

    /**
     * @test
     *
     * @depends testArraySetup
     */
    public function can_set_filter_to_number(array $optionsArray): void
    {
        $filter = MultiSelectDropdownFilter::make('BreedID')->options($optionsArray);
        $this->assertSame(123, $filter->validate(123));
        $this->assertSame('123', $filter->validate('123'));
    }

    /**
     * @test
     *
     * @depends testArraySetup
     */
    public function can_set_filter_to_valid_value(array $optionsArray): void
    {
        $filter = MultiSelectDropdownFilter::make('BreedID')->options($optionsArray);
        $this->assertSame($optionsArray, $filter->getOptions());
        $this->assertSame(['1', '3'], $filter->validate([0 => '1', 1 => '3']));
        $this->assertSame(['1', '3'], $filter->validate([0 => '1', 1 => '3', 2 => '99']));
    }

    /** @test */
    public function can_get_if_filter_empty(): void
    {
        $filter = MultiSelectDropdownFilter::make('Active');
        $this->assertTrue($filter->isEmpty(['all']));
        $this->assertTrue($filter->isEmpty(''));
        $this->assertFalse($filter->isEmpty([]));
        $this->assertTrue($filter->isEmpty('123'));
        $this->assertTrue($filter->isEmpty('test'));
        $this->assertFalse($filter->isEmpty([1]));
    }

    /**
     * @test
     *
     * @depends testArraySetup
     */
    public function can_set_filter_first_option(array $optionsArray): void
    {
        $filter = MultiSelectDropdownFilter::make('BreedID')->options($optionsArray);
        $this->assertSame('', $filter->getFirstOption());
        $filter->setFirstOption('all');
        $this->assertSame('all', $filter->getFirstOption());
    }

    /**
     * @test
     *
     * @depends testArraySetup
     */
    public function test_can_check_if_can_set_default_value(array $optionsArray): void
    {
        $filter = MultiSelectDropdownFilter::make('BreedID')->options($optionsArray);

        $this->assertSame([], $filter->getFilterDefaultValue());

        $filter->setFilterDefaultValue(['1', '3']);

        $this->assertSame(['1', '3'], $filter->getFilterDefaultValue());
    }

    /**
     * @test
     *
     * @depends testArraySetup
     */
    public function can_set_custom_filter_view(array $optionsArray): void
    {
        $filter = MultiSelectDropdownFilter::make('BreedID')->options($optionsArray);
        $this->assertSame('livewire-tables::components.tools.filters.multi-select-dropdown', $filter->getViewPath());
        $filter->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', $filter->getViewPath());
    }

    /**
     * @test
     *
     * @depends testArraySetup
     */
    public function test_can_set_select_filter_wireable_live(): void
    {

        $filter = MultiSelectDropdownFilter::make('Active')->options($optionsArray);

        $this->assertSame('live.debounce.250ms', $filter->getWireableMethod());

        $this->assertSame('wire:model.live.debounce.250ms=filterComponents.active', $filter->getWireMethod('filterComponents.'.$filter->getKey()));

        $filter->setWireBlur();

        $this->assertSame('blur', $filter->getWireableMethod());
        $this->assertSame('wire:model.blur=filterComponents.active', $filter->getWireMethod('filterComponents.'.$filter->getKey()));

        $filter->setWireDefer();

        $this->assertSame('defer', $filter->getWireableMethod());
        $this->assertSame('wire:model=filterComponents.active', $filter->getWireMethod('filterComponents.'.$filter->getKey()));

        $filter->setWireDebounce(250);

        $this->assertSame('live.debounce.250ms', $filter->getWireableMethod());
        $this->assertSame('wire:model.live.debounce.250ms=filterComponents.active', $filter->getWireMethod('filterComponents.'.$filter->getKey()));

        $filter->setWireDebounce(500);

        $this->assertSame('live.debounce.500ms', $filter->getWireableMethod());
        $this->assertSame('wire:model.live.debounce.500ms=filterComponents.active', $filter->getWireMethod('filterComponents.'.$filter->getKey()));

    }
}
