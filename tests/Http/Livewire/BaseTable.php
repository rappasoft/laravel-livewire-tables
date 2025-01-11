<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;

abstract class BaseTable extends DataTableComponent
{
    
    public string $paginationTest = 'standard';

    public function enableDetailedPagination(string $type = 'standard')
    {
        $this->setPerPageAccepted([1, 3, 5, 10, 15, 25, 50])->setPerPage(3);
        $this->setPaginationMethod($type);
        $this->setDisplayPaginationDetailsEnabled();

    }

    public function disableDetailedPagination(string $type = 'standard')
    {
        $this->setPerPageAccepted([1, 3, 5, 10, 15, 25, 50])->setPerPage(3);
        $this->setPaginationMethod($type);
        $this->setDisplayPaginationDetailsDisabled();
    }

    public function setPaginationTest(string $type)
    {
        $this->paginationTest = $type;
    }

    public function bootAll()
    {
        $view = view('livewire-tables::datatable');

        $this->boot();
        $this->bootedComponentUtilities();
        $this->bootedManagesFilters();
        $this->bootedWithColumns();
        $this->bootedWithColumnSelect();
        $this->booted();
        $this->mountManagesFilters();
        $this->mountComponentUtilities();
        $this->mountWithSorting();
        $this->renderAll($view);
    }
    public function renderAll($view = null)
    {
        if (is_null($view))
        {
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