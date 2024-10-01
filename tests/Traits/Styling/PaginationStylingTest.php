<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Illuminate\View\ComponentAttributeBag;
use Livewire\Livewire;

final class PaginationStylingTest extends TestCase
{

    public function test_pagination_theme_can_be_set(): void
    {
        $this->assertSame('tailwind', $this->basicTable->getPaginationTheme());

        $this->basicTable->setPaginationTheme('bootstrap');

        $this->assertSame('bootstrap', $this->basicTable->getPaginationTheme());
    }

    public function test_can_get_per_page_field_attributes(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getPerPageFieldAttributes());

        $this->basicTable->setPerPageFieldAttributes(
            [
                'class' => 'bg-blue-500 dark:bg-red-500',
                'default-colors' => true,
            ]
        );

        $this->assertSame(['class' => 'bg-blue-500 dark:bg-red-500', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getPerPageFieldAttributes());

        $this->basicTable->setPerPageFieldAttributes(
            [
                'default-styling' => false,
            ]
        );

        $this->assertSame(['class' => 'bg-blue-500 dark:bg-red-500', 'default-colors' => true, 'default-styling' => false], $this->basicTable->getPerPageFieldAttributes());
    }

    public function test_can_get_per_page_wrapper_attributes(): void
    {

        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getPerPageWrapperAttributes());

        $this->basicTable->setPerPageWrapperAttributes(
            [
                'class' => 'bg-blue-500 dark:bg-red-500',
                'default-colors' => true,
            ]
        );

        $this->assertSame(['class' => 'bg-blue-500 dark:bg-red-500', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getPerPageWrapperAttributes());

        $this->basicTable->setPerPageWrapperAttributes(
            [
                'default-styling' => false,
            ]
        );

        $this->assertSame(['class' => 'bg-blue-500 dark:bg-red-500', 'default-colors' => true, 'default-styling' => false], $this->basicTable->getPerPageWrapperAttributes());
    }


    public function test_can_get_pagination_wrapper_attributes(): void
    {

        $this->assertSame(['class' => '', 'default' => false, 'default-colors' => false, 'default-styling' => false], $this->basicTable->getPaginationWrapperAttributes());

        $this->basicTable->setPaginationWrapperAttributes(['class' => 'text-lg']);

        $this->assertSame(['class' => 'text-lg', 'default' => false, 'default-colors' => false, 'default-styling' => false], $this->basicTable->getPaginationWrapperAttributes());

        $this->basicTable->setPaginationWrapperAttributes(['class' => 'text-lg', 'testval' => '456']);

        $this->assertSame(['class' => 'text-lg', 'default' => false, 'default-colors' => false, 'default-styling' => false, 'testval' => '456'], $this->basicTable->getPaginationWrapperAttributes());

    }

    public function test_can_get_pagination_wrapper_attributes_bag(): void
    {
        $this->assertSame((new ComponentAttributeBag(['class' => '', 'default' => false, 'default-colors' => false, 'default-styling' => false]))->getAttributes(), $this->basicTable->getPaginationWrapperAttributesBag()->getAttributes());

        $this->basicTable->setPaginationWrapperAttributes(['class' => 'text-lg']);

        $this->assertSame((new ComponentAttributeBag(['class' => 'text-lg', 'default' => false, 'default-colors' => false, 'default-styling' => false]))->getAttributes(), $this->basicTable->getPaginationWrapperAttributesBag()->getAttributes());

        $this->basicTable->setPaginationWrapperAttributes(['class' => 'text-lg', 'testval' => '123']);

        $this->assertSame((new ComponentAttributeBag(['class' => 'text-lg', 'default' => false, 'default-colors' => false, 'default-styling' => false, 'testval' => '123']))->getAttributes(), $this->basicTable->getPaginationWrapperAttributesBag()->getAttributes());

    }

    public function test_pagination_wrapper_merges_classes_in_frontend(): void
    {

            Livewire::test(new class extends PetsTable
            {
                public function configure(): void
                {
                    $this->setPrimaryKey('id')
                    ->setPaginationWrapperAttributes(['class' => 'pagiclass text-lg', 'testval' => '592', 'default' => true, 'default-colors' => true, 'default-styling' => true]);
                }
            })
            ->assertSeeHtml('<div class="mt-4 px-4 md:p-0 sm:flex justify-between items-center space-y-4 sm:space-y-0 pagiclass text-lg" testval="592"');

            Livewire::test(new class extends PetsTable
            {
                public function configure(): void
                {
                    $this->setPrimaryKey('id')
                    ->setPaginationWrapperAttributes(['class' => 'pagiclass text-lg', 'testval' => '592', 'default' => true, 'default-colors' => false, 'default-styling' => false]);
                }
            })
            ->assertSeeHtml('<div class="mt-4 px-4 md:p-0 sm:flex justify-between items-center space-y-4 sm:space-y-0 pagiclass text-lg" testval="592"');

    }

    public function test_pagination_wrapper_replaces_classes_in_frontend(): void
    {
        Livewire::test(new class extends PetsTable
            {
                public function configure(): void
                {
                    $this->setPrimaryKey('id')
                    ->setPaginationWrapperAttributes(['class' => 'pagiclass text-lg', 'testval' => '592', 'default' => false, 'default-colors' => false, 'default-styling' => false]);
                }
            })
            ->assertSeeHtml('<div class="pagiclass text-lg" testval="592"');

    }



    public function test_can_use_custom_pagination_blade(): void
    {
        $this->assertFalse($this->basicTable->hasCustomPaginationBlade());

        $this->assertSame("", $this->basicTable->getCustomPaginationBlade());

        $this->basicTable->setCustomPaginationBlade('custom_pagination_test_blade');

        $this->assertSame("custom_pagination_test_blade", $this->basicTable->getCustomPaginationBlade());

        $this->assertTrue($this->basicTable->hasCustomPaginationBlade());
    }


}