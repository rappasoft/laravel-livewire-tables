<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class DeferredLoadingConfigurationTest extends TestCase
{
    public function test_deferred_loading_is_disabled_by_default(): void
    {
        $this->assertFalse($this->basicTable->isDeferredLoading());
        $this->assertTrue($this->basicTable->deferredLoadingIsDisabled());
        $this->assertFalse($this->basicTable->deferredLoadingIsEnabled());
    }

    public function test_can_enable_deferred_loading(): void
    {
        $this->basicTable->deferLoading();

        $this->assertTrue($this->basicTable->isDeferredLoading());
        $this->assertTrue($this->basicTable->deferredLoadingIsEnabled());
        $this->assertFalse($this->basicTable->deferredLoadingIsDisabled());
    }

    public function test_can_disable_deferred_loading(): void
    {
        $this->basicTable->deferLoading();
        $this->assertTrue($this->basicTable->isDeferredLoading());

        $this->basicTable->disableDeferredLoading();

        $this->assertFalse($this->basicTable->isDeferredLoading());
        $this->assertTrue($this->basicTable->deferredLoadingIsDisabled());
    }
}


