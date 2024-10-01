<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals\Themed;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{PetsTable};
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

abstract class ThemedTestCase extends TestCase
{
    abstract protected function setupBasicTableForBrowsing();

    abstract protected function setupBasicTableSingleRecord();

    protected function setupBasicTableForLivewire()
    {
        return Livewire::test(PetsTable::class);
    }

    public function pagination_shows_by_default()
    {
        return $this->setupBasicTableForLivewire();
    }

    public function setupSingleRecordBasicTable()
    {
        return $this->setupBasicTableForLivewire()
            ->call('setPerPageAccepted', [1])
            ->call('setPerPage', 1);
    }

    public function tableWithStandardDetailedPagination()
    {
        return $this->setupBasicTableSingleRecord()
            ->call('enableDetailedPagination', 'standard');
    }

    public function tableWithSimpleDetailedPagination()
    {
        return $this->setupBasicTableSingleRecord()
            ->call('enableDetailedPagination', 'simple');
    }
}
