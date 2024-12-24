<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Filters;

use DateTime;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

#[Group('Filters')]
final class DateFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = DateFilter::make('Active');
        self::$extraFilterInputAttributes = [
            'max' => null,
            'min' => null,
            'placeholder' => null,
            'type' => 'date',
            'wire:key' => 'test123-filter-date-active',
        ];

    }

    public function test_can_not_set_date_filter_to_non_number(): void
    {
        $this->assertFalse(self::$filterInstance->validate('test'));
    }

    public function test_can_not_set_date_filter_to_number(): void
    {
        $this->assertFalse(self::$filterInstance->validate(123));
        $this->assertFalse(self::$filterInstance->validate('123'));
    }

    public function test_can_not_set_date_filter_to_invalid_date(): void
    {
        $this->assertFalse(self::$filterInstance->validate('123'));
        $this->assertFalse(self::$filterInstance->validate('Test'));
        $this->assertFalse(self::$filterInstance->validate('12/01/2001'));
        $this->assertFalse(self::$filterInstance->validate('12/01/201'));
        $this->assertFalse(self::$filterInstance->validate('12-01-201'));
        $this->assertFalse(self::$filterInstance->validate('12-01-2014'));
        $this->assertFalse(self::$filterInstance->validate('2014/01/01'));
        $this->assertSame('2020-01-01', self::$filterInstance->validate('2020-01-01'));
    }

    public function test_can_get_if_date_filter_empty(): void
    {
        $this->assertTrue(self::$filterInstance->isEmpty(''));
    }

    public function test_can_not_set_date_filter_to_invalid_date_custom_format(): void
    {
        $this->assertFalse(self::$filterInstance->validate('123'));
        $this->assertFalse(self::$filterInstance->validate('Test'));
        $this->assertFalse(self::$filterInstance->validate('12/01/2001'));
        $this->assertFalse(self::$filterInstance->validate('12/01/201'));
        $this->assertFalse(self::$filterInstance->validate('12-01-201'));
        $this->assertFalse(self::$filterInstance->validate('12-01-2014'));
        $this->assertFalse(self::$filterInstance->validate('2014/01/01'));
        $this->assertSame('2020-01-01', self::$filterInstance->validate('2020-01-01'));
    }

    public function test_can_check_if_can_set_pill_format(): void
    {

        $this->assertSame('d M Y', self::$filterInstance->getConfig('pillFormat'));

        self::$filterInstance->config(['pillFormat' => 'd-m-Y']);

        $this->assertSame('d-m-Y', self::$filterInstance->getConfig('pillFormat'));

    }

    /*public function test_validate_respects_config_dateformat(): void
    {
        $this->assertFalse(self::$filterInstance->validate('123'));
        $this->assertFalse(self::$filterInstance->validate('Test'));
        $this->assertFalse(self::$filterInstance->validate('12/01/2001'));
        $this->assertFalse(self::$filterInstance->validate('12/01/201'));
        $this->assertFalse(self::$filterInstance->validate('12-01-201'));
        $this->assertFalse(self::$filterInstance->validate('12-01-2014'));
        $this->assertFalse(self::$filterInstance->validate('2014/01/01'));
        $this->assertSame('2020-01-01', self::$filterInstance->validate('2020-01-01'));
    }*/

    public function test_can_get_filter_configs(): void
    {
        self::$filterInstance->config([]);

        $this->assertSame(['format' => 'Y-m-d',
            'pillFormat' => 'd M Y'], self::$filterInstance->getConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertSame(['format' => 'Y-m-d',
            'pillFormat' => 'd M Y', 'foo' => 'bar'], self::$filterInstance->getConfigs());
    }

    public function test_can_check_if_filter_has_configs(): void
    {
        self::$filterInstance->config([]);

        $this->assertTrue(self::$filterInstance->hasConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertTrue(self::$filterInstance->hasConfigs());
    }

    public function test_can_get_filter_callback(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterCallback());

        self::$filterInstance->filter(function (Builder $builder, string $value) {
            return $builder->whereDate('created_at', '>=', $value);
        });

        $this->assertTrue(self::$filterInstance->hasFilterCallback());
        $this->assertIsCallable(self::$filterInstance->getFilterCallback());
    }

    public function test_can_check_if_can_set_default_values(): void
    {
        $this->assertNull(self::$filterInstance->getFilterDefaultValue());

        self::$filterInstance->setFilterDefaultValue('2023-03-01');

        $this->assertSame('2023-03-01', self::$filterInstance->getFilterDefaultValue());
    }

    public function test_can_set_custom_filter_view(): void
    {
        $this->assertSame('livewire-tables::components.tools.filters.date', self::$filterInstance->getViewPath());
        self::$filterInstance->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', self::$filterInstance->getViewPath());
    }

    public function test_can_get_filter_pills_value(): void
    {
        $dateTime = (new DateTime('now'));

        $this->assertSame($dateTime->format('d M Y'), self::$filterInstance->getFilterPillValue($dateTime->format('Y-m-d')));
    }

    public function test_can_not_get_filter_pills_invalid_value(): void
    {
        $dateTime = (new DateTime('now'));

        $this->assertNull(self::$filterInstance->getFilterPillValue('2022-2111'));
    }

    public function test_can_set_text_filter_wireable_live(): void
    {

        $this->assertSame('live', self::$filterInstance->getWireableMethod());
        $this->assertSame('wire:model.live="filterComponents.active"', self::$filterInstance->getWireMethod('filterComponents.'.self::$filterInstance->getKey()));

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

    public function test_check_if_has_locale(): void
    {
        $this->assertFalse(self::$filterInstance->hasPillsLocale());
        self::$filterInstance->setPillsLocale('fr');
        $this->assertTrue(self::$filterInstance->hasPillsLocale());
    }

    public function test_check_if_can_get_locale(): void
    {
        $this->assertFalse(self::$filterInstance->hasPillsLocale());
        $this->assertSame('en', self::$filterInstance->getPillsLocale());
        self::$filterInstance->setPillsLocale('fr');
        $this->assertTrue(self::$filterInstance->hasPillsLocale());
        $this->assertSame('fr', self::$filterInstance->getPillsLocale());
        self::$filterInstance->setPillsLocale('de');
        $this->assertSame('de', self::$filterInstance->getPillsLocale());
        $this->assertTrue(self::$filterInstance->hasPillsLocale());
    }
}
