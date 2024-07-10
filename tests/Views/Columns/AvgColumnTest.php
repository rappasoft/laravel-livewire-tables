<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\AvgColumn;
use Rappasoft\LaravelLivewireTables\Tests\Attributes\AggregateColumnProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;

final class AvgColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = AvgColumn::make('Average Age');

        $this->assertSame('Average Age', $column->getTitle());
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_setup_column_correctly(string $relation_name, string $foreign_field): void
    {
        $column = AvgColumn::make('Average Age')
                ->setDataSource($relation_name,$foreign_field)
                ->sortable();

        $this->assertNotEmpty($column);
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_not_skip_set_data_source(string $relation_name, string $foreign_field): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $column = AvgColumn::make('Average Age')
                ->sortable();
        $contents = $column->getContents(Pet::find(1));
        $this->assertNull($contents);

    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_get_data_source(string $relation_name, string $foreign_field): void
    {
        $column = AvgColumn::make('Average Age')
                ->setDataSource($relation_name, $foreign_field)
                ->sortable();
        $this->assertTrue($column->hasDataSource());
        $this->assertSame($relation_name, $column->getDataSource());
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_get_foreign_column(string $relation_name, string $foreign_field): void
    {
        $column = AvgColumn::make('Average Age')
        ->setDataSource($relation_name, $foreign_field)
        ->sortable();
        $this->assertTrue($column->hasForeignColumn());
        $this->assertSame($foreign_field, $column->getForeignColumn());
    }

    #[DataProviderExternal(AggregateColumnProvider::class, 'relationshipProvider')]
    public function test_can_get_data_source_fields(string $relation_name, string $foreign_field): void
    {
        $column = AvgColumn::make('Average Age')
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
        $column = AvgColumn::make('Average Age')
                ->setDataSource($relation_name, $foreign_field)
                ->sortable();
        $this->assertSame('avg',$column->getAggregateMethod());
        $column->setAggregateMethod('test_avg');
        $this->assertSame('test_avg',$column->getAggregateMethod());
    }

}
