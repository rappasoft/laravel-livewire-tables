<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;

class FilteredBulkActionsTable extends PetsTable
{
    public function configure(): void
    {
        parent::configure();

        $this->setBulkActions(['activate' => 'Activate']);
        $this->setBulkActionsRowFilter(fn (Pet $row) => $row->id !== 2);
    }
}
