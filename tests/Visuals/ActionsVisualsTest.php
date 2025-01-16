<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class ActionsVisualsTest extends TestCase
{
    public function test_can_align_actions_left(): void
    {
        $petsTable = (new class extends PetsTable
        {
            use \Rappasoft\LaravelLivewireTables\Traits\WithActions;

            public function actions(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Actions\Action::make('Test Edit 1')
                        ->setRoute('dashboard24'),
                ];
            }

            public function configure(): void
            {
                $this->setPrimaryKey('id');
                $this->setActionWrapperAttributes(['class' => 'flex flex-cols space-x-4 py-4', 'default-styling' => false]);
                $this->setActionsLeft();
            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        });
        Livewire::test($petsTable)
            ->assertSeeHtml('<div class="justify-start flex flex-cols space-x-4 py-4" >');

    }

    public function test_can_align_actions_center(): void
    {
        $petsTable = (new class extends PetsTable
        {
            use \Rappasoft\LaravelLivewireTables\Traits\WithActions;

            public function actions(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Actions\Action::make('Test Edit 1')
                        ->setRoute('dashboard24'),
                ];
            }

            public function configure(): void
            {
                $this->setPrimaryKey('id');
                $this->setActionWrapperAttributes(['class' => 'flex flex-cols space-x-4 py-4', 'default-styling' => false]);
                $this->setActionsCenter();
            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        });
        Livewire::test($petsTable)
            ->assertSeeHtml('<div class="justify-center flex flex-cols space-x-4 py-4" >');

    }

    public function test_can_align_actions_right(): void
    {
        $petsTable = (new class extends PetsTable
        {
            use \Rappasoft\LaravelLivewireTables\Traits\WithActions;

            public function actions(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Actions\Action::make('Test Edit 1')
                        ->setRoute('dashboard24'),
                ];
            }

            public function configure(): void
            {
                $this->setPrimaryKey('id');
                $this->setActionWrapperAttributes(['class' => 'flex flex-cols space-x-4 py-4', 'default-styling' => false]);
                $this->setActionsRight();
            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        });
        Livewire::test($petsTable)
            ->assertSeeHtml('<div class="justify-end flex flex-cols space-x-4 py-4" >');

    }
}
