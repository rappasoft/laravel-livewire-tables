<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

final class DataTableComponentGlobalSettingsTest extends TestCase
{
    protected function tearDown(): void
    {
        // Reset global configuration after each test
        $reflection = new \ReflectionClass(DataTableComponent::class);
        $property = $reflection->getProperty('globalConfigurationCallback');
        $property->setAccessible(true);
        $property->setValue(null, null);

        parent::tearDown();
    }

    public function test_global_configuration_can_be_set(): void
    {
        $called = false;

        DataTableComponent::configureUsing(function ($table) use (&$called) {
            $called = true;
            $this->assertInstanceOf(DataTableComponent::class, $table);
        });

        $table = new PetsTable();
        $table->boot();
        $table->bootedComponentUtilities();

        $this->assertTrue($called);
    }

    public function test_global_configuration_applies_to_all_tables(): void
    {
        DataTableComponent::configureUsing(function ($table) {
            $table->poll('30s');
        });

        $table1 = new PetsTable();
        $table1->boot();
        $table1->bootedComponentUtilities();

        $table2 = new PetsTable();
        $table2->boot();
        $table2->bootedComponentUtilities();

        // Both tables should have the poll interval set
        $this->assertSame('30000', $table1->getRefreshStatus());
        $this->assertSame('30000', $table2->getRefreshStatus());
    }

    public function test_global_configuration_can_be_overridden(): void
    {
        DataTableComponent::configureUsing(function ($table) {
            $table->poll('30s');
        });

        $table = new PetsTable();
        $table->boot();
        $table->bootedComponentUtilities();

        // Global config sets 30s
        $this->assertSame('30000', $table->getRefreshStatus());

        // Can override in configure method
        $table->poll('10s');
        $this->assertSame('10000', $table->getRefreshStatus());
    }

    public function test_global_configuration_applies_before_configure_method(): void
    {
        $order = [];

        DataTableComponent::configureUsing(function ($table) use (&$order) {
            $order[] = 'global';
            $table->poll('30s');
        });

        // Create a table that sets poll in configure
        $table = new class extends PetsTable {
            public function configure(): void
            {
                parent::configure();
                $this->poll('10s');
            }
        };

        $table->boot();
        $table->bootedComponentUtilities();

        // Global config is applied first, then configure() overrides it
        $this->assertSame('10000', $table->getRefreshStatus());
    }
}


