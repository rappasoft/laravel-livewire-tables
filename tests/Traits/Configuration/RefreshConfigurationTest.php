<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

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

    public function test_poll_with_seconds_format(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->poll('10s');

        $this->assertSame('10000', $this->basicTable->getRefreshStatus());
    }

    public function test_poll_with_minutes_format(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->poll('1m');

        $this->assertSame('60000', $this->basicTable->getRefreshStatus());
    }

    public function test_poll_with_hours_format(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->poll('2h');

        $this->assertSame('7200000', $this->basicTable->getRefreshStatus());
    }

    public function test_poll_with_multiple_minutes(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->poll('5m');

        $this->assertSame('300000', $this->basicTable->getRefreshStatus());
    }

    public function test_poll_with_numeric_string_treated_as_milliseconds(): void
    {
        $this->assertFalse($this->basicTable->getRefreshStatus());

        $this->basicTable->poll('5000');

        $this->assertSame('5000', $this->basicTable->getRefreshStatus());
    }
}
