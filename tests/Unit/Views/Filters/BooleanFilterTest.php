<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Filters;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Views\Filters\BooleanFilter;

#[Group('Filters')]
final class BooleanFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = BooleanFilter::make('Active');
        self::$extraFilterInputAttributes = [
            '@click' => 'toggleStatusWithUpdate',
            'activeColor' => 'bg-blue-600',
            'blobColor' => 'bg-white',
            'class' => 'bg-red-500 dark:bg-red-500',
            'inactiveColor' => 'bg-neutral-200',
            'type' => 'button',
            'x-ref' => 'switchButton',
        ];

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

    public function test_can_set_boolean_filter_to_valid_string(): void
    {
        $this->assertTrue(self::$filterInstance->validate('1'));
        $this->assertFalse(self::$filterInstance->validate('0'));
    }

    public function test_cannot_set_boolean_filter_to_valid_string(): void
    {
        $this->assertFalse(self::$filterInstance->validate('abc'));
        $this->assertFalse(self::$filterInstance->validate('def'));
    }

    public function test_can_get_custom_filter_pills(): void
    {
        self::$filterInstance->setFilterPillValues([
            true => 'Active',
            false => 'Inactive',
        ]);
        $this->assertSame('Active', self::$filterInstance->getFilterPillValue(1));
        $this->assertSame('Inactive', self::$filterInstance->getFilterPillValue(0));
    }

    public function test_can_set_default_values(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterDefaultValue());
        $this->assertNull(self::$filterInstance->getFilterDefaultValue());

        self::$filterInstance->setFilterDefaultValue(true);
        $this->assertTrue(self::$filterInstance->hasFilterDefaultValue());
        $this->assertSame(true, self::$filterInstance->getFilterDefaultValue());

        self::$filterInstance->setFilterDefaultValue(false);
        $this->assertTrue(self::$filterInstance->hasFilterDefaultValue());
        $this->assertSame(false, self::$filterInstance->getFilterDefaultValue());

    }

    public function test_can_get_if_boolean_filter_empty(): void
    {
        $this->assertTrue(self::$filterInstance->isEmpty(''));
    }

    public function test_can_get_if_boolean_filter_not_empty_int(): void
    {
        $this->assertFalse(self::$filterInstance->isEmpty(0));
    }

    public function test_can_get_if_boolean_filter_not_empty_bool(): void
    {
        $this->assertFalse(self::$filterInstance->isEmpty(false));
    }

    public function test_can_get_if_boolean_filter_not_empty_string(): void
    {
        $this->assertFalse(self::$filterInstance->isEmpty('0'));
    }

    public function test_can_get_if_boolean_filter_not_empty_invalid_string(): void
    {
        $this->assertTrue(self::$filterInstance->isEmpty('abc'));
    }

    public function test_can_validate_null_boolean_filter_value(): void
    {
        self::$filterInstance->setFilterPillValues([
            true => 'Active',
            false => 'Inactive',
        ]);

        $this->assertFalse(self::$filterInstance->validate(null));
    }

    public function test_is_empty_null_boolean_filter_value(): void
    {
        self::$filterInstance->setFilterPillValues([
            true => 'Active',
            false => 'Inactive',
        ]);

        $this->assertTrue(self::$filterInstance->isEmpty(null));
    }

    public function test_can_set_custom_input_attributes_boolean(): void
    {

        self::$filterInstance->setGenericDisplayData(self::$testGenericData);
        $baseAttributes = self::$filterInstance->getInputAttributesBag();

        $this->assertTrue($baseAttributes['default-styling']);
        $this->assertTrue($baseAttributes['default-colors']);

        self::$filterInstance->setInputAttributes([
            'class' => 'bg-red-500',
        ]);

        $this->assertFalse(self::$filterInstance->getInputAttributesBag()['default-styling']);
        $this->assertFalse(self::$filterInstance->getInputAttributesBag()['default-colors']);
        $this->assertSame('bg-red-500', self::$filterInstance->getInputAttributesBag()['class']);
        self::$filterInstance->setInputAttributes([
            'class' => 'bg-red-500 dark:bg-red-500',
            'default-styling' => true,
        ]);
        $currentAttributeBag = self::$filterInstance->getInputAttributesBag()->getAttributes();
        ksort($currentAttributeBag);

        $this->assertTrue($currentAttributeBag['default-styling']);
        $this->assertFalse($currentAttributeBag['default-colors']);
        $this->assertSame('bg-red-500 dark:bg-red-500', $currentAttributeBag['class']);

        $this->assertSame([
            '@click' => 'toggleStatusWithUpdate',
            'activeColor' => 'bg-blue-600',
            'blobColor' => 'bg-white',
            'class' => 'bg-red-500 dark:bg-red-500',
            'default-colors' => false,
            'default-styling' => true,
            'id' => $baseAttributes['id'],
            'inactiveColor' => 'bg-neutral-200',
            'type' => 'button',
            'x-ref' => 'switchButton',
        ], $currentAttributeBag);

        self::$filterInstance->setInputAttributes([
            'activeColor' => 'bg-red-600',
            'blobColor' => 'bg-green-500',
            'default-colors' => false,
            'default-styling' => true,
            'inactiveColor' => 'bg-blue-200',
        ]);
        $currentAttributeBag = self::$filterInstance->getInputAttributesBag()->getAttributes();
        ksort($currentAttributeBag);

        $this->assertSame([
            '@click' => 'toggleStatusWithUpdate',
            'activeColor' => 'bg-red-600',
            'blobColor' => 'bg-green-500',
            'default-colors' => false,
            'default-styling' => true,
            'id' => $baseAttributes['id'],
            'inactiveColor' => 'bg-blue-200',
            'type' => 'button',
            'x-ref' => 'switchButton',
        ], $currentAttributeBag);

    }
}
