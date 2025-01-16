<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits;

use Livewire\Features\SupportPageComponents\PageComponentConfig;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class WithCustomisationsTest extends TestCase
{
    public function test_can_use_as_full_page(): void
    {
        $temp = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();

                $this->setLayout('livewire-tables::tests.layout1');

            }
        };
        $view = view('livewire-tables::datatable');

        $temp->bootAll();
        $view = $temp->renderAll();

        $layoutConfig = $view->getData()['layoutConfig'];

        $this->assertSame($temp->getLayout(), $layoutConfig->view);
    }

    public function test_can_set_custom_section(): void
    {
        $temp = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();

                $this->setSection('test-section-1');

            }
        };
        $view = view('livewire-tables::datatable');

        $temp->bootAll();
        $view = $temp->renderAll();

        $layoutConfig = $view->getData()['layoutConfig'];

        $this->assertSame($temp->getSection(), $layoutConfig->slotOrSection);
    }

    public function test_can_set_custom_slot(): void
    {
        $temp = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();

                $this->setSlot('test-slot-1');

            }
        };
        $view = view('livewire-tables::datatable');

        $temp->bootAll();
        $view = $temp->renderAll();
        $layoutConfig = $view->getData()['layoutConfig'];

        $this->assertSame($temp->getSlot(), $layoutConfig->slotOrSection);
    }

    public function test_can_set_custom_extends(): void
    {
        $temp = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();

                $this->setExtends('test-extends-1');

            }
        };
        $view = view('livewire-tables::datatable');

        $temp->bootAll();
        $view = $temp->renderAll();
        $layoutConfig = $view->getData()['layoutConfig'];
        $this->assertSame('extends', $layoutConfig->type);
        $this->assertSame($temp->getExtends(), $layoutConfig->view);
        $this->assertSame('content', $layoutConfig->slotOrSection);
    }
}
