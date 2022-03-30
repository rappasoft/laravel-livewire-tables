<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class RefreshConfigurationTest extends TestCase
{
    /** @test */
    public function refresh_time_can_be_set(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->setRefreshTime(5000);

        $this->assertSame(5000, $this->basicTable->getRefreshStatus());
    }

    /** @test */
    public function refresh_keep_alive_can_be_set(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->setRefreshKeepAlive();

        $this->assertSame('keep-alive', $this->basicTable->getRefreshStatus());
    }

    /** @test */
    public function refresh_visible_can_be_set(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->setRefreshVisible();

        $this->assertSame('visible', $this->basicTable->getRefreshStatus());
    }

    /** @test */
    public function refresh_method_can_be_set(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->setRefreshMethod('myRefreshMethod');

        $this->assertSame('myRefreshMethod', $this->basicTable->getRefreshStatus());
    }
}
