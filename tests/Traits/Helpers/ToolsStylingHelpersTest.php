<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class ToolsStylingHelpersTest extends TestCase
{
    public function test_can_get_tools_attributes_initial_status(): void
    {
        $this->assertTrue($this->basicTable->hasCustomAttributes('toolsAttributes'));
    }

    public function test_can_get_tools_attributes_initial_values(): void
    {
        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => ''], $this->basicTable->getToolsAttributesBag()->getAttributes());
    }

    public function test_can_get_toolbar_attributes_initial_status(): void
    {
        $this->assertTrue($this->basicTable->hasCustomAttributes('toolBarAttributes'));
    }

    public function test_can_get_toolbar_attributes_initial_values(): void
    {
        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => ''], $this->basicTable->getToolBarAttributesBag()->getAttributes());
    }
}
