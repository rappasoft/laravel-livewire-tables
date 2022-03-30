<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class DebuggingConfigurationTest extends TestCase
{
    /** @test */
    public function debug_status_can_be_set(): void
    {
        $this->assertFalse($this->basicTable->getDebugStatus());

        $this->basicTable->setDebugEnabled();

        $this->assertTrue($this->basicTable->getDebugStatus());

        $this->basicTable->setDebugDisabled();

        $this->assertFalse($this->basicTable->getDebugStatus());

        $this->basicTable->setDebugStatus(true);

        $this->assertTrue($this->basicTable->getDebugStatus());

        $this->basicTable->setDebugStatus(false);

        $this->assertFalse($this->basicTable->getDebugStatus());
    }
}
