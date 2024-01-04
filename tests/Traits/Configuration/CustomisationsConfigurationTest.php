<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class CustomisationsConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_extends(): void
    {
        $this->assertFalse($this->basicTable->hasExtends());
        $this->assertNull($this->basicTable->getExtends());
        $this->basicTable->setExtends('app.layout');
        $this->assertTrue($this->basicTable->hasExtends());
        $this->assertEquals('app.layout', $this->basicTable->getExtends());
    }

    /** @test */
    public function can_set_layout(): void
    {
        $this->assertFalse($this->basicTable->hasLayout());
        $this->assertNull($this->basicTable->getLayout());
        $this->basicTable->setLayout('app.layout');
        $this->assertTrue($this->basicTable->hasLayout());
        $this->assertEquals('app.layout', $this->basicTable->getLayout());
    }

    /** @test */
    public function can_set_section(): void
    {
        $this->assertNull($this->basicTable->getSection());
        $this->assertFalse($this->basicTable->hasSection());
        $this->basicTable->setSection('content');
        $this->assertTrue($this->basicTable->hasSection());
        $this->assertEquals('content', $this->basicTable->getSection());
    }

    /** @test */
    public function can_set_slot(): void
    {
        $this->assertFalse($this->basicTable->hasSlot());
        $this->assertNull($this->basicTable->getSlot());
        $this->basicTable->setSlot('my_slot');
        $this->assertTrue($this->basicTable->hasSlot());
        $this->assertEquals('my_slot', $this->basicTable->getSlot());
    }
}
