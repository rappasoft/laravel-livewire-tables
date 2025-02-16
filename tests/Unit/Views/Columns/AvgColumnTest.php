<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\Unit\Attributes\AggregateColumnProvider;
use Rappasoft\LaravelLivewireTables\Views\Columns\AvgColumn;

#[Group('Columns')]
final class AvgColumnTest extends ColumnTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$columnInstance = AvgColumn::make('Name');

        parent::setupSpeciesTable();
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_setup_column_correctly(string $relation_name, string $foreign_field): void
    {
        self::$columnInstance
            ->setDataSource($relation_name, $foreign_field)
            ->sortable();

        $this->assertNotEmpty(self::$columnInstance);
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_not_skip_set_data_source(string $relation_name, string $foreign_field): void
    {
        $this->expectException(DataTableConfigurationException::class);

        self::$columnInstance
            ->sortable();
        $contents = self::$columnInstance->getContents(Pet::find(1));
        $this->assertNull(self::$columnInstance);

    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_get_data_source(string $relation_name, string $foreign_field): void
    {
        self::$columnInstance
            ->setDataSource($relation_name, $foreign_field)
            ->sortable();
        $this->assertTrue(self::$columnInstance->hasDataSource());
        $this->assertSame($relation_name, self::$columnInstance->getDataSource());
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_get_foreign_column(string $relation_name, string $foreign_field): void
    {
        self::$columnInstance
            ->setDataSource($relation_name, $foreign_field)
            ->sortable();
        $this->assertTrue(self::$columnInstance->hasForeignColumn());
        $this->assertSame($foreign_field, self::$columnInstance->getForeignColumn());
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_set_foreign_column(string $relation_name, string $foreign_field): void
    {
        self::$columnInstance
            ->setDataSource($relation_name, $foreign_field)
            ->sortable();
        $this->assertTrue(self::$columnInstance->hasForeignColumn());
        $this->assertSame($foreign_field, self::$columnInstance->getForeignColumn());
        self::$columnInstance->setForeignColumn('test');
        $this->assertTrue(self::$columnInstance->hasForeignColumn());
        $this->assertSame('test', self::$columnInstance->getForeignColumn());

    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_get_data_source_fields(string $relation_name, string $foreign_field): void
    {
        self::$columnInstance
            ->setDataSource($relation_name, $foreign_field)
            ->sortable();
        $this->assertTrue(self::$columnInstance->hasDataSource());
        $this->assertSame($relation_name, self::$columnInstance->getDataSource());
        $this->assertTrue(self::$columnInstance->hasForeignColumn());
        $this->assertSame($foreign_field, self::$columnInstance->getForeignColumn());
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_get_aggregate_method(string $relation_name, string $foreign_field): void
    {
        self::$columnInstance
            ->setDataSource($relation_name, $foreign_field)
            ->sortable();
        $this->assertSame('avg', self::$columnInstance->getAggregateMethod());
        self::$columnInstance->setAggregateMethod('test_avg');
        $this->assertSame('test_avg', self::$columnInstance->getAggregateMethod());
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_renders_correctly(string $relation_name, string $foreign_field): void
    {
        $rows = $this->speciesTable->getRows();
        self::$columnInstance
            ->setDataSource('pets', 'age');
        $contents = self::$columnInstance->getContents($rows->first());
        $this->assertSame('15', $contents);
        $contents = self::$columnInstance->getContents($rows[2]);
        $this->assertSame('6', $contents);
    }
}
