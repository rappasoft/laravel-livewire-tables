<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Configuration;

use PHPUnit\Framework\Attributes\DataProvider;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class ConfigurableAreaConfigurationTest extends TestCase
{
    public static function configurableAreaProvider(): array
    {
        return [
            ['before-tools', 'path.to.my.before-tools.view'],
            ['toolbar-left-start', 'path.to.my.toolbar-left-start.view'],
            ['toolbar-left-end', 'path.to.my.toolbar-left-end.view'],
            ['toolbar-right-start', 'path.to.my.toolbar-right-start.view'],
            ['toolbar-right-end', 'path.to.my.toolbar-right-end.view'],
            ['before-toolbar', 'path.to.my.before-toolbar.view'],
            ['after-toolbar', 'path.to.my.after-toolbar.view'],
            ['after-tools', 'path.to.my.after-tools.view'],
            ['before-pagination', 'path.to.my.before-pagination.view'],
            ['after-pagination', 'path.to.my.after-pagination.view'],
        ];
    }

    #[DataProvider('configurableAreaProvider')]
    public function test_can_set_configurable_area(string $configurableArea, string $configurableAreaViewPath): void
    {
        $defaults = [
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
        ];
        $this->basicTable->setConfigurableAreas($defaults);

        $this->assertNull($this->basicTable->getConfigurableAreaFor($configurableArea));

        $this->basicTable->setConfigurableArea($configurableArea, $configurableAreaViewPath);

        $this->assertSame($configurableAreaViewPath, $this->basicTable->getConfigurableAreaFor($configurableArea));
    }

    public function test_can_set_multiple_configurable_areas(): void
    {
        $defaults = [
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
        ];
        $this->basicTable->setConfigurableAreas($defaults);

        $this->assertNull($this->basicTable->getConfigurableAreaFor('before-tools'));
        $this->assertNull($this->basicTable->getConfigurableAreaFor('after-toolbar'));

        $this->basicTable->setConfigurableArea('before-tools', 'path.to.before-tools.view');
        $this->assertSame('path.to.before-tools.view', $this->basicTable->getConfigurableAreaFor('before-tools'));

        $this->basicTable->setConfigurableArea('after-toolbar', 'path.to.after-toolbar.view');
        $this->assertSame('path.to.after-toolbar.view', $this->basicTable->getConfigurableAreaFor('after-toolbar'));
        $this->assertSame('path.to.before-tools.view', $this->basicTable->getConfigurableAreaFor('before-tools'));

    }

    public function test_can_set_hide_configurable_areas_when_reordering_status(): void
    {
        $this->assertTrue($this->basicTable->getHideConfigurableAreasWhenReorderingStatus());

        $this->basicTable->setHideConfigurableAreasWhenReorderingStatus(false);

        $this->assertFalse($this->basicTable->getHideConfigurableAreasWhenReorderingStatus());

        $this->basicTable->setHideConfigurableAreasWhenReorderingStatus(true);

        $this->assertTrue($this->basicTable->getHideConfigurableAreasWhenReorderingStatus());

        $this->basicTable->setHideConfigurableAreasWhenReorderingDisabled();

        $this->assertFalse($this->basicTable->getHideConfigurableAreasWhenReorderingStatus());

        $this->basicTable->setHideConfigurableAreasWhenReorderingEnabled();

        $this->basicTable->setHideConfigurableAreasWhenReorderingStatus(true);
    }
}
