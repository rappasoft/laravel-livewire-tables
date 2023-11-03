<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;

final class DateTimeFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = DateTimeFilter::make('Active');
    }

    /** @test */
    public function can_get_filter_callback(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterCallback());

        self::$filterInstance->filter(function (Builder $builder, string $value) {
            return $builder->whereDate('created_at', '>=', $value);
        });

        $this->assertTrue(self::$filterInstance->hasFilterCallback());
        $this->assertIsCallable(self::$filterInstance->getFilterCallback());
    }

    /** @test */
    public function can_not_set_date_filter_to_non_number(): void
    {
        $this->assertFalse(self::$filterInstance->validate('test'));
    }

    /** @test */
    public function can_not_set_datetime_filter_to_number(): void
    {
        $this->assertFalse(self::$filterInstance->validate(123));
        $this->assertFalse(self::$filterInstance->validate('123'));
    }

    /** @test */
    public function can_not_set_datetime_filter_to_invalid_date(): void
    {
        $this->assertFalse(self::$filterInstance->validate('Test'));
        $this->assertFalse(self::$filterInstance->validate('12/01/2001 13:00'));
        $this->assertFalse(self::$filterInstance->validate('12/01/201 17:00'));
        $this->assertFalse(self::$filterInstance->validate('12-01-201 14:00'));
        $this->assertFalse(self::$filterInstance->validate('12-01-2014 11:00'));
        $this->assertFalse(self::$filterInstance->validate('2014/01/01 12:00'));
        $this->assertSame('2020-02-01T12:00', self::$filterInstance->validate('2020-02-01T12:00'));
    }

    /** @test */
    public function can_not_omit_time_from_datetime_filter(): void
    {
        $this->assertFalse(self::$filterInstance->validate('2020-01-01'));
    }

    /** @test */
    public function can_get_if_datetime_filter_empty(): void
    {
        $this->assertTrue(self::$filterInstance->isEmpty(''));
        $this->assertFalse(self::$filterInstance->isEmpty('2020-01-01 00:22'));
    }

    /** @test */
    public function can_not_set_datetime_filter_to_invalid_date_custom_format(): void
    {
        $this->assertFalse(self::$filterInstance->validate('Test'));
        $this->assertFalse(self::$filterInstance->validate('12/01/2001 13:00'));
        $this->assertFalse(self::$filterInstance->validate('12/01/201 17:00'));
        $this->assertFalse(self::$filterInstance->validate('12-01-201 14:00'));
        $this->assertFalse(self::$filterInstance->validate('12-01-2014 11:00'));
        $this->assertFalse(self::$filterInstance->validate('2014/01/01 12:00'));
        $this->assertSame('2020-02-01T12:00', self::$filterInstance->validate('2020-02-01T12:00'));
    }

    /** @test */
    public function can_get_filter_configs(): void
    {

        $this->assertSame(['format' => 'Y-m-d\TH:i', 'pillFormat' => 'd M Y - H:i'], self::$filterInstance->getConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertSame(['format' => 'Y-m-d\TH:i', 'pillFormat' => 'd M Y - H:i', 'foo' => 'bar'], self::$filterInstance->getConfigs());
    }

    /** @test */
    public function can_check_if_filter_has_configs(): void
    {
        self::$filterInstance->config([]);

        $this->assertTrue(self::$filterInstance->hasConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertTrue(self::$filterInstance->hasConfigs());
    }

    /**
     * @test
     */
    public function test_can_check_if_can_set_pill_format(): void
    {
        self::$filterInstance->config([]);

        $this->assertSame('d M Y - H:i', self::$filterInstance->getConfig('pillFormat'));

        self::$filterInstance->config(['pillFormat' => 'd-M-Y - H:i']);

        $this->assertSame('d-M-Y - H:i', self::$filterInstance->getConfig('pillFormat'));

    }

    /**
     * @test
     */
    public function test_can_check_if_can_set_default_values(): void
    {
        $this->assertNull(self::$filterInstance->getFilterDefaultValue());

        self::$filterInstance->setFilterDefaultValue('2023-01-01T10:00');

        $this->assertSame('2023-01-01T10:00', self::$filterInstance->getFilterDefaultValue());
    }

    /**
     * @test
     */
    public function can_set_custom_filter_view(): void
    {
        $this->assertSame('livewire-tables::components.tools.filters.datetime', self::$filterInstance->getViewPath());
        self::$filterInstance->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', self::$filterInstance->getViewPath());
    }

    /**
     * @test
     */
    public function test_can_get_filter_pills_value(): void
    {
        $dateTime = (new DateTime('now'));

        $this->assertSame($dateTime->format('d M Y - H:i'), self::$filterInstance->getFilterPillValue($dateTime->format('Y-m-d\TH:i')));
    }

    /**
     * @test
     */
    public function test_can_not_get_filter_pills_invalid_value(): void
    {
        $dateTime = (new DateTime('now'));

        $this->assertSame($dateTime->format('d M Y'), self::$filterInstance->getFilterPillValue('2022-1111'));
    }
}
