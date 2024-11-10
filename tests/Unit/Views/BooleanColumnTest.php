<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

final class BooleanColumnTest extends TestCase
{
    public function test_boolean_column_can_not_be_a_label(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        BooleanColumn::make('Name')->label(fn () => 'My Label')->getContents(Pet::find(1));
    }

    public function test_boolean_column_can_be_yes_no(): void
    {
        $column = BooleanColumn::make('Name');

        $this->assertEquals('icons', $column->getType());

        $column->yesNo();

        $this->assertEquals('yes-no', $column->getType());
    }
}
