<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits;

use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class WithColumnsTest extends TestCase
{
    public function test_rendering_with_columns_returns_columns(): void
    {

        $testTableDefault = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->useComputedPropertiesDisabled();

            }
        };

        $view = view('livewire-tables::datatable');

        $testTableDefault->boot();
        $testTableDefault->mountManagesFilters();
        $testTableDefault->bootedComponentUtilities();
        $testTableDefault->bootedManagesFilters();
        $testTableDefault->bootedWithColumns();
        $testTableDefault->bootedWithColumnSelect();
        $testTableDefault->booted();
        $testTableDefault->renderingWithColumns($view, $view->getData());
        $testTableDefault->renderingWithColumnSelect($view, $view->getData());
        $testTableDefault->renderingWithCustomisations($view, $view->getData());
        $testTableDefault->renderingWithData($view, $view->getData());
        $testTableDefault->renderingWithReordering($view, $view->getData());
        $testTableDefault->renderingWithPagination($view, $view->getData());
        $testTableDefault->render();
        $this->assertSame(9, $view->getData()['columns']->count());
    }
}
