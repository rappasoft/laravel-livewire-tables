<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class EventConfigurationTest extends TestCase
{
    public function test_can_enable_all_events()
    {
        $this->assertTrue($this->basicTable->getEventStatusColumnSelect());
        $this->assertFalse($this->basicTable->getEventStatusSearchApplied());
        $this->assertFalse($this->basicTable->getEventStatusFilterApplied());

        $this->basicTable->enableAllEvents();

        $this->assertTrue($this->basicTable->getEventStatusColumnSelect());
        $this->assertTrue($this->basicTable->getEventStatusSearchApplied());
        $this->assertTrue($this->basicTable->getEventStatusFilterApplied());
    }

    public function test_can_disable_all_events()
    {
        $this->assertTrue($this->basicTable->getEventStatusColumnSelect());
        $this->assertFalse($this->basicTable->getEventStatusSearchApplied());
        $this->assertFalse($this->basicTable->getEventStatusFilterApplied());

        $this->basicTable->disableAllEvents();

        $this->assertFalse($this->basicTable->getEventStatusColumnSelect());
        $this->assertFalse($this->basicTable->getEventStatusSearchApplied());
        $this->assertFalse($this->basicTable->getEventStatusFilterApplied());
    }
}
