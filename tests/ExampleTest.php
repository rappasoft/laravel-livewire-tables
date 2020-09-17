<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Orchestra\Testbench\TestCase;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;

class ExampleTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [LaravelLivewireTablesServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
