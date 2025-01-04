<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class ConfigurableAreaConfigurationTest extends TestCase
{
    public function test_can_set_configurable_area(): void
    {
        $this->assertNull($this->basicTable->getConfigurableAreaFor('before-tools'));

        $this->basicTable->setConfigurableArea('before-tools', 'path.to.my.view');

        $this->assertSame('path.to.my.view', $this->basicTable->getConfigurableAreaFor('before-tools'));
    }
}
