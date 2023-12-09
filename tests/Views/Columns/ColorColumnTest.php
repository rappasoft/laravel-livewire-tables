<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\ColorColumn;

class ColorColumnTest extends TestCase
{
    /** @test */
    public function can_set_the_column_title(): void
    {
        $column = ColorColumn::make('Favorite Color', 'favorite_color');

        $this->assertSame('Favorite Color', $column->getTitle());
    }

    /** @test */
    public function can_infer_field_name_from_title_if_no_from(): void
    {
        $column = ColorColumn::make('Favorite Color');

        $this->assertNull($column->getField());
    }

    /** @test */
    public function can_set_base_field_from_from(): void
    {
        $column = ColorColumn::make('Favorite Color', 'favorite_color');

        $this->assertSame('favorite_color', $column->getField());
    }

    /** @test */
    public function can_set_relation_field_from_from(): void
    {
        $column = ColorColumn::make('Favorite Color', 'favorite_color');

        $this->assertSame('favorite_color', $column->getField());
    }

    /** @test */
    public function can_get_column_formatted_contents(): void
    {
        $column = ColorColumn::make('Favorite Color', 'favorite_color') ;

        $rows = $this->basicTable->getRows();

        $this->assertSame($rows->first()->favorite_color, $column->getValue($rows->first()));
        $this->assertSame($rows->last()->favorite_color, $column->getValue($rows->last()));
        $this->assertSame($rows->slice(2,1)->first()->favorite_color, $column->getValue($rows->slice(2,1)->first()));

    }

    /** @test */
    public function can_get_column_contents_from_color(): void
    {
        $column = ColorColumn::make('Species Color')->color(
            function ($row) {
                if ($row->species_id == 1)
                {
                    return '#ff0000';
                }
                else if ($row->species_id == 2)
                {
                    return '#008000';
                }
                else return '#ffa500';
                
            }
        );

        $rows = $this->basicTable->setAdditionalSelects(['pets.species_id as species_id'])->getRows();

        $this->assertSame('#ff0000', app()->call($column->getColorCallback(), ['row' => $rows->first()]));
        $this->assertSame('#ffa500', app()->call($column->getColorCallback(), ['row' => $rows->last()]));
        $this->assertSame('#008000', app()->call($column->getColorCallback(), ['row' => $rows->slice(2,1)->first()]));
    }


}
