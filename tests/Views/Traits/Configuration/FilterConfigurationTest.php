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
}
