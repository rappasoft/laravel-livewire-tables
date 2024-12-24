<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Filters;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Filters')]
abstract class FilterTestCase extends TestCase
{
    protected static $filterInstance;

    protected static $testGenericData;

    protected static $extraFilterInputAttributes;

    protected function setUp(): void
    {
        parent::setUp();
        self::$testGenericData = [
            'filterLayout' => 'tailwind',
            'tableName' => 'test123',
            'isTailwind' => true,
            'isBootstrap' => false,
            'isBootstrap4' => false,
            'isBootstrap5' => false,
            'localisationPath' => 'livewire-tables::core.',
        ];
    }

    public static function tearDownAfterClass(): void
    {
        self::$extraFilterInputAttributes = null;
    }

    public function test_can_get_filter_name(): void
    {
        $this->assertSame('Active', self::$filterInstance->getName());
    }

    public function test_can_get_filter_key(): void
    {
        $this->assertSame('active', self::$filterInstance->getKey());
    }

    public function test_get_a_single_filter_config(): void
    {
        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertSame('bar', self::$filterInstance->getConfig('foo'));
    }

    public function test_can_get_filter_default_value(): void
    {
        $this->assertNull(self::$filterInstance->getDefaultValue());
    }

    public function test_can_get_filter_pill_title(): void
    {
        $this->assertSame('Active', self::$filterInstance->getFilterPillTitle());

        self::$filterInstance->setFilterPillTitle('User Date');

        $this->assertSame('User Date', self::$filterInstance->getFilterPillTitle());
    }

    public function test_can_check_filter_config_by_name(): void
    {
        self::$filterInstance->config(['foo' => 'bar']);

        $this->assertTrue(self::$filterInstance->hasConfig('foo'));
        $this->assertFalse(self::$filterInstance->hasConfig('bar'));
    }

    public function test_can_check_if_filter_is_hidden_from_menus(): void
    {
        $this->assertFalse(self::$filterInstance->isHiddenFromMenus());
        $this->assertTrue(self::$filterInstance->isVisibleInMenus());

        self::$filterInstance->hiddenFromMenus();

        $this->assertTrue(self::$filterInstance->isHiddenFromMenus());
        $this->assertFalse(self::$filterInstance->isVisibleInMenus());
    }

    public function test_can_check_if_filter_is_hidden_from_pills(): void
    {
        $this->assertFalse(self::$filterInstance->isHiddenFromPills());
        $this->assertTrue(self::$filterInstance->isVisibleInPills());

        self::$filterInstance->hiddenFromPills();

        $this->assertTrue(self::$filterInstance->isHiddenFromPills());
        $this->assertFalse(self::$filterInstance->isVisibleInPills());
    }

    public function test_can_check_if_filter_is_hidden_from_count(): void
    {
        $this->assertFalse(self::$filterInstance->isHiddenFromFilterCount());
        $this->assertTrue(self::$filterInstance->isVisibleInFilterCount());

        self::$filterInstance->hiddenFromFilterCount();

        $this->assertTrue(self::$filterInstance->isHiddenFromFilterCount());
        $this->assertFalse(self::$filterInstance->isVisibleInFilterCount());
    }

    public function test_can_check_if_filter_is_reset_by_clear_button(): void
    {
        $this->assertTrue(self::$filterInstance->isResetByClearButton());

        self::$filterInstance->notResetByClearButton();

        $this->assertFalse(self::$filterInstance->isResetByClearButton());
    }

    public function test_can_set_custom_input_attributes(): void
    {
        $filter = self::$filterInstance;

        $filter->setGenericDisplayData(self::$testGenericData);
        $baseAttributes = $filter->getInputAttributesBag();

        $this->assertTrue($baseAttributes['default-styling']);
        $this->assertTrue($baseAttributes['default-colors']);

        $filter->setInputAttributes([
            'class' => 'bg-red-500',
        ]);

        $this->assertFalse($filter->getInputAttributesBag()['default-styling']);
        $this->assertFalse($filter->getInputAttributesBag()['default-colors']);
        $this->assertSame('bg-red-500', $filter->getInputAttributesBag()['class']);
        $filter->setInputAttributes([
            'class' => 'bg-red-500 dark:bg-red-500',
            'default-styling' => true,
        ]);
        $currentAttributeBag = $filter->getInputAttributesBag()->getAttributes();
        ksort($currentAttributeBag);

        $this->assertTrue($currentAttributeBag['default-styling']);
        $this->assertFalse($currentAttributeBag['default-colors']);
        $this->assertSame('bg-red-500 dark:bg-red-500', $currentAttributeBag['class']);

        $standardAttributes = [
            'class' => 'bg-red-500 dark:bg-red-500',
            'default-colors' => false,
            'default-styling' => true,
            'id' => $baseAttributes['id'],
        ];
        if (isset(self::$extraFilterInputAttributes)) {
            $standardAttributes = array_merge($standardAttributes, self::$extraFilterInputAttributes);
            ksort($standardAttributes);
        }

        $this->assertSame($standardAttributes, $currentAttributeBag);

    }
}
