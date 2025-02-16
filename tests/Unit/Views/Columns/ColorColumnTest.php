<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Views\Columns\ColorColumn;

#[Group('Columns')]
final class ColorColumnTest extends ColumnTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$columnInstance = ColorColumn::make('Favorite Color', 'favorite_color');
    }

    public function test_can_set_the_column_title(): void
    {
        $this->assertSame('Favorite Color', self::$columnInstance->getTitle());
    }

    public function test_can_get_the_column_view(): void
    {
        $this->assertSame('livewire-tables::includes.columns.color', self::$columnInstance->getView());
        self::$columnInstance->setView('test-color-column');
        $this->assertSame('test-color-column', self::$columnInstance->getView());

    }

    public function test_can_infer_field_name_from_title_if_no_from(): void
    {
        $column = ColorColumn::make('Favorite Color');

        $this->assertNull($column->getField());
    }

    public function test_can_set_base_field_from_from(): void
    {
        $this->assertSame('favorite_color', self::$columnInstance->getField());
    }

    public function test_can_set_view(): void
    {
        $this->assertSame('livewire-tables::includes.columns.color', self::$columnInstance->getView());
    }

    public function test_can_set_default_value(): void
    {
        self::$columnInstance->defaultValue('#FEFEFE');

        $this->assertSame('#FEFEFE', self::$columnInstance->getDefaultValue());
    }

    public function test_can_set_relation_field_from_from(): void
    {
        $this->assertSame('favorite_color', self::$columnInstance->getField());
    }

    public function test_can_check_color_callback_presence(): void
    {
        $this->assertFalse(self::$columnInstance->hasColorCallback());

        self::$columnInstance->color(
            function ($row) {
                if ($row->species_id == 1) {
                    return '#ff0000';
                } elseif ($row->species_id == 2) {
                    return '#008000';
                } else {
                    return '#ffa500';
                }

            }
        );
        $this->assertTrue(self::$columnInstance->hasColorCallback());

    }

    public function test_can_check_attribute_callback_presence(): void
    {
        $this->assertFalse(self::$columnInstance->hasAttributesCallback());
    }

    public function test_can_set_attribute_callback(): void
    {
        $this->assertFalse(self::$columnInstance->hasAttributesCallback());

        self::$columnInstance->attributes(function ($row) {
            return [
                'class' => '!rounded-lg self-center',
                'default' => true,
            ];
        });

        $this->assertTrue(self::$columnInstance->hasAttributesCallback());
    }

    public function test_can_get_attribute_callback(): void
    {
        self::$columnInstance->attributes(function ($row) {
            return [
                'class' => '!rounded-lg self-center',
                'default' => true,
            ];
        });
        $rows = $this->basicTable->setAdditionalSelects(['pets.favorite_color as favorite_color'])->getRows();
        $this->assertSame(['class' => '!rounded-lg self-center', 'default' => true], self::$columnInstance->getAttributeBag($rows->first())->getAttributes());
    }

    public function test_can_get_column_formatted_contents(): void
    {
        $rows = $this->basicTable->setAdditionalSelects(['pets.favorite_color as favorite_color'])->getRows();

        $this->assertSame($rows->first()->favorite_color, self::$columnInstance->getValue($rows->first()));
        $this->assertSame($rows->first()->favorite_color, self::$columnInstance->getColor($rows->first()));

        $this->assertSame($rows->last()->favorite_color, self::$columnInstance->getColor($rows->last()));
        $this->assertSame($rows->last()->favorite_color, self::$columnInstance->getValue($rows->last()));

        $currentRow = $rows->slice(2, 1)->first();
        $this->assertSame($currentRow->favorite_color, self::$columnInstance->getValue($currentRow));
        $this->assertSame($currentRow->favorite_color, self::$columnInstance->getColor($currentRow));
    }

    public function test_can_get_column_contents_from_color(): void
    {
        $column = ColorColumn::make('Species Color')->color(
            function ($row) {
                if ($row->species_id == 1) {
                    return '#ff0000';
                } elseif ($row->species_id == 2) {
                    return '#008000';
                } else {
                    return '#ffa500';
                }

            }
        );

        $this->assertTrue($column->hasColorCallback());
        $this->assertFalse($column->hasAttributesCallback());

        $rows = $this->basicTable->setAdditionalSelects(['pets.species_id as species_id'])->getRows();

        $this->assertSame('#ff0000', app()->call($column->getColorCallback(), ['row' => $rows->first()]));
        $this->assertSame('#ffa500', app()->call($column->getColorCallback(), ['row' => $rows->last()]));
        $this->assertSame('#008000', app()->call($column->getColorCallback(), ['row' => $rows->slice(2, 1)->first()]));
    }

    public function test_can_get_column_color_from_color(): void
    {
        $column = ColorColumn::make('Species Color')->color(
            function ($row) {
                if ($row->species_id == 1) {
                    return '#ff0000';
                } elseif ($row->species_id == 2) {
                    return '#008000';
                } else {
                    return '#ffa500';
                }

            }
        );
        $rows = $this->basicTable->setAdditionalSelects(['pets.species_id as species_id'])->getRows();

        $this->assertSame('#ff0000', $column->getColor($rows->first()));
        $this->assertSame('#ffa500', $column->getColor($rows->last()));
        $this->assertSame('#008000', $column->getColor($rows->slice(2, 1)->first()));

    }

    public function test_can_get_column_get_contents_from_color(): void
    {
        $column = ColorColumn::make('Species Color')->color(
            function ($row) {
                if ($row->species_id == 1) {
                    return '#ff0000';
                } elseif ($row->species_id == 2) {
                    return '#008000';
                } else {
                    return '#ffa500';
                }

            }
        );
        $rows = $this->basicTable->setAdditionalSelects(['pets.species_id as species_id'])->getRows();

        $contents1 = $column->getContents($rows->first());
        $this->assertSame($contents1['color'], '#ff0000');
        $this->assertSame($contents1['isTailwind'], true);
        $this->assertSame($contents1['isBootstrap'], false);

        $contents2 = $column->getContents($rows->last());
        $this->assertSame($contents2['color'], '#ffa500');
        $this->assertSame($contents2['isTailwind'], true);
        $this->assertSame($contents2['isBootstrap'], false);

    }
}
