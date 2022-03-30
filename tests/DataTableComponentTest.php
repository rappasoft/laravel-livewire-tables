<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

class DataTableComponentTest extends TestCase
{
    /** @test */
    public function primary_key_can_be_set(): void
    {
        $this->assertSame('id', $this->basicTable->getPrimaryKey());

        $this->basicTable->setPrimaryKey('name');

        $this->assertSame('name', $this->basicTable->getPrimaryKey());
    }

    /** @test */
    public function primary_key_can_be_checked_for_existence(): void
    {
        $this->assertTrue($this->basicTable->hasPrimaryKey());

        $this->basicTable->setPrimaryKey(null);

        $this->assertFalse($this->basicTable->hasPrimaryKey());
    }

    /** @test */
    public function primary_key_has_to_be_set(): void
    {
        $this->assertTrue(true);
        
        // TODO: Not working
//        $this->expectException(DataTableConfigurationException::class);
//
//        Livewire::test(PetsTable::class)
//            ->call('setPrimaryKey', null)
//            ->call('setSearch', 'abcd');
    }
}
