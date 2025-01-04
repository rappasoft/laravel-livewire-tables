<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Actions;

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
        $bag = new \Illuminate\View\ComponentAttributeBag(['class' => 'font-sm text-sm', 'default-styling' => true]);

        $this->assertSame($bag->getAttributes(), $action->getIconAttributes()->getAttributes());
        $this->assertSame(['class' => 'font-sm text-sm', 'default-styling' => true], $action->iconAttributes);

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
            'class' => '',
            'default-styling' => true,
            'default-colors' => true,
            'href' => 'dashboard2',
        ]))->getAttributes(), $action->getActionAttributes()->getAttributes());

        $action->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true]);
        $this->assertSame((new ComponentAttributeBag([
            'class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
            'default-styling' => true,
            'default-colors' => true,
            'href' => 'dashboard2',
        ]))->getAttributes(), $action->getActionAttributes()->getAttributes());

        $action->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true]);
        $this->assertSame((new ComponentAttributeBag([
            'class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
            'default-styling' => true,
            'default-colors' => true,
            'href' => 'dashboard2',
        ]))->getAttributes(), $action->getActionAttributes()->getAttributes());

        $action->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => false]);
        $this->assertSame((new ComponentAttributeBag([
            'class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
            'default-styling' => true,
            'default-colors' => false,
            'href' => 'dashboard2',
        ]))->getAttributes(), $action->getActionAttributes()->getAttributes());

        $action->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-colors' => false]);
        $this->assertSame((new ComponentAttributeBag([
            'class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
            'default-styling' => true,
            'default-colors' => false,
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
        $this->assertSame(['class' => '', 'default-styling' => true, 'default-colors' => true], $petsTable->getActionWrapperAttributes());
        $petsTable->setActionWrapperAttributes(['default-styling' => false, 'class' => 'bg-blue-500']);
        $this->assertSame([
            'class' => 'bg-blue-500',
            'default-styling' => false,
            'default-colors' => true,
        ], $petsTable->getActionWrapperAttributes());

        $petsTable->setActionWrapperAttributes(['default-colors' => false, 'class' => 'bg-red-500']);
        $this->assertSame([
            'class' => 'bg-red-500',
            'default-styling' => false,
            'default-colors' => false,
        ], $petsTable->getActionWrapperAttributes());

    }

    public function test_can_check_that_route_is_appended_to_attributes(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true])
            ->route('dashboard22');
        $this->assertSame((new ComponentAttributeBag([
            'class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
            'default-styling' => true,
            'default-colors' => true,
            'href' => 'dashboard22',
        ]))->getAttributes(), $action->getActionAttributes()->getAttributes());
    }

    public function test_can_check_that_route_is_not_appended_to_attributes_with_wireaction(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true])
            ->route('dashboard22')
            ->setWireAction('wire:click')
            ->setWireActionParams('testactionparams');
        $this->assertSame((new ComponentAttributeBag([
            'class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
            'default-styling' => true,
            'default-colors' => true,
            'href' => '#',
        ]))->getAttributes(), $action->getActionAttributes()->getAttributes());
    }

    public function test_can_check_has_actions(): void
    {
        $petsTable = (new class extends PetsTable
        {
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

    public function test_can_set_icon_to_right_default(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true])
            ->setIcon('fas fa-minus')
            ->setIconAttributes(['class' => 'font-sm text-sm'])
            ->setWireAction('wire:click')
            ->setWireActionParams('testactionparams');
        $this->assertTrue($action->getIconRight());
    }

    public function test_can_set_icon_to_left(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true])
            ->setIcon('fas fa-minus')
            ->setIconAttributes(['class' => 'font-sm text-sm'])
            ->setIconLeft()
            ->setWireAction('wire:click')
            ->setWireActionParams('testactionparams');
        $this->assertFalse($action->getIconRight());
    }

    public function test_can_set_icon_to_right(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default-styling' => true, 'default-colors' => true])
            ->setIcon('fas fa-minus')
            ->setIconAttributes(['class' => 'font-sm text-sm'])
            ->setWireAction('wire:click')
            ->setWireActionParams('testactionparams')
            ->setIconLeft()
            ->setIconRight();
        $this->assertTrue($action->getIconRight());
    }

    public function test_action_renders_correctly(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800',
                'default-styling' => true,
                'default-colors' => true]
            )
            ->route('dashboard22');

        $this->assertStringContainsString('<a class="justify-center text-center items-center inline-flex space-x-2 rounded-md border shadow-sm px-4 py-2 text-sm font-medium focus:ring focus:ring-opacity-50 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800" href="dashboard22"', $action->render());
    }

    public function test_can_set_action_position(): void
    {
        $petsTable = (new class extends PetsTable
        {
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

        $this->assertSame('right', $petsTable->getActionsPosition());
        $petsTable->setActionsLeft();
        $this->assertSame('left', $petsTable->getActionsPosition());
        $petsTable->setActionsCenter();
        $this->assertSame('center', $petsTable->getActionsPosition());
        $petsTable->setActionsRight();
        $this->assertSame('right', $petsTable->getActionsPosition());

    }

    public function test_can_set_action_toolbar(): void
    {
        $petsTable = (new class extends PetsTable
        {
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

        $this->assertFalse($petsTable->showActionsInToolbar());
        $petsTable->setActionsInToolbarEnabled();
        $this->assertTrue($petsTable->showActionsInToolbar());
        $petsTable->setActionsInToolbarDisabled();
        $this->assertFalse($petsTable->showActionsInToolbar());

    }
}
