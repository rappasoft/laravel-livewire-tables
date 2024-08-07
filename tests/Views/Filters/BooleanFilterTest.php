<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filters\BooleanFilter;

final class BooleanFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = BooleanFilter::make('Active');
    }

    public function test_can_not_set_boolean_filter_to_non_number(): void
    {
        $this->assertFalse(self::$filterInstance->validate('test'));
    }

    public function test_can_set_boolean_filter_to_bool(): void
    {
        $this->assertTrue(self::$filterInstance->validate(true));
    }

    public function test_can_set_boolean_filter_to_integer(): void
    {
        $this->assertTrue(self::$filterInstance->validate(1));
    }

    public function test_can_get_custom_filter_pills(): void
    {
        $filter = self::$filterInstance;
        $filter->setFilterPillValues([
            true => 'Active',
            false => 'Inactive',
        ]);
        $this->assertSame('Active', $filter->getFilterPillValue(1));
        $this->assertSame('Inactive', $filter->getFilterPillValue(0));
    }
}
