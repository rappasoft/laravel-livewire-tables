<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class LoadingConfigurationTest extends TestCase
{
    /** @test */
    public function can_set_loading_placeholder_status_enabled(): void
    {
        $this->assertFalse($this->basicTable->hasDisplayLoadingPlaceholder());

        $this->basicTable->setLoadingPlaceholderEnabled();

        $this->assertTrue($this->basicTable->hasDisplayLoadingPlaceholder());

    }

    /** @test */
    public function can_set_loading_placeholder_status_disabled(): void
    {
        $this->assertFalse($this->basicTable->hasDisplayLoadingPlaceholder());

        $this->basicTable->setLoadingPlaceholderEnabled();

        $this->assertTrue($this->basicTable->hasDisplayLoadingPlaceholder());

        $this->basicTable->setLoadingPlaceholderDisabled();

        $this->assertFalse($this->basicTable->hasDisplayLoadingPlaceholder());

    }
}
