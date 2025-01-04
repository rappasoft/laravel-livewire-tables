<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use Exception;
use Illuminate\View\ViewException;
use Livewire\Component;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\FailingTables\{BrokenSecondaryHeaderTable, NoBuildMethodTable, NoPrimaryKeyTable};
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{PetsTable,PetsTableAttributes};
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class CustomisationsVisualsTest extends TestCase
{
    public function test_can_use_as_nested(): void
    {
        $test = Livewire::test([new class extends Component
        {
            public function render()
            {
                return <<<'HTML'
                <div>
                    <div>ParentComponentTest</div>
                    <div> <livewire:child /></div>
                </div>
                HTML;
            }
        },
            'child' => new class extends PetsTable
            {
                public function configure(): void
                {
                    parent::configure();
                    $this->setLayout('livewire-tables::tests.layout1');

                }
            },
        ])
            ->assertSee('ParentComponentTest')
            ->assertSee('Cartman');

    }
}
