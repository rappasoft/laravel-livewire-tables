<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Tests\Unit\Attributes\AggregateColumnProvider;
use Rappasoft\LaravelLivewireTables\Views\Columns\SumColumn;

final class SumColumnTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        parent::setupSpeciesTable();
    }

    public function test_can_set_the_column_title(): void
    {
        $column = SumColumn::make('Sum User Age');

        $this->assertSame('Sum User Age', $column->getTitle());
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_setup_column_correctly(string $relation_name, string $foreign_field): void
    {
        $column = SumColumn::make('Sum User Age')
            ->setDataSource($relation_name, $foreign_field)
            ->sortable();

        $this->assertNotEmpty($column);
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_not_skip_set_data_source(string $relation_name, string $foreign_field): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $column = SumColumn::make('Sum User Age')
            ->sortable();
        $contents = $column->getContents(Pet::find(1));
        $this->assertNull($contents);

    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_set_foreign_column(string $relation_name, string $foreign_field): void
    {
        $column = SumColumn::make('Sum User Age')
            ->setDataSource($relation_name, $foreign_field)
            ->sortable();
        $this->assertTrue($column->hasForeignColumn());
        $this->assertSame($foreign_field, $column->getForeignColumn());
        $column->setForeignColumn('test');
        $this->assertTrue($column->hasForeignColumn());
        $this->assertSame('test', $column->getForeignColumn());

    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_get_data_source(string $relation_name, string $foreign_field): void
    {
        $column = SumColumn::make('Sum User Age')
            ->setDataSource($relation_name, $foreign_field)
            ->sortable();
        $this->assertTrue($column->hasDataSource());
        $this->assertSame($relation_name, $column->getDataSource());
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_get_foreign_column(string $relation_name, string $foreign_field): void
    {
        $column = SumColumn::make('Sum User Age')
            ->setDataSource($relation_name, $foreign_field)
            ->sortable();
        $this->assertTrue($column->hasForeignColumn());
        $this->assertSame($foreign_field, $column->getForeignColumn());
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_get_data_source_fields(string $relation_name, string $foreign_field): void
    {
        $column = SumColumn::make('Sum User Age')
            ->setDataSource($relation_name, $foreign_field)
            ->sortable();
        $this->assertTrue($column->hasDataSource());
        $this->assertSame($relation_name, $column->getDataSource());
        $this->assertTrue($column->hasForeignColumn());
        $this->assertSame($foreign_field, $column->getForeignColumn());
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_get_aggregate_method(string $relation_name, string $foreign_field): void
    {
        $column = SumColumn::make('Sum User Age')
            ->setDataSource($relation_name, $foreign_field)
            ->sortable();
        $this->assertSame('sum', $column->getAggregateMethod());
        $column->setAggregateMethod('test_sum');
        $this->assertSame('test_sum', $column->getAggregateMethod());
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_renders_correctly(string $relation_name, string $foreign_field): void
    {
        $rows = $this->speciesTable->getRows();
        $column = SumColumn::make('Total Age')
            ->setDataSource('pets', 'age');
        $contents = $column->getContents($rows->first());
        $this->assertSame('30', $contents);
        $contents = $column->getContents($rows[2]);
        $this->assertSame('12', $contents);
    }
}
