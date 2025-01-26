<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\Traits;

trait TestPaginationHelpers
{
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
}
