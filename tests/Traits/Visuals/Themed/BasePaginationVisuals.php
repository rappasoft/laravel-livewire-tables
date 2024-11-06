<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals\Themed;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

abstract class BasePaginationVisuals extends ThemedTestCase
{
    abstract protected function setupBasicTableForBrowsing();

    abstract protected function setupBasicTableSingleRecord();

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

    public function test_per_page_dropdown_only_renders_with_accepted_values(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $this->setupBasicTableForBrowsing()
            ->call('setPerPage', 15);
    }
}
