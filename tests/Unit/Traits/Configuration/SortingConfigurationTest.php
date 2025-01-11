<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class SortingConfigurationTest extends TestCase
{
    public function test_can_set_sorting_status(): void
    {
        $this->assertTrue($this->basicTable->getSortingStatus());

        $this->basicTable->setSortingDisabled();

        $this->assertFalse($this->basicTable->getSortingStatus());

        $this->basicTable->setSortingEnabled();

        $this->assertTrue($this->basicTable->getSortingStatus());

        $this->basicTable->setSortingStatus(false);

        $this->assertFalse($this->basicTable->getSortingStatus());

        $this->basicTable->setSortingStatus(true);

        $this->assertTrue($this->basicTable->getSortingStatus());
    }

    public function test_can_set_single_sorting_status(): void
    {
        $this->assertTrue($this->basicTable->getSingleSortingStatus());

        $this->basicTable->setSingleSortingDisabled();

        $this->assertFalse($this->basicTable->getSingleSortingStatus());

        $this->basicTable->setSingleSortingEnabled();

        $this->assertTrue($this->basicTable->getSingleSortingStatus());

        $this->basicTable->setSingleSortingStatus(false);

        $this->assertFalse($this->basicTable->getSingleSortingStatus());

        $this->basicTable->setSingleSortingStatus(true);

        $this->assertTrue($this->basicTable->getSingleSortingStatus());
    }

    public function test_can_set_default_sort(): void
    {
        $this->assertNull($this->basicTable->getDefaultSortColumn());
        $this->assertSame('asc', $this->basicTable->getDefaultSortDirection());

        $this->basicTable->setDefaultSort('id', 'desc');

        $this->assertSame('id', $this->basicTable->getDefaultSortColumn());
        $this->assertSame('desc', $this->basicTable->getDefaultSortDirection());
    }

    public function test_can_remove_default_sort(): void
    {
        $this->basicTable->setDefaultSort('id', 'desc');

        $this->assertSame('id', $this->basicTable->getDefaultSortColumn());
        $this->assertSame('desc', $this->basicTable->getDefaultSortDirection());

        $this->basicTable->removeDefaultSort();

        $this->assertNull($this->basicTable->getDefaultSortColumn());
        $this->assertSame('asc', $this->basicTable->getDefaultSortDirection());
    }

    public function test_can_set_sorting_pill_status(): void
    {
        $this->assertTrue($this->basicTable->getSortingPillsStatus());

        $this->basicTable->setSortingPillsDisabled();

        $this->assertFalse($this->basicTable->getSortingPillsStatus());

        $this->basicTable->setSortingPillsEnabled();

        $this->assertTrue($this->basicTable->getSortingPillsStatus());

        $this->basicTable->setSortingPillsStatus(false);

        $this->assertFalse($this->basicTable->getSortingPillsStatus());

        $this->basicTable->setSortingPillsStatus(true);

        $this->assertTrue($this->basicTable->getSortingPillsStatus());
    }

    public function test_default_sort_applies_correctly(): void
    {
        $tempDesc = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->setSortingEnabled();
                $this->setDefaultSort('name', 'desc');
            }
        };

        $tempAsc = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->setSortingEnabled();
                $this->setDefaultSort('name', 'asc');
            }
        };

        $viewDesc = view('livewire-tables::datatable');
        $tempDesc->bootAll();
        $tempDesc->renderAll($viewDesc);
        $viewAsc = view('livewire-tables::datatable');
        $tempAsc->bootAll();
        $tempAsc->renderAll($viewAsc);

        $this->assertSame(['name' => 'desc'], $tempDesc->getSorts());
        $this->assertSame('desc', $tempDesc->getSort('name'));

        $this->assertSame(['name' => 'asc'], $tempAsc->getSorts());
        $this->assertSame('asc', $tempAsc->getSort('name'));

    }
}
