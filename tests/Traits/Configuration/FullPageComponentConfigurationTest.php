<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;

class FullPageComponentConfigurationTest extends TestCase
{

    /** @test */
    public function can_set_extends(): void
    {
        $this->basicTable->setExtends('app.layout');
        $this->assertEquals('app.layout', $this->basicTable->getExtends());
    }

    /** @test */
    public function can_set_layout(): void
    {
        $this->basicTable->setLayout('app.layout');
        $this->assertEquals('app.layout', $this->basicTable->getLayout());
    }

    /** @test */
    public function can_set_section(): void
    {
        $this->basicTable->setSection('content');
        $this->assertEquals('content', $this->basicTable->getSection());
    }

    /** @test */
    public function can_set_slot(): void
    {
        $this->basicTable->setSlot('my_slot');
        $this->assertEquals('my_slot', $this->basicTable->getSlot());
    }

}