<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;

final class DateTimeFilterTest extends FilterTestCase
{
    public static function setUp(): void
    {
        self::$filterInstance = DateTimeFilter::make('Active');
    }

    /** @test */
    public function can_get_filter_callback(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterCallback());

        self::$filterInstance->filter(function (Builder $builder, string $value) {
            return $builder->whereDate('created_at', ">=", $value);
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
}
