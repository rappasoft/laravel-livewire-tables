<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

#[Group('Filters')]
final class SelectFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = SelectFilter::make('Active')->options(['Cartman', 'Tux', 'May', 'Ben', 'Chico']);
        self::$extraFilterInputAttributes = [
            'wire:key' => 'test123-filter-select-active',
        ];

    }

    public function test_array_setup(): array
    {
        $optionsArray = ['Cartman', 'Tux', 'May', 'Ben', 'Chico'];
        $this->assertNotEmpty($optionsArray);

        return $optionsArray;
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

    public function test_can_not_set_filter_to_number(): void
    {
        $this->assertFalse(self::$filterInstance->validate(123));
        $this->assertFalse(self::$filterInstance->validate('123'));
    }

    public function test_can_not_set_filter_to_text(): void
    {
        $this->assertFalse(self::$filterInstance->validate('test'));
    }

    public function test_can_set_filter_to_valid(): void
    {
        $this->assertSame('1', self::$filterInstance->validate('1'));
    }

    public function test_can_get_if_filter_empty(): void
    {
        $this->assertTrue(self::$filterInstance->isEmpty(''));
        $this->assertFalse(self::$filterInstance->isEmpty('123'));
        $this->assertFalse(self::$filterInstance->isEmpty('test'));
    }

    public function test_can_check_if_can_set_default_value(): void
    {
        $this->assertNull(self::$filterInstance->getFilterDefaultValue());

        self::$filterInstance->setFilterDefaultValue('1');

        $this->assertSame('1', self::$filterInstance->getFilterDefaultValue());
    }

    public function test_can_set_custom_filter_view(): void
    {
        $this->assertSame('livewire-tables::components.tools.filters.select', self::$filterInstance->getViewPath());
        self::$filterInstance->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', self::$filterInstance->getViewPath());
    }

    public function test_can_set_select_filter_wireable_live(): void
    {
        $this->assertSame('live', self::$filterInstance->getWireableMethod());

        $this->assertSame('wire:model.live="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));

        self::$filterInstance->setWireBlur();

        $this->assertSame('blur', self::$filterInstance->getWireableMethod());
        $this->assertSame('wire:model.blur="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));

        self::$filterInstance->setWireDefer();

        $this->assertSame('defer', self::$filterInstance->getWireableMethod());
        $this->assertSame('wire:model="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));

        self::$filterInstance->setWireLive();
        $this->assertSame('live', self::$filterInstance->getWireableMethod());

        $this->assertSame('wire:model.live="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));

        self::$filterInstance->setWireDebounce(250);

        $this->assertSame('live.debounce.250ms', self::$filterInstance->getWireableMethod());
        $this->assertSame('wire:model.live.debounce.250ms="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));

        self::$filterInstance->setWireDebounce(500);

        $this->assertSame('live.debounce.500ms', self::$filterInstance->getWireableMethod());
        $this->assertSame('wire:model.live.debounce.500ms="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));

    }
}
