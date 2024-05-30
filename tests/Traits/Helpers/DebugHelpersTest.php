<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class DebugHelpersTest extends TestCase
{
    public function test_can_get_debug_status(): void
    {
        $this->assertTrue($this->basicTable->debugIsDisabled());

        $this->basicTable->setDebugEnabled();

        $this->assertTrue($this->basicTable->debugIsEnabled());

        $this->basicTable->setDebugDisabled();

        $this->assertTrue($this->basicTable->debugIsDisabled());
    }
}
