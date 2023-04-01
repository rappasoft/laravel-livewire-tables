<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

final class DateFilterTest extends FilterTestCase
{
    public static function setUpBeforeClass(): void
    {
        $this->filterType = DateFilter::class;
        $this->filterInstance = DateFilter::make('Created Date');
    }

    /** @test */
    public function can_not_set_date_filter_to_non_number(): void
    {
        $this->assertFalse($this->filterInstance->validate('test'));
    }

    /** @test */
    public function can_not_set_date_filter_to_number(): void
    {
        $this->assertFalse($this->filterInstance->validate(123));
        $this->assertFalse($this->filterInstance->validate('123'));
    }

    /** @test */
    public function can_not_set_date_filter_to_invalid_date(): void
    {
        $this->assertFalse($this->filterInstance->validate('123'));
        $this->assertFalse($this->filterInstance->validate('Test'));
        $this->assertFalse($this->filterInstance->validate('12/01/2001'));
        $this->assertFalse($this->filterInstance->validate('12/01/201'));
        $this->assertFalse($this->filterInstance->validate('12-01-201'));
        $this->assertFalse($this->filterInstance->validate('12-01-2014'));
        $this->assertFalse($this->filterInstance->validate('2014/01/01'));
        $this->assertSame('2020-01-01', $this->filterInstance->validate('2020-01-01'));
    }

    /** @test */
    public function can_get_if_date_filter_empty(): void
    {
        $this->assertTrue($this->filterInstance->isEmpty(''));
    }

    /** @test */
    public function can_not_set_date_filter_to_invalid_date_custom_format(): void
    {
        $this->assertFalse($this->filterInstance->validate('123'));
        $this->assertFalse($this->filterInstance->validate('Test'));
        $this->assertFalse($this->filterInstance->validate('12/01/2001'));
        $this->assertFalse($this->filterInstance->validate('12/01/201'));
        $this->assertFalse($this->filterInstance->validate('12-01-201'));
        $this->assertFalse($this->filterInstance->validate('12-01-2014'));
        $this->assertFalse($this->filterInstance->validate('2014/01/01'));
        $this->assertSame('2020-01-01', $this->filterInstance->validate('2020-01-01'));
    }
}
