<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class FilterConfigurationTest extends TestCase
{
    /** @test */
    public function filter_config_can_be_set(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertEquals([], $filter->getConfigs());

        $filter->config([
            'key' => 'value',
        ]);

        $this->assertCount(1, $filter->getConfigs());

        $this->assertEquals('value', $filter->getConfig('key'));
    }

    /** @test */
    public function filter_pill_title_can_be_set(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertEquals('Active', $filter->getFilterPillTitle());

        $filter->setFilterPillTitle('User Status');

        $this->assertEquals('User Status', $filter->getFilterPillTitle());
    }

    /** @test */
    public function filter_pill_values_can_be_set_for_select(): void
    {
        $filter = SelectFilter::make('Active')
            ->options([
                '' => 'All',
                '1' => 'Yes',
                '0' => 'No',
            ]);

        $this->assertEquals('Yes', $filter->getFilterPillValue('1'));
        $this->assertEquals('No', $filter->getFilterPillValue('0'));

        $filter->setFilterPillValues([
            '1' => 'Active',
            '0' => 'Inactive',
        ]);

        $this->assertEquals('Active', $filter->getFilterPillValue('1'));
        $this->assertEquals('Inactive', $filter->getFilterPillValue('0'));

        $filter->setFilterPillValues([
            '0' => 'Inactive',
        ]);

        $this->assertEquals('Yes', $filter->getFilterPillValue('1'));
        $this->assertEquals('Inactive', $filter->getFilterPillValue('0'));
    }

    /** @test */
    public function can_hide_filter_from_menus(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromMenus());

        $filter->hiddenFromMenus();

        $this->assertTrue($filter->isHiddenFromMenus());
    }

    /** @test */
    public function can_hide_filter_from_pills(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromPills());

        $filter->hiddenFromPills();

        $this->assertTrue($filter->isHiddenFromPills());
    }

    /** @test */
    public function can_hide_filter_from_filter_count(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromFilterCount());

        $filter->hiddenFromFilterCount();

        $this->assertTrue($filter->isHiddenFromFilterCount());
    }

    /** @test */
    public function filter_is_not_reset_by_clear_button(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertTrue($filter->isResetByClearButton());

        $filter->notResetByClearButton();

        $this->assertFalse($filter->isResetByClearButton());
    }

    /** @test */
    public function can_be_hidden_from_all(): void
    {
        $filter = SelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromMenus());
        $this->assertFalse($filter->isHiddenFromPills());
        $this->assertFalse($filter->isHiddenFromFilterCount());
        $this->assertTrue($filter->isResetByClearButton());

        $filter->hiddenFromAll();

        $this->assertTrue($filter->isHiddenFromMenus());
        $this->assertTrue($filter->isHiddenFromPills());
        $this->assertTrue($filter->isHiddenFromFilterCount());
        $this->assertTrue($filter->isResetByClearButton());
    }
}
