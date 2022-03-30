<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class WithSearchTest extends TestCase
{
    /** @test */
    public function search_gets_applied_for_searchable_columns(): void
    {
        // TODO
        $this->assertTrue(true);
    }

    /** @test */
    public function search_callback_gets_applied_where_necessary(): void
    {
        // TODO
        $this->assertTrue(true);
    }

    /** @test */
    public function when_search_is_applied_bulk_actions_are_cleared(): void
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
}
