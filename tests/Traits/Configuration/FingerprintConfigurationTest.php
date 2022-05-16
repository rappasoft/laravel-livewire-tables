<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class FingerprintConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_fingerprint(): void
    {
        $this->assertSame('test', $this->basicTable->setDataTableFingerprint('test')->getDataTableFingerprint());
    }
}
