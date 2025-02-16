<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Columns')]
abstract class ColumnTestCase extends TestCase
{
    protected static $columnInstance;

    protected function setUp(): void
    {
        parent::setUp();

    }

    public static function tearDownAfterClass(): void
    {
        self::$columnInstance = null;
    }

    public function test_can_set_the_column_title(): void
    {
        $this->assertSame('Name', self::$columnInstance->getTitle());
    }

    public function test_can_set_the_column_component(): void
    {
        $this->assertFalse(self::$columnInstance->hasComponent());

        self::$columnInstance->setComponent($this->basicTable);

        $this->assertTrue(self::$columnInstance->hasComponent());

        $this->assertSame($this->basicTable, self::$columnInstance->getComponent());
    }

    public function test_can_check_if_is_reorder_column(): void
    {
        $this->assertFalse(self::$columnInstance->isReorderColumn());

    }

    public function test_can_get_sorting_pills_direction_deprecated(): void
    {
        $this->assertSame('A-Z', self::$columnInstance->getSortingPillDirection($this->basicTable, 'asc'));
        $this->assertSame('Z-A', self::$columnInstance->getSortingPillDirection($this->basicTable, 'desc'));

        self::$columnInstance->setSortingPillDirections('1-2', '2-1');
        $this->assertSame('1-2', self::$columnInstance->getSortingPillDirection($this->basicTable, 'asc'));
        $this->assertSame('2-1', self::$columnInstance->getSortingPillDirection($this->basicTable, 'desc'));

    }
}
