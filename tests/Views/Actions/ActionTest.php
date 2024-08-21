<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Actions;

use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{PetsTable,PetsTableAttributes};
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Actions\Action;

final class ActionTest extends TestCase
{
    public function test_can_get_action_button_label(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true])
            ->setIcon('fas fa-minus')
            ->setIconAttributes(['class' => 'font-sm text-sm'])
            ->wireNavigate()
            ->route('dashboard2');

        $this->assertSame('Update Summaries', $action->getLabel());
    }

    public function test_can_get_action_button_icon(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes([
                'class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
                'default-styling' => true,
                'default-colors' => true,
            ])
            ->wireNavigate()
            ->route('dashboard2');
        $this->assertFalse($action->hasIcon());
        $action->setIcon('fas fa-minus');
        $this->assertTrue($action->hasIcon());
        $this->assertSame('fas fa-minus', $action->getIcon());
        $this->assertSame('fas fa-minus', $action->icon);

    }

    public function test_can_get_action_button_icon_attributes(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes([
                'class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
                'default-styling' => true,
                'default-colors' => true,
            ])
            ->wireNavigate()
            ->route('dashboard2');
        $this->assertFalse($action->hasIcon());

        $action->setIconAttributes(['class' => 'font-sm text-sm']);
        $bag = new \Illuminate\View\ComponentAttributeBag(['default-styling' => true, 'class' => 'font-sm text-sm']);

        $this->assertSame($bag->getAttributes(), $action->getIconAttributes()->getAttributes());
        $this->assertSame(['default-styling' => true, 'class' => 'font-sm text-sm'], $action->iconAttributes);

    }

    public function test_can_get_action_button_route(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true])
            ->setIcon('fas fa-minus')
            ->setIconAttributes(['class' => 'font-sm text-sm'])
            ->wireNavigate();
        $this->assertSame('#', $action->getRoute());
        $this->assertSame('#', $action->route);
        $action->route('dashboard2');
        $this->assertSame('dashboard2', $action->route);

        $this->assertSame('dashboard2', $action->getRoute());
        $action->setRoute('dashboard4');
        $this->assertSame('dashboard4', $action->getRoute());
    }

    public function test_can_set_action_button_to_wire_navigate(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true])
            ->route('dashboard2');
        $this->assertFalse($action->getWireNavigateEnabled());
        $action->wireNavigate();
        $this->assertTrue($action->getWireNavigateEnabled());
    }

    public function test_can_get_action_button_action_attributes(): void
    {
        $action = Action::make('Update Summaries')
            ->wireNavigate()
            ->route('dashboard2');
        $this->assertSame((new ComponentAttributeBag([
            'default-styling' => true,
            'default-colors' => true,
            'href' => 'dashboard2',
        ]))->getAttributes(), $action->getActionAttributes()->getAttributes());

        $action->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true]);
        $this->assertSame((new ComponentAttributeBag([
            'default-styling' => true,
            'default-colors' => true,
            'class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
            'href' => 'dashboard2',
        ]))->getAttributes(), $action->getActionAttributes()->getAttributes());

        $action->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true]);
        $this->assertSame((new ComponentAttributeBag([
            'default-styling' => true,
            'default-colors' => true,
            'class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
            'href' => 'dashboard2',
        ]))->getAttributes(), $action->getActionAttributes()->getAttributes());

        $action->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => false]);
        $this->assertSame((new ComponentAttributeBag([
            'default-styling' => true,
            'default-colors' => false,
            'class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
            'href' => 'dashboard2',
        ]))->getAttributes(), $action->getActionAttributes()->getAttributes());

        $action->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-colors' => false]);
        $this->assertSame((new ComponentAttributeBag([
            'default-styling' => true,
            'default-colors' => false,
            'class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
            'href' => 'dashboard2',
        ]))->getAttributes(), $action->getActionAttributes()->getAttributes());

    }

    public function test_can_check_has_wire_action(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true])
            ->setIcon('fas fa-minus')
            ->setIconAttributes(['class' => 'font-sm text-sm']);

        $this->assertFalse($action->hasWireAction());

        $action->setWireAction('wire:click')
            ->setWireActionParams("\$dispatch('openModal', { component: 'test-modal', arguments: JSON.parse('{\u0022modelID\u0022:\u0022\u0022}') })");

        $this->assertTrue($action->hasWireAction());
    }

    public function test_can_get_wire_action(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true])
            ->setIcon('fas fa-minus')
            ->setIconAttributes(['class' => 'font-sm text-sm'])
            ->setWireAction('wire:click')
            ->setWireActionParams("\$dispatch('openModal', { component: 'test-modal', arguments: JSON.parse('{\u0022modelID\u0022:\u0022\u0022}') })");

        $this->assertTrue($action->hasWireAction());

        $this->assertSame('wire:click', $action->getWireAction());

    }

    public function test_can_get_wire_action_dispatch(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true])
            ->setIcon('fas fa-minus')
            ->setIconAttributes(['class' => 'font-sm text-sm'])
            ->setWireAction('wire:click')
            ->setWireActionDispatchParams("'openModal', { component: 'test-modal', arguments: JSON.parse('{\u0022modelID\u0022:\u0022\u0022}') }");
        $this->assertTrue($action->hasWireAction());

        $this->assertSame('wire:click', $action->getWireAction());
        $this->assertSame("\$dispatch('openModal', { component: 'test-modal', arguments: JSON.parse('{\u0022modelID\u0022:\u0022\u0022}') })", $action->getWireActionParams());

    }

    public function test_can_get_wire_action_params(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true])
            ->setIcon('fas fa-minus')
            ->setIconAttributes(['class' => 'font-sm text-sm'])
            ->setWireAction('wire:click')
            ->setWireActionParams('testactionparams');

        $this->assertTrue($action->hasWireActionParams());
        $this->assertTrue($action->hasWireAction());

        $this->assertSame('testactionparams', $action->getWireActionParams());
        $this->assertSame('wire:click', $action->getWireAction());

    }

    public function test_can_set_action_wrapper_attributes(): void
    {
        $petsTable = (new class extends PetsTable
        {
            use \Rappasoft\LaravelLivewireTables\Traits\WithActions;

            public function configure(): void
            {
                $this->setPrimaryKey('id');
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
        $this->assertSame(['default-styling' => true, 'default-colors' => true], $petsTable->getActionWrapperAttributes());
        $petsTable->setActionWrapperAttributes(['default-styling' => false, 'class' => 'bg-blue-500']);
        $this->assertSame([
            'default-styling' => false,
            'default-colors' => true,
            'class' => 'bg-blue-500',
        ], $petsTable->getActionWrapperAttributes());

        $petsTable->setActionWrapperAttributes(['default-colors' => false, 'class' => 'bg-red-500']);
        $this->assertSame([
            'default-styling' => true,
            'default-colors' => false,
            'class' => 'bg-red-500',
        ], $petsTable->getActionWrapperAttributes());

    }

    public function test_can_check_has_actions(): void
    {
        $petsTable = (new class extends PetsTable
        {
            use \Rappasoft\LaravelLivewireTables\Traits\WithActions;

            public function actions()
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Actions\Action::make('Test Edit 1')
                        ->setRoute('dashboard24'),
                ];
            }

            public function configure(): void
            {
                $this->setPrimaryKey('id');
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
        $this->assertTrue($petsTable->hasActions());

        $this->assertSame(1, $petsTable->getActions()->count());

    }
}
