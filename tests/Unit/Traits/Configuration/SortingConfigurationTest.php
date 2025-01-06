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
        $viewDesc = view('livewire-tables::datatable');

        $tempDesc->boot();
        $tempDesc->bootedComponentUtilities();
        $tempDesc->bootedManagesFilters();
        $tempDesc->bootedWithColumns();
        $tempDesc->bootedWithColumnSelect();
        $tempDesc->bootedWithSecondaryHeader();
        $tempDesc->booted();
        $tempDesc->mountManagesFilters();
        $tempDesc->mountWithSorting();
        $tempDesc->renderingWithColumns($viewDesc, $viewDesc->getData());
        $tempDesc->renderingWithColumnSelect($viewDesc, $viewDesc->getData());
        $tempDesc->renderingWithCustomisations($viewDesc, $viewDesc->getData());
        $tempDesc->renderingWithData($viewDesc, $viewDesc->getData());
        $tempDesc->renderingWithFooter($viewDesc, $viewDesc->getData());
        $tempDesc->renderingWithReordering($viewDesc, $viewDesc->getData());
        $tempDesc->renderingWithPagination($viewDesc, $viewDesc->getData());
        $tempDesc->render();
        $this->assertSame(['name' => 'desc'], $tempDesc->getSorts());
        $this->assertSame('desc', $tempDesc->getSort('name'));

        $tempAsc = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->setSortingEnabled();
                $this->setDefaultSort('name', 'asc');
            }
        };
        $viewAsc = view('livewire-tables::datatable');
        $tempAsc->boot();
        $tempAsc->bootedComponentUtilities();
        $tempAsc->bootedManagesFilters();
        $tempAsc->bootedWithColumns();
        $tempAsc->bootedWithColumnSelect();
        $tempAsc->bootedWithSecondaryHeader();
        $tempAsc->booted();
        $tempAsc->mountManagesFilters();
        $tempAsc->mountWithSorting();
        $tempAsc->renderingWithColumns($viewAsc, $viewAsc->getData());
        $tempAsc->renderingWithColumnSelect($viewAsc, $viewAsc->getData());
        $tempAsc->renderingWithCustomisations($viewAsc, $viewAsc->getData());
        $tempAsc->renderingWithData($viewAsc, $viewAsc->getData());
        $tempAsc->renderingWithFooter($viewAsc, $viewAsc->getData());
        $tempAsc->renderingWithReordering($viewAsc, $viewAsc->getData());
        $tempAsc->renderingWithPagination($viewAsc, $viewAsc->getData());
        $tempAsc->render();
        $this->assertSame(['name' => 'asc'], $tempAsc->getSorts());
        $this->assertSame('asc', $tempAsc->getSort('name'));

    }
}
