<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

final class DateFilterTest extends FilterTestCase
{
    public function setUp(): void
    {
        $this->filterInstance = DateFilter::make('Created Date');
    }

    public function testCreateFilterInstance()
    {
        return DateFilter::make('Created Date');
    }

    /**
     * @depends testCreateFilterInstance
     */
    public function test_can_not_set_date_filter_to_non_number($filterInstance): void
    {
        $this->assertFalse($filterInstance->validate('test'));
    }

    /**
     * @test
     * @depends testCreateFilterInstance
     */
    public function test_can_not_set_date_filter_to_number($filterInstance): void
    {
        $this->assertFalse($filterInstance->validate(123));
        $this->assertFalse($filterInstance->validate('123'));
    }

    /**
     * @test
     * @depends testCreateFilterInstance
     */
    public function test_can_not_set_date_filter_to_invalid_date($filterInstance): void
    {
        $this->assertFalse($filterInstance->validate('123'));
        $this->assertFalse($filterInstance->validate('Test'));
        $this->assertFalse($filterInstance->validate('12/01/2001'));
        $this->assertFalse($filterInstance->validate('12/01/201'));
        $this->assertFalse($filterInstance->validate('12-01-201'));
        $this->assertFalse($filterInstance->validate('12-01-2014'));
        $this->assertFalse($filterInstance->validate('2014/01/01'));
        $this->assertSame('2020-01-01', $filterInstance->validate('2020-01-01'));
    }

    /**
     * @test
     * @depends testCreateFilterInstance
     */
    public function test_can_get_if_date_filter_empty($filterInstance): void
    {
        $this->assertTrue($filterInstance->isEmpty(''));
    }

    /**
     * @test
     * @depends testCreateFilterInstance
     */
    public function test_can_not_set_date_filter_to_invalid_date_custom_format($filterInstance): void
    {
        $this->assertFalse($filterInstance->validate('123'));
        $this->assertFalse($filterInstance->validate('Test'));
        $this->assertFalse($filterInstance->validate('12/01/2001'));
        $this->assertFalse(filterInstance->validate('12/01/201'));
        $this->assertFalse($filterInstance->validate('12-01-201'));
        $this->assertFalse(filterInstance->validate('12-01-2014'));
        $this->assertFalse($filterInstance->validate('2014/01/01'));
        $this->assertSame('2020-01-01', $filterInstance->validate('2020-01-01'));
    }
}
