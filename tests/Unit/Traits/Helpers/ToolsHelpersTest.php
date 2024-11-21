<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class ToolsHelpersTest extends TestCase
{
    public function test_can_get_toolbar_status(): void
    {
        $this->assertTrue($this->basicTable->getToolBarStatus());
        $this->assertTrue($this->basicTable->getToolsStatus());

        $this->basicTable->setToolBarDisabled();

        $this->assertFalse($this->basicTable->getToolBarStatus());
        $this->assertTrue($this->basicTable->getToolsStatus());

        $this->basicTable->setToolBarEnabled();

        $this->assertTrue($this->basicTable->getToolBarStatus());
        $this->assertTrue($this->basicTable->getToolsStatus());

    }

    public function test_can_get_tools_status(): void
    {
        $this->assertTrue($this->basicTable->getToolsStatus());
        $this->assertTrue($this->basicTable->getToolBarStatus());

        $this->basicTable->setToolsDisabled();

        $this->assertFalse($this->basicTable->getToolsStatus());
        $this->assertTrue($this->basicTable->getToolBarStatus());

        $this->basicTable->setToolsEnabled();

        $this->assertTrue($this->basicTable->getToolsStatus());
        $this->assertTrue($this->basicTable->getToolBarStatus());

    }

    public function test_can_get_tools_should_display(): void
    {
        $this->assertTrue($this->basicTable->getToolsStatus());
        $this->assertTrue($this->basicTable->getToolBarStatus());
        $this->assertTrue($this->basicTable->shouldShowTools());
        $this->assertTrue($this->basicTable->shouldShowToolBar());

        $this->basicTable->setToolsDisabled();

        $this->assertFalse($this->basicTable->getToolsStatus());
        $this->assertTrue($this->basicTable->getToolBarStatus());
        $this->assertFalse($this->basicTable->shouldShowTools());
        $this->assertFalse($this->basicTable->shouldShowToolBar());
    }

    public function test_can_get_toolbar_display(): void
    {
        $this->assertTrue($this->basicTable->getToolsStatus());
        $this->assertTrue($this->basicTable->getToolBarStatus());
        $this->basicTable->setFiltersDisabled();
        $this->basicTable->setSingleSortingDisabled();
        $this->basicTable->setSearchDisabled();
        $this->basicTable->setColumnSelectDisabled();
        $this->basicTable->setPerPageVisibilityDisabled();
        $this->basicTable->setSortingDisabled();
        $this->basicTable->setSortingPillsDisabled();

        $this->assertTrue($this->basicTable->getToolsStatus());
        $this->assertTrue($this->basicTable->getToolBarStatus());
        $this->assertFalse($this->basicTable->shouldShowToolBar());

    }

    public function test_can_get_tools_display(): void
    {
        $this->assertTrue($this->basicTable->getToolsStatus());
        $this->assertTrue($this->basicTable->getToolBarStatus());
        $this->basicTable->setSearchDisabled()
            ->setColumnSelectDisabled()
            ->setPerPageVisibilityDisabled();
        $this->basicTable->setSorts(['id' => 'asc', 'name' => 'desc']);

        $this->assertTrue($this->basicTable->shouldShowToolBar());
        $this->assertTrue($this->basicTable->shouldShowTools());

        $this->basicTable->setFiltersDisabled();

        $this->assertFalse($this->basicTable->shouldShowToolBar());
        $this->assertTrue($this->basicTable->shouldShowTools());

        $this->basicTable->setSortingDisabled();

        $this->assertFalse($this->basicTable->shouldShowToolBar());
        $this->assertFalse($this->basicTable->shouldShowTools());

        $this->basicTable->setFiltersEnabled();

        $this->assertTrue($this->basicTable->shouldShowToolBar());
        $this->assertTrue($this->basicTable->shouldShowTools());

        $this->basicTable->clearSorts();

        $this->assertTrue($this->basicTable->shouldShowToolBar());
        $this->assertTrue($this->basicTable->shouldShowTools());

        $this->basicTable->setFiltersDisabled();

        $this->assertFalse($this->basicTable->shouldShowToolBar());
        $this->assertFalse($this->basicTable->shouldShowTools());

    }

    public function test_can_get_tools_status_no_sortpills(): void
    {
        $this->assertTrue($this->basicTable->shouldShowTools());

        $this->basicTable->setToolsEnabled();
        $this->basicTable->setSortingDisabled();
        $this->basicTable->setToolBarDisabled();
        $this->assertFalse($this->basicTable->shouldShowTools());

        $this->basicTable->setFiltersEnabled();
        $this->basicTable->setFilter('pet_name_filter', 'Test');

        $this->assertTrue($this->basicTable->shouldShowTools());

    }

    public function test_can_get_tools_status_toolbar_disabled(): void
    {
        $this->assertTrue($this->basicTable->shouldShowTools());
        $this->basicTable->setToolsEnabled();
        $this->basicTable->setToolBarDisabled();
        $this->assertFalse($this->basicTable->shouldShowToolBar());

    }
}
