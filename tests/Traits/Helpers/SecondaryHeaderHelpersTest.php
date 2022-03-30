<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class SecondaryHeaderHelpersTest extends TestCase
{
    /** @test */
    public function can_get_secondary_header_status(): void
    {
        $this->assertTrue($this->basicTable->secondaryHeaderIsEnabled());

        $this->basicTable->setSecondaryHeaderDisabled();

        $this->assertTrue($this->basicTable->secondaryHeaderIsDisabled());

        $this->basicTable->setSecondaryHeaderEnabled();

        $this->assertTrue($this->basicTable->secondaryHeaderIsEnabled());
    }
}
