<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

final class SelectFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = SelectFilter::make('Active')->options(['Cartman', 'Tux', 'May', 'Ben', 'Chico']);
    }

    public function testArraySetup(): array
    {
        $optionsArray = ['Cartman', 'Tux', 'May', 'Ben', 'Chico'];
        $this->assertNotEmpty($optionsArray);

        return $optionsArray;
    }

    /** @test */
    public function can_get_filter_callback(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterCallback());

        self::$filterInstance
            ->filter(function (Builder $builder, int $value) {
                return $builder->where('name', '=', $value);
            });

        $this->assertTrue(self::$filterInstance->hasFilterCallback());
        $this->assertIsCallable(self::$filterInstance->getFilterCallback());
    }

    /**
     * @test
     */
    public function can_not_set_filter_to_number(): void
    {
        $this->assertFalse(self::$filterInstance->validate(123));
        $this->assertFalse(self::$filterInstance->validate('123'));
    }

    /**
     * @test
     */
    public function can_not_set_filter_to_text(): void
    {
        $this->assertFalse(self::$filterInstance->validate('test'));
    }

    /**
     * @test
     */
    public function can_set_filter_to_valid(): void
    {
        $this->assertSame('1', self::$filterInstance->validate('1'));
    }

    /**
     * @test
     */
    public function can_get_if_filter_empty(): void
    {
        $this->assertTrue(self::$filterInstance->isEmpty(''));
        $this->assertFalse(self::$filterInstance->isEmpty('123'));
        $this->assertFalse(self::$filterInstance->isEmpty('test'));
    }

    /**
     * @test
     */
    public function test_can_check_if_can_set_default_value(): void
    {
        $this->assertNull(self::$filterInstance->getFilterDefaultValue());

        self::$filterInstance->setFilterDefaultValue('1');

        $this->assertSame('1', self::$filterInstance->getFilterDefaultValue());
    }

    /**
     * @test
     */
    public function can_set_custom_filter_view(): void
    {
        $this->assertSame('livewire-tables::components.tools.filters.select', self::$filterInstance->getViewPath());
        self::$filterInstance->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', self::$filterInstance->getViewPath());
    }
}
