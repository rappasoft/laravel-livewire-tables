<?php

namespace Rappasoft\LivewireTables\Tests;

use Rappasoft\LivewireTables\LivewireTablesServiceProvider;

/**
 * Class TestCase.
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [LivewireTablesServiceProvider::class];
    }
}
