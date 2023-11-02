<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

final class DateFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
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

    /**
     * @test
     */
    public function test_can_check_if_can_set_pill_format(): void
    {

        $this->assertSame('d M Y', self::$filterInstance->getConfig('pillFormat'));

        self::$filterInstance->config(['pillFormat' => 'd-m-Y']);

        $this->assertSame('d-m-Y', self::$filterInstance->getConfig('pillFormat'));

    }

    /**
     * @test
     */
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

    /** @test */
    public function can_get_filter_configs(): void
    {
        self::$filterInstance->config([]);

        $this->assertSame(['format' => 'Y-m-d',
            'pillFormat' => 'd M Y'], self::$filterInstance->getConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertSame(['format' => 'Y-m-d',
            'pillFormat' => 'd M Y', 'foo' => 'bar'], self::$filterInstance->getConfigs());
    }

    /** @test */
    public function can_check_if_filter_has_configs(): void
    {
        self::$filterInstance->config([]);

        $this->assertTrue(self::$filterInstance->hasConfigs());

        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertTrue(self::$filterInstance->hasConfigs());
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

    /**
     * @test
     */
    public function test_can_check_if_can_set_default_values(): void
    {
        $this->assertNull(self::$filterInstance->getFilterDefaultValue());

        self::$filterInstance->setFilterDefaultValue('2023-03-01');

        $this->assertSame('2023-03-01', self::$filterInstance->getFilterDefaultValue());
    }

    /**
     * @test
     */
    public function can_set_custom_filter_view(): void
    {
        $this->assertSame('livewire-tables::components.tools.filters.date', self::$filterInstance->getViewPath());
        self::$filterInstance->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', self::$filterInstance->getViewPath());
    }
}
