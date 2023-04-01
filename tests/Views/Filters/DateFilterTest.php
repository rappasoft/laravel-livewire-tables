<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

final class DateFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        $this->filterType = DateFilter::class;
        $this->filterInstance = DateFilter::make('Created Date');
    }
    
    /** @test */
    public function can_not_set_date_filter_to_non_number(): void
    {
        $filter = $this->filterType::make('Created Date');
        $this->assertFalse($filter->validate('test'));
    }

    /** @test */
    public function can_not_set_date_filter_to_number(): void
    {
        $filter = $this->filterType::make('Created Date');
        $this->assertFalse($filter->validate(123));
        $this->assertFalse($filter->validate('123'));
    }

    /** @test */
    public function can_not_set_date_filter_to_invalid_date(): void
    {
        $filter = $this->filterType::make('Created Date');
        $this->assertFalse($filter->validate('123'));
        $this->assertFalse($filter->validate('Test'));
        $this->assertFalse($filter->validate('12/01/2001'));
        $this->assertFalse($filter->validate('12/01/201'));
        $this->assertFalse($filter->validate('12-01-201'));
        $this->assertFalse($filter->validate('12-01-2014'));
        $this->assertFalse($filter->validate('2014/01/01'));
        $this->assertSame('2020-01-01', $filter->validate('2020-01-01'));
    }

    /** @test */
    public function can_get_if_date_filter_empty(): void
    {
        $filter = $this->filterType::make('Active');
        $this->assertTrue($filter->isEmpty(''));
    }

    /** @test */
    public function can_not_set_date_filter_to_invalid_date_custom_format(): void
    {
        $filter = $this->filterType::make('Created Date');
        $this->assertFalse($filter->validate('123'));
        $this->assertFalse($filter->validate('Test'));
        $this->assertFalse($filter->validate('12/01/2001'));
        $this->assertFalse($filter->validate('12/01/201'));
        $this->assertFalse($filter->validate('12-01-201'));
        $this->assertFalse($filter->validate('12-01-2014'));
        $this->assertFalse($filter->validate('2014/01/01'));
        $this->assertSame('2020-01-01', $filter->validate('2020-01-01'));
    }
}
