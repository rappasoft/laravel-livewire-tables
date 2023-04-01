<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Illuminate\Encryption\Encrypter;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

class TestCase extends Orchestra
{
    public PetsTable $basicTable;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->basicTable = new PetsTable();
        $this->basicTable->boot();
        $this->basicTable->booted();
        $this->basicTable->render();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            LaravelLivewireTablesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => __DIR__.'/../database/sqlite.database',
            'prefix' => '',
        ]);

        config()->set('app.key', Encrypter::generateKey(config('app.cipher')));
    }

    protected function defaultFingerPrintingAlgo($className)
    {
        $className = str_split($className);
        $crc32 = sprintf('%u', crc32(serialize($className)));

        return base_convert($crc32, 10, 36);
    }
}
