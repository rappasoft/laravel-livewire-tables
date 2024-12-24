<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

#[Group('Filters')]
final class MultiSelectFilterTest extends FilterTestCase
{
    public array $optionsArray = [];

    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = MultiSelectFilter::make('Active');
    }

    public function test_array_setup(): array
    {
        $this->optionsArray = $optionsArray = array_values(['Cartman', 'Tux', 'May', 'Ben', 'Chico']);
        $this->assertNotEmpty($optionsArray);

        return $optionsArray;
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

        self::$filterInstance->config([]);
    }

    public function test_get_a_single_filter_config(): void
    {
        self::$filterInstance
            ->config(['foo' => 'bar']);

        $this->assertSame('bar', self::$filterInstance->getConfig('foo'));
    }

    public function test_can_get_filter_default_value(): void
    {
        $this->assertSame([], self::$filterInstance->getDefaultValue());
    }

    public function test_can_get_filter_callback(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterCallback());

        self::$filterInstance
            ->filter(function (Builder $builder, int $value) {
                return $builder->where('name', '=', $value);
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

    public function test_can_check_if_filter_has_configs(): void
    {
        $this->assertFalse(self::$filterInstance->hasConfigs());

        self::$filterInstance
            ->config(['foo' => 'bar']);

        $this->assertTrue(self::$filterInstance->hasConfigs());
    }

    public function test_can_check_filter_config_by_name(): void
    {
        self::$filterInstance->config(['foo' => 'bar']);

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

    #[Depends('test_array_setup')]
    public function test_can_set_filter_to_number(array $optionsArray): void
    {
        self::$filterInstance->options($optionsArray);
        $this->assertSame(123, self::$filterInstance->validate(123));
        $this->assertSame('123', self::$filterInstance->validate('123'));
    }

    #[Depends('test_array_setup')]
    public function test_can_set_filter_to_valid_value(array $optionsArray): void
    {
        self::$filterInstance->options($optionsArray);
        $this->assertSame($optionsArray, self::$filterInstance->getOptions());
        $this->assertSame(['1', '3'], self::$filterInstance->validate([0 => '1', 1 => '3']));
        $this->assertSame(['1', '3'], self::$filterInstance->validate([0 => '1', 1 => '3', 2 => '99']));
    }

    public function test_can_get_if_filter_empty(): void
    {
        $this->assertTrue(self::$filterInstance->isEmpty(''));
        $this->assertTrue(self::$filterInstance->isEmpty([]));
        $this->assertTrue(self::$filterInstance->isEmpty('123'));
        $this->assertTrue(self::$filterInstance->isEmpty('test'));
        $this->assertFalse(self::$filterInstance->isEmpty([1]));
    }

    public function test_can_set_custom_filter_view(): void
    {
        $this->assertSame('livewire-tables::components.tools.filters.multi-select', self::$filterInstance->getViewPath());
        self::$filterInstance->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', self::$filterInstance->getViewPath());
    }

    public function test_can_set_select_filter_wireable_live(): void
    {
        $this->assertSame('live.debounce.250ms', self::$filterInstance->getWireableMethod());

        $this->assertSame('wire:model.live.debounce.250ms="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));

        self::$filterInstance->setWireBlur();

        $this->assertSame('blur', self::$filterInstance->getWireableMethod());
        $this->assertSame('wire:model.blur="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));

        self::$filterInstance->setWireLive();

        $this->assertSame('live', self::$filterInstance->getWireableMethod());
        $this->assertSame('wire:model.live="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));

        self::$filterInstance->setWireDefer();

        $this->assertSame('defer', self::$filterInstance->getWireableMethod());
        $this->assertSame('wire:model="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));

        self::$filterInstance->setWireDebounce(250);

        $this->assertSame('live.debounce.250ms', self::$filterInstance->getWireableMethod());
        $this->assertSame('wire:model.live.debounce.250ms="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));

        self::$filterInstance->setWireDebounce(500);

        $this->assertSame('live.debounce.500ms', self::$filterInstance->getWireableMethod());
        $this->assertSame('wire:model.live.debounce.500ms="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));
    }

    public function test_can_set_separator(): void
    {
        $this->assertSame(', ', self::$filterInstance->getPillsSeparator());
        self::$filterInstance->setPillsSeparator('<br />');
        $this->assertSame('<br />', self::$filterInstance->getPillsSeparator());
    }
}
