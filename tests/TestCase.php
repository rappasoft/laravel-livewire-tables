<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;
use Rappasoft\LaravelLivewireTables\Tests\Database\Migrations\CreateTestTables;
use Rappasoft\LaravelLivewireTables\Tests\Models\Breed;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\Models\Species;

class TestCase extends Orchestra
{

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        Species::insert([
            [ 'id' => 1, 'name' => 'Cat', ],
            [ 'id' => 2, 'name' => 'Dog', ],
            [ 'id' => 3, 'name' => 'Horse', ],
            [ 'id' => 4, 'name' => 'Bird', ],
        ]);

        Breed::insert([
            [ 'id' => 1, 'name' => 'American Shorthair', 'species_id' => 1, ],
            [ 'id' => 2, 'name' => 'Maine Coon', 'species_id' => 1, ],
            [ 'id' => 3, 'name' => 'Persian', 'species_id' => 1, ],
            [ 'id' => 4, 'name' => 'Norwegian Forest', 'species_id' => 1, ],
            [ 'id' => 100, 'name' => 'Beagle', 'species_id' => 2, ],
            [ 'id' => 101, 'name' => 'Corgi', 'species_id' => 2, ],
            [ 'id' => 102, 'name' => 'Red Setter', 'species_id' => 2, ],
            [ 'id' => 200, 'name' => 'Arabian', 'species_id' => 3, ],
            [ 'id' => 201, 'name' => 'Clydesdale', 'species_id' => 3, ],
            [ 'id' => 202, 'name' => 'Mustang', 'species_id' => 3, ],
        ]);

        Pet::insert([
            [ 'id' => 1, 'name' => 'Cartman', 'age' => 22, 'species_id' => 1, 'breed_id' => 4 ],
            [ 'id' => 2, 'name' => 'Tux', 'age' => 8, 'species_id' => 1, 'breed_id' => 4 ],
            [ 'id' => 3, 'name' => 'May', 'age' => 3, 'species_id' => 2, 'breed_id' => 102 ],
            [ 'id' => 4, 'name' => 'Ben', 'age' => 5, 'species_id' => 3, 'breed_id' => 200 ],
            [ 'id' => 5, 'name' => 'Chico', 'age' => 7, 'species_id' => 3, 'breed_id' => 202 ],
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelLivewireTablesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        include_once __DIR__.'/../database/migrations/create_test_tables.php.stub';
        (new \CreateTestTables())->up();
    }
}
