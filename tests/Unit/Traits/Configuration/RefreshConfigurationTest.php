<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class RefreshConfigurationTest extends TestCase
{
    public function test_refresh_time_can_be_set(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->setRefreshTime(5000);

        $this->assertSame('5000', $this->basicTable->getRefreshStatus());
    }

    public function test_refresh_keep_alive_can_be_set(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->setRefreshKeepAlive();

        $this->assertSame('keep-alive', $this->basicTable->getRefreshStatus());
    }

    public function test_refresh_visible_can_be_set(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->setRefreshVisible();

        $this->assertSame('visible', $this->basicTable->getRefreshStatus());
    }

    public function test_refresh_method_can_be_set(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->setRefreshMethod('myRefreshMethod');

        $this->assertSame('myRefreshMethod', $this->basicTable->getRefreshStatus());
    }
}
