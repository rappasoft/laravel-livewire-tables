<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals\Columns;

use Exception;
use Illuminate\View\ViewException;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\FailingTables\{BrokenSecondaryHeaderTable, NoBuildMethodTable, NoPrimaryKeyTable};
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{PetsTableWithLivewireColumn};
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class LivewireComponentColumnVisualsTest extends TestCase
{
    private $testErrors;

    public function test_icon_column_renders_correctly(): void
    {
        Livewire::test(PetsTableWithLivewireColumn::class)
            ->assertSeeHtmlInOrder([
                '<div>Name:Ben</div><div>Type:test</div>',
                '<div>Name:Cartman</div><div>Type:test</div>',
            ]);

    }

    public function test_icon_column_renders_correctly_with_asc_sort(): void
    {
        $temp = new class extends PetsTableWithLivewireColumn
        {
            public function configure(): void
            {
                parent::configure();

                $this->setDefaultSort('name', 'asc');

            }
        };
        Livewire::test($temp)
            ->assertSeeHtmlInOrder([
                '<div>Name:Ben</div><div>Type:test</div>',
                '<div>Name:Cartman</div><div>Type:test</div>',
            ]);
    }

    public function test_icon_column_renders_correctly_with_desc_sort(): void
    {
        $temp = new class extends PetsTableWithLivewireColumn
        {
            public function configure(): void
            {
                parent::configure();

                $this->setDefaultSort('name', 'desc');

            }
        };
        Livewire::test($temp)
            ->assertSeeHtmlInOrder([
                '<div>Name:Cartman</div><div>Type:test</div>',
                '<div>Name:Ben</div><div>Type:test</div>',
            ]);
    }
}
