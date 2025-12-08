<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class SummariesConfigurationTest extends TestCase
{
    public function test_summaries_are_disabled_by_default(): void
    {
        $this->assertFalse($this->basicTable->getSummariesStatus());
        $this->assertTrue($this->basicTable->summariesAreDisabled());
        $this->assertFalse($this->basicTable->summariesAreEnabled());
    }

    public function test_can_enable_summaries(): void
    {
        $this->basicTable->setSummariesEnabled();

        $this->assertTrue($this->basicTable->getSummariesStatus());
        $this->assertTrue($this->basicTable->summariesAreEnabled());
        $this->assertFalse($this->basicTable->summariesAreDisabled());
    }

    public function test_can_disable_summaries(): void
    {
        $this->basicTable->setSummariesEnabled();
        $this->assertTrue($this->basicTable->getSummariesStatus());

        $this->basicTable->setSummariesDisabled();

        $this->assertFalse($this->basicTable->getSummariesStatus());
        $this->assertTrue($this->basicTable->summariesAreDisabled());
    }

    public function test_can_set_summaries_status(): void
    {
        $this->basicTable->setSummariesStatus(true);

        $this->assertTrue($this->basicTable->getSummariesStatus());

        $this->basicTable->setSummariesStatus(false);

        $this->assertFalse($this->basicTable->getSummariesStatus());
    }
}


