<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class ConfigurableAreaHelpersTest extends TestCase
{
    public function test_can_get_configurable_areas(): void
    {
        $this->assertEquals([
            'before-tools' => null,
            'toolbar-left-start' => null,
            'toolbar-left-end' => null,
            'toolbar-right-start' => null,
            'toolbar-right-end' => null,
            'before-toolbar' => null,
            'after-toolbar' => null,
            'after-tools' => null,
            'before-pagination' => null,
            'after-pagination' => null,
        ], $this->basicTable->getConfigurableAreas());

        $this->basicTable->setConfigurableAreas([
            'toolbar-left-start' => 'includes.areas.toolbar-left-start',
        ]);

        $this->assertEquals('includes.areas.toolbar-left-start', $this->basicTable->getConfigurableAreaFor('toolbar-left-start'));

        $this->basicTable->setConfigurableAreas([
            'toolbar-left-start' => ['includes.areas.toolbar-left-start', ['param1' => 'hello']],
        ]);

        $this->assertEquals('includes.areas.toolbar-left-start', $this->basicTable->getConfigurableAreaFor('toolbar-left-start'));
    }

    public function test_can_get_configurable_area_parameters(): void
    {
        $this->basicTable->setConfigurableAreas([
            'toolbar-left-start' => 'includes.areas.toolbar-left-start',
        ]);

        $this->assertEquals([], $this->basicTable->getParametersForConfigurableArea('toolbar-left-start'));

        $this->basicTable->setConfigurableAreas([
            'toolbar-left-start' => ['includes.areas.toolbar-left-start', ['param1' => 'hello']],
        ]);

        $this->assertEquals(['param1' => 'hello'], $this->basicTable->getParametersForConfigurableArea('toolbar-left-start'));
    }

    public function test_can_get_hide_configurable_areas_when_reordering_status(): void
    {
        $this->assertTrue($this->basicTable->getHideConfigurableAreasWhenReorderingStatus());

        $this->assertTrue($this->basicTable->hideConfigurableAreasWhenReorderingIsEnabled());

        $this->basicTable->setHideConfigurableAreasWhenReorderingDisabled();

        $this->assertTrue($this->basicTable->hideConfigurableAreasWhenReorderingIsDisabled());

        $this->assertFalse($this->basicTable->hideConfigurableAreasWhenReorderingIsEnabled());

        $this->basicTable->setHideConfigurableAreasWhenReorderingEnabled();

        $this->assertTrue($this->basicTable->hideConfigurableAreasWhenReorderingIsEnabled());

        $this->assertFalse($this->basicTable->hideConfigurableAreasWhenReorderingIsDisabled());
    }
}
