<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class LoadingPlaceholderHelpersTest extends TestCase
{
    public function test_can_get_loading_placeholder_status(): void
    {
        $this->assertFalse($this->basicTable->hasDisplayLoadingPlaceholder());

        $this->basicTable->setLoadingPlaceholderEnabled();

        $this->assertTrue($this->basicTable->getDisplayLoadingPlaceholder());

        $this->assertTrue($this->basicTable->hasDisplayLoadingPlaceholder());

    }
}
