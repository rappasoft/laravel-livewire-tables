<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals\Columns;

use Exception;
use Illuminate\View\ViewException;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\FailingTables\{BrokenSecondaryHeaderTable, NoBuildMethodTable, NoPrimaryKeyTable};
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{PetsTable,PetsTableAttributes};
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class IconColumnVisualsTest extends TestCase
{
    private $testErrors;

    public function test_icon_column_renders_correctly(): void
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
                    \Rappasoft\LaravelLivewireTables\Views\Column::make('Name')->searchable(),
                    \Rappasoft\LaravelLivewireTables\Views\Columns\IconColumn::make('Old Age', 'age')
                        ->setIcon(function (\Rappasoft\LaravelLivewireTables\Tests\Models\Pet $row, int $value) {
                            if ($value >= 5) {
                                return 'heroicon-o-check-circle';
                            } else {
                                return 'heroicon-o-x-circle';
                            }
                        }),
                ];
            }

            public function filters(): array
            {
                return [];
            }
        })
            ->call('setSearch', 'Cartman')
            ->assertSeeHtmlInOrder([
                '<div class="livewire-tables-columns-icon">',
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>',
                '</svg></div>',
            ])
            ->assertDontSeeHtml('<path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>')
            ->call('setSearch', 'May')
            ->assertDontSeeHtml('<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>')
            ->assertSeeHtmlInOrder([
                '<div class="livewire-tables-columns-icon">',
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">',
                '<path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>',
                '</svg></div>',
            ]);

    }
}
