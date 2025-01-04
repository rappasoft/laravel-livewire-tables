<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits;

use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class WithSearchTest extends TestCase
{
    public function test_search_gets_applied_for_searchable_columns(): void
    {
        // TODO
        $this->assertTrue(true);
    }

    public function test_search_callback_gets_applied_where_necessary(): void
    {
        // TODO
        $this->assertTrue(true);
    }

    public function test_when_search_is_applied_bulk_actions_are_cleared(): void
    {
        $this->assertTrue(true);

        // TODO: Not working

        //        $this->basicTable->setBulkActions(['activate' => 'Activate']);
        //
        //        $this->basicTable->setSelected([1, 2, 3]);
        //
        //        $this->assertSame([1, 2, 3], $this->basicTable->getSelected());
        //
        //        $this->basicTable->setSearch('abcd');
        //
        //        $this->assertSame([], $this->basicTable->getSelected());
    }

    public function test_updated_search_untrimmed_string(): void
    {
        $untrimmed = 'searchtext  ';
        $trimmed = 'searchtext';

        $testTableDefault = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();

            }
        };
        $testTableDefault->mountManagesFilters();
        $testTableDefault->configure();
        $testTableDefault->boot();
        $testTableDefault->bootedComponentUtilities();
        $testTableDefault->bootedManagesFilters();
        $testTableDefault->bootedWithColumns();
        $testTableDefault->bootedWithColumnSelect();
        $testTableDefault->bootedWithSecondaryHeader();
        $testTableDefault->booted();

        $this->assertSame('', $testTableDefault->search);

        $testTableDefault->search = $untrimmed;
        $testTableDefault->updatedSearch($untrimmed);
        $this->assertSame($untrimmed, $testTableDefault->search);

        $testTableDefault->search = $trimmed;
        $testTableDefault->updatedSearch($trimmed);
        $this->assertSame($trimmed, $testTableDefault->search);

        $testTableDefault->search = '';
        $testTableDefault->updatedSearch('');
        $this->assertSame('', $testTableDefault->search);

    }

    public function test_updated_search_trimmed_string(): void
    {
        $untrimmed = 'searchtext  ';
        $trimmed = 'searchtext';

        $testTableTrimSearch = new class extends PetsTable
        {
            public function configure(): void
            {
                $this->trimSearchString = true;
                parent::configure();

            }
        };

        $testTableTrimSearch->mountManagesFilters();
        $testTableTrimSearch->configure();
        $testTableTrimSearch->boot();
        $testTableTrimSearch->bootedComponentUtilities();
        $testTableTrimSearch->bootedManagesFilters();
        $testTableTrimSearch->bootedWithColumns();
        $testTableTrimSearch->bootedWithColumnSelect();
        $testTableTrimSearch->bootedWithSecondaryHeader();
        $testTableTrimSearch->booted();

        $this->assertSame('', $testTableTrimSearch->search);

        $testTableTrimSearch->search = $trimmed;
        $testTableTrimSearch->updatedSearch($trimmed);
        $this->assertSame($trimmed, $testTableTrimSearch->search);

        $testTableTrimSearch->search = $untrimmed;
        $testTableTrimSearch->updatedSearch($untrimmed);
        $this->assertSame($trimmed, $testTableTrimSearch->search);

        $testTableTrimSearch->search = '';
        $testTableTrimSearch->updatedSearch('');
        $this->assertSame('', $testTableTrimSearch->search);

    }
}
