<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class FingerprintConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_fingerprint(): void
    {
        $this->assertSame('test', $this->basicTable->setDataTableFingerprint('test')->getDataTableFingerprint());
    }

    /** @test */
    public function can_set_fingerprint_in_configure_method(): void
    {
        $mock = new class extends PetsTable {
            public function configure(): void
            {
                $this->setDataTableFingerprint('test');
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame('test', $mock->getDataTableFingerprint());
    }
}
