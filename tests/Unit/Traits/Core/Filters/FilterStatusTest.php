<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Core\Filters;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Filters')]
final class FilterStatusTest extends TestCase
{
    public function test_can_check_if_filters_are_enabled(): void
    {
        $this->assertTrue($this->basicTable->filtersAreEnabled());
    }

    public function test_can_check_if_filters_can_be_disabled_when_enbled(): void
    {

        $mock = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->setFiltersEnabled();
            }

            public function setFiltersToEnabled()
            {
                $this->setFiltersEnabled();
            }

            public function setFiltersToDisabled()
            {
                $this->setFiltersDisabled();
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertTrue($mock->filtersAreEnabled());
        $this->assertFalse($mock->filtersAreDisabled());

        $mock->setFiltersToDisabled();

        $this->assertFalse($mock->filtersAreEnabled());
        $this->assertTrue($mock->filtersAreDisabled());

    }

    public function test_can_check_if_filters_can_be_enabled_when_disabled(): void
    {

        $mock = new class extends PetsTable
        {
            public function configure(): void
            {
                parent::configure();
                $this->setFiltersDisabled();
            }

            public function setFiltersToEnabled()
            {
                $this->setFiltersEnabled();
            }

            public function setFiltersToDisabled()
            {
                $this->setFiltersDisabled();
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertTrue($mock->filtersAreDisabled());
        $this->assertFalse($mock->filtersAreEnabled());

        $mock->setFiltersToEnabled();
        $this->assertTrue($mock->filtersAreEnabled());
        $this->assertFalse($mock->filtersAreDisabled());

    }
}
