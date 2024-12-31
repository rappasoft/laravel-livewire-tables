<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

// use Illuminate\Support\Facades\Exceptions;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\IconColumn;

final class IconColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = IconColumn::make('Icon Column 1', 'favorite_color');

        $this->assertSame('Icon Column 1', $column->getTitle());
    }

    public function test_can_get_the_column_view(): void
    {
        $column = IconColumn::make('Icon Column 1', 'favorite_color');

        $this->assertSame('livewire-tables::includes.columns.icon', $column->getView());
        $column->setView('test-icon-column');
        $this->assertSame('test-icon-column', $column->getView());

    }

    public function test_can_infer_field_name_from_title_if_no_from(): void
    {
        $column = IconColumn::make('Icon Column 1');

        $this->assertNull($column->getField());
    }

    public function test_can_setup_column_correctly(): void
    {
        $column = IconColumn::make('Icon Column 1')
            ->setIcon(function ($row, $value) {
                if ($value == 1) {
                    return 'heroicon-o-check-circle';
                } else {
                    return 'heroicon-o-x-circle';
                }
            });

        $this->assertNotEmpty($column);
    }

    public function test_icons_correctly_via_value(): void
    {
        $rows = $this->basicTable->getRows();
        $column = IconColumn::make('Old Age', 'age')
            ->setIcon(function (Pet $row, int $value) {
                if ($value >= 5) {
                    return 'heroicon-o-check-circle';
                } else {
                    return 'heroicon-o-x-circle';
                }
            });

        $this->assertSame('heroicon-o-check-circle', $column->getIcon(Pet::where('age', '>', 5)->first()));
        $this->assertSame('heroicon-o-x-circle', $column->getIcon(Pet::where('age', '<', 4)->first()));
    }

    public function test_icons_correctly_via_row(): void
    {
        $rows = $this->basicTable->getRows();
        $column = IconColumn::make('Old Age', 'age')
            ->setIcon(function (Pet $row) {
                if ($row->age >= 7) {
                    return 'old-icon';
                } else {
                    return 'young-icon';
                }
            });

        $this->assertSame('old-icon', $column->getIcon(Pet::where('age', '>', 9)->first()));
        $this->assertSame('young-icon', $column->getIcon(Pet::where('age', '<', 4)->first()));
    }

    public function test_renders_correctly(): void
    {
        $rows = $this->basicTable->getRows();
        $row1 = $rows->first();
        $column = IconColumn::make('Old Age', 'age')
            ->setIcon(function (Pet $row, int $value) {
                if ($value >= 5) {
                    return 'heroicon-o-check-circle';
                } else {
                    return 'heroicon-o-x-circle';
                }
            });
        $youngString = '<div class="livewire-tables-columns-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg></div>';
        $oldString = '<div class="livewire-tables-columns-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg></div>';
        $firstLine = str_replace('  ', ' ', str_replace(["\r", "\n"], '', $column->getContents(Pet::where('age', '<', 4)->first())));
        $firstLine = str_replace('>  <', '><', $firstLine);
        $firstLine = str_replace('> <', '><', $firstLine);

        $this->assertSame($oldString, $firstLine);

        $lastLine = str_replace('  ', ' ', str_replace(["\r", "\n"], '', $column->getContents(Pet::where('age', '>', 5)->first())));
        $lastLine = str_replace('>  <', '><', $lastLine);
        $lastLine = str_replace('> <', '><', $lastLine);

        $this->assertSame($youngString, $lastLine);
    }
}
