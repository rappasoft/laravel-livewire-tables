<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\Traits;

trait TestHelpers
{
    use TestPaginationHelpers;

    public function bootAll()
    {
        $view = view('livewire-tables::datatable');

        $this->boot();
        $this->bootedComponentUtilities();
        $this->bootedHasFiltersCore();
        $this->bootedWithColumns();
        $this->bootedWithColumnSelect();
        $this->booted();
        $this->mountHasFiltersCore();
        $this->mountComponentUtilities();
        $this->mountWithSorting();
        $this->renderAll($view);
    }

    public function renderAll($view = null)
    {
        if (is_null($view)) {
            $view = view('livewire-tables::datatable');
        }
        $this->renderingWithColumns($view, $view->getData());
        $this->renderingWithColumnSelect($view, $view->getData());
        $this->renderingWithCustomisations($view, $view->getData());
        $this->renderingWithData($view, $view->getData());
        $this->renderingWithReordering($view, $view->getData());
        $this->renderingWithPagination($view, $view->getData());
        $this->render();

        return $view;
    }
}
