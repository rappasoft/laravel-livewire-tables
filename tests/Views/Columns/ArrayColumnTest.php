<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\ArrayColumn;

final class ArrayColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = ArrayColumn::make('Array Col');

        $this->assertSame('Array Col', $column->getTitle());
    }

}