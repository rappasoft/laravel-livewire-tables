<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Actions;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Actions\Action;

final class ActionTest extends TestCase
{
    public function test_can_get_action_button_label(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default' => true])
            ->setIcon('fas fa-minus')
            ->setIconAttributes(['class' => 'font-sm text-sm'])
            ->wireNavigate()
            ->route('dashboard2');

        $this->assertSame('Update Summaries', $action->getLabel());
    }

    public function test_can_get_action_button_icon(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default' => true])
            ->wireNavigate()
            ->route('dashboard2');
        $this->assertFalse($action->hasIcon());
        $this->assertFalse($action->hasIconAttributes());
        $action->setIcon('fas fa-minus');
        $this->assertTrue($action->hasIcon());
        $this->assertFalse($action->hasIconAttributes());
        $this->assertSame('fas fa-minus', $action->getIcon());

    }

    public function test_can_get_action_button_icon_attributes(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default' => true])
            ->wireNavigate()
            ->route('dashboard2');
        $this->assertFalse($action->hasIcon());
        $this->assertFalse($action->hasIconAttributes());

        $action->setIconAttributes(['class' => 'font-sm text-sm']);
        $this->assertTrue($action->hasIconAttributes());
        $this->assertSame(['class' => 'font-sm text-sm'], $action->getIconAttributes());
        $bag = new \Illuminate\View\ComponentAttributeBag(['class' => 'font-sm text-sm']);
        $this->assertSame($bag->getAttributes(), $action->getIconAttributesBag()->getAttributes());
    }

    public function test_can_get_action_button_route(): void
    {
        $action = Action::make('Update Summaries')
            ->setActionAttributes(['class' => 'dark:bg-green-500 dark:text-white dark:border-green-600 dark:hover:border-green-900 dark:hover:bg-green-800', 'default' => true])
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
}
