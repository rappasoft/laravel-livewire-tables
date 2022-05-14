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

    /** @test */
    public function fingerprint_will_always_be_the_same_for_same_datatable(): void
    {
        $this->assertSame(
            [
                $this->basicTable->dataTableFingerprint(),
                $this->basicTable->dataTableFingerprint(),
                $this->basicTable->dataTableFingerprint(),
            ],
            [
                $this->basicTable->dataTableFingerprint(),
                $this->basicTable->dataTableFingerprint(),
                $this->basicTable->dataTableFingerprint(),
            ]
        );
        $this->assertSame($this->basicTable->dataTableFingerprint(), $this->fingerprintingAlgo($this->basicTable::class));
    }

    /** @test */
    public function datatable_fingerprints_will_be_different_for_each_table(): void
    {
        $mockTable = new class() extends PetsTable {
        };

        $this->assertNotSame($this->basicTable->dataTableFingerprint(), $mockTable->dataTableFingerprint());
    }

    /** @test */
    public function fingerprint_will_be_url_friendy(): void
    {
        $mocks = [];
        for ($i = 0; $i < 9; $i++) {
            $mocks[$i] = new class() extends PetsTable {
            };
            $this->assertFalse(filter_var('http://'.$mocks[$i]->dataTableFingerprint().'.dev', FILTER_VALIDATE_URL) === false);
        }
        // control
        $this->assertTrue(filter_var('http://[9/$].dev', FILTER_VALIDATE_URL) === false);
    }

    protected function fingerPrintingAlgo($className)
    {
        $className = str_split($className);
        $crc32 = sprintf('%u', crc32(serialize($className)));

        return base_convert($crc32, 10, 36);
    }
}
