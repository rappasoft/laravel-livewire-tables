<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class ComponentHelpersTest extends TestCase
{
    /** @test */
    public function can_see_if_component_has_model(): void
    {
        $this->assertTrue($this->basicTable->hasModel());
    }

    /** @test */
    public function can_get_component_model(): void
    {
        $this->assertSame(Pet::class, $this->basicTable->getModel());
    }

    /** @test */
    public function can_get_current_theme(): void
    {
        $this->assertEquals('tailwind', $this->basicTable->getTheme());
    }

    /** @test */
    public function can_get_empty_message(): void
    {
        $this->assertEquals('No items found. Try to broaden your search.', $this->basicTable->getEmptyMessage());
    }

    /** @test */
    public function can_get_offline_status(): void
    {
        $this->assertTrue($this->basicTable->getOfflineIndicatorStatus());

        $this->assertTrue($this->basicTable->offlineIndicatorIsEnabled());

        $this->basicTable->setOfflineIndicatorDisabled();

        $this->assertTrue($this->basicTable->offlineIndicatorIsDisabled());

        $this->assertFalse($this->basicTable->getOfflineIndicatorStatus());
    }

    /** @test */
    public function can_get_default_sorting_labels(): void
    {
        $this->assertSame('A-Z', $this->basicTable->getDefaultSortingLabelAsc());
        $this->assertSame('Z-A', $this->basicTable->getDefaultSortingLabelDesc());
    }

    /** @test */
    public function can_get_query_string_status(): void
    {
        $this->assertTrue($this->basicTable->getQueryStringStatus());

        $this->assertTrue($this->basicTable->queryStringIsEnabled());

        $this->basicTable->setQueryStringDisabled();

        $this->assertTrue($this->basicTable->queryStringIsDisabled());

        $this->assertFalse($this->basicTable->getQueryStringStatus());
    }

    /** @test */
    public function can_get_table_name(): void
    {
        $this->assertSame('table', $this->basicTable->getTableName());

        $this->basicTable->setTableName('table2');

        $this->assertSame('table2', $this->basicTable->getTableName());
    }

    /** @test */
    public function can_get_page_name(): void
    {
        $this->assertNull($this->basicTable->getPageName());

        $this->basicTable->setPageName('page2');

        $this->assertSame('page2', $this->basicTable->getPageName());
    }

    /** @test */
    public function can_check_if_table_equals_name(): void
    {
        $this->assertTrue($this->basicTable->isTableNamed('table'));
        $this->assertFalse($this->basicTable->isTableNamed('table2'));

        $this->basicTable->setTableName('table2');

        $this->assertTrue($this->basicTable->isTableNamed('table2'));
    }

    /** @test */
    public function can_check_if_table_has_page_name(): void
    {
        $this->assertFalse($this->basicTable->hasPageName());

        $this->basicTable->setPageName('page2');

        $this->assertTrue($this->basicTable->hasPageName());
    }

    /** @test */
    public function can_get_eager_load_relations_status(): void
    {
        $this->assertFalse($this->basicTable->getHideReorderColumnUnlessReorderingStatus());

        $this->assertFalse($this->basicTable->eagerLoadAllRelationsIsEnabled());

        $this->basicTable->setEagerLoadAllRelationsEnabled();

        $this->assertFalse($this->basicTable->eagerLoadAllRelationsIsDisabled());

        $this->assertTrue($this->basicTable->eagerLoadAllRelationsIsEnabled());

        $this->basicTable->setEagerLoadAllRelationsDisabled();

        $this->assertFalse($this->basicTable->eagerLoadAllRelationsIsEnabled());

        $this->assertTrue($this->basicTable->eagerLoadAllRelationsIsDisabled());
    }

    /** @test */
    public function can_get_collapsing_columns_status(): void
    {
        $this->assertTrue($this->basicTable->getCollapsingColumnsStatus());

        $this->assertTrue($this->basicTable->CollapsingColumnsAreEnabled());

        $this->basicTable->setCollapsingColumnsDisabled();

        $this->assertTrue($this->basicTable->CollapsingColumnsAreDisabled());

        $this->assertFalse($this->basicTable->getCollapsingColumnsStatus());
    }

    /** @test */
    public function can_check_for_tr_url(): void
    {
        $this->assertFalse($this->basicTable->hasTableRowUrl());

        $this->basicTable->setTableRowUrl(function ($row) {
            return 'https://example.com';
        });

        $this->assertTrue($this->basicTable->hasTableRowUrl());
    }

    /** @test */
    public function can_get_additional_selects(): void
    {
        $this->assertEquals([], $this->basicTable->getAdditionalSelects());

        $this->basicTable->setAdditionalSelects(['id', 'name']);

        $this->assertEquals(['id', 'name'], $this->basicTable->getAdditionalSelects());
    }

    /** @test */
    public function can_get_configurable_areas(): void
    {
        $this->assertEquals([
            'toolbar-left-start' => null,
            'toolbar-left-end' => null,
            'toolbar-right-start' => null,
            'toolbar-right-end' => null,
            'before-toolbar' => null,
            'after-toolbar' => null,
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

    /** @test */
    public function can_get_configurable_area_parameters(): void
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

    /** @test */
    public function can_get_hide_configurable_areas_when_reordering_status(): void
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

    /** @test */
    public function can_get_dataTable_fingerprint(): void
    {
        $this->assertSame($this->defaultFingerPrintingAlgo($this->basicTable::class), $this->basicTable->getDataTableFingerprint());
    }

    /** @test */
    public function can_get_query_string_alias_and_it_will_be_the_same_as_table_name_by_default(): void
    {
        $this->assertSame($this->basicTable->getTableName(), $this->basicTable->getQueryStringAlias());
    }
}
