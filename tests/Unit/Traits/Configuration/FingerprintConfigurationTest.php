<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class FingerprintConfigurationTest extends TestCase
{
    public function test_can_set_fingerprint(): void
    {
        $this->assertSame('test', $this->basicTable->setDataTableFingerprint('test')->getDataTableFingerprint());
    }

    public function test_can_set_fingerprint_in_configure_method(): void
    {
        $mock = new class extends PetsTable
        {
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
