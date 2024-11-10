<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class ToolsStylingHelpersTest extends TestCase
{
    public function test_can_get_tools_attributes_initial_status(): void
    {
        $this->assertTrue($this->basicTable->hasCustomAttributes('toolsAttributes'));
    }

    public function test_can_get_tools_attributes_initial_values(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getToolsAttributesBag()->getAttributes());
    }

    public function test_can_change_tools_attributes_initial_values(): void
    {
        $this->basicTable->setToolsAttributes(['class' => 'bg-red-500', 'default-colors' => true, 'default-styling' => true]);
        $this->assertSame(['class' => 'bg-red-500', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getToolsAttributesBag()->getAttributes());
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getToolBarAttributesBag()->getAttributes());
    }

    public function test_can_change_tools_attributes_initial_values_no_defaults(): void
    {
        $this->basicTable->setToolsAttributes(['class' => 'bg-amber-500']);
        $this->assertSame(['class' => 'bg-amber-500', 'default-colors' => false, 'default-styling' => false], $this->basicTable->getToolsAttributesBag()->getAttributes());
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getToolBarAttributesBag()->getAttributes());

    }

    public function test_can_get_toolbar_attributes_initial_status(): void
    {
        $this->assertTrue($this->basicTable->hasCustomAttributes('toolBarAttributes'));
    }

    public function test_can_get_toolbar_attributes_initial_values(): void
    {
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getToolBarAttributesBag()->getAttributes());
    }

    public function test_can_change_toolbar_attributes_initial_values(): void
    {
        $this->basicTable->setToolBarAttributes(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => true]);
        $this->assertSame(['class' => 'bg-blue-500', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getToolBarAttributesBag()->getAttributes());
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getToolsAttributesBag()->getAttributes());

    }

    public function test_can_change_toolbar_attributes_initial_values_no_defaults(): void
    {
        $this->basicTable->setToolBarAttributes(['class' => 'bg-green-500']);
        $this->assertSame(['class' => 'bg-green-500', 'default-colors' => false, 'default-styling' => false], $this->basicTable->getToolBarAttributesBag()->getAttributes());
        $this->assertSame(['class' => '', 'default-colors' => true, 'default-styling' => true], $this->basicTable->getToolsAttributesBag()->getAttributes());
    }

    public function test_can_change_tools_and_toolbar_attributes_initial_values_no_defaults(): void
    {
        $this->basicTable->setToolsAttributes(['class' => 'bg-amber-500'])->setToolBarAttributes(['class' => 'bg-green-500']);

        $this->assertSame(['class' => 'bg-amber-500', 'default-colors' => false, 'default-styling' => false], $this->basicTable->getToolsAttributesBag()->getAttributes());

        $this->assertSame(['class' => 'bg-green-500', 'default-colors' => false, 'default-styling' => false], $this->basicTable->getToolBarAttributesBag()->getAttributes());
    }
}
