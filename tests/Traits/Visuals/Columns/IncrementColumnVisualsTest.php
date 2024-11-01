<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals\Columns;

use Exception;
use Illuminate\View\ViewException;
use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\FailingTables\{BrokenSecondaryHeaderTable, NoBuildMethodTable, NoPrimaryKeyTable};
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{PetsTable,PetsTableAttributes};
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class IncrementColumnVisualsTest extends TestCase
{
    private $testErrors;

    /*
    public function test_increment_column_renders_correctly(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function columns(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn::make('#'),
                    \Rappasoft\LaravelLivewireTables\Views\Column::make('Name')->searchable(),
                ];
            }

            public function filters(): array
            {
                return [];
            }
        })
            ->assertSeeHtmlInOrder([
                '<tr rowpk="1"',
                '<td',
                '<div>1</div>',
            ]);
    }*/
}
