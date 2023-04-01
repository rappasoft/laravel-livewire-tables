<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

final class DateFilterTest extends FilterTestCase
{
    public static function setUpBeforeClass(): void
    {
        self::$filterInstance = DateFilter::make('Active');
    }

    /**
     * @test
     */
    public function test_can_not_set_date_filter_to_non_number(): void
    {
        $this->assertFalse(self::$filterInstance->validate('test'));
    }

    /**
     * @test
     */
    public function test_can_not_set_date_filter_to_number(): void
    {
        $this->assertFalse(self::$filterInstance->validate(123));
        $this->assertFalse(self::$filterInstance->validate('123'));
    }

    /**
     * @test
     */
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

    /**
     * @test
     */
    public function test_can_get_if_date_filter_empty(): void
    {
        $this->assertTrue(self::$filterInstance->isEmpty(''));
    }

    /**
     * @test
     */
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
}
