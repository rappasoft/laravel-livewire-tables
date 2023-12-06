<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class CustomisationsConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_extends(): void
    {
        $this->assertNull($this->basicTable->getExtends());
        $this->basicTable->setExtends('app.layout');
        $this->assertEquals('app.layout', $this->basicTable->getExtends());
    }

    /** @test */
    public function can_set_layout(): void
    {
        $this->assertNull($this->basicTable->getLayout());
        $this->basicTable->setLayout('app.layout');
        $this->assertEquals('app.layout', $this->basicTable->getLayout());
    }

    /** @test */
    public function can_set_section(): void
    {
        $this->assertNull($this->basicTable->getSection());
        $this->basicTable->setSection('content');
        $this->assertEquals('content', $this->basicTable->getSection());
    }

    /** @test */
    public function can_set_slot(): void
    {
        $this->assertNull($this->basicTable->getSlot());
        $this->basicTable->setSlot('my_slot');
        $this->assertEquals('my_slot', $this->basicTable->getSlot());
    }
}