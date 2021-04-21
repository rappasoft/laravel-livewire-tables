<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Schema\Blueprint;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;
use Rappasoft\LaravelLivewireTables\Tests\Models\Breed;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\Models\Species;

class TestCase extends Orchestra
{
    protected $db;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->db = $db = new DB;

        // grab database
        $database = $this->app['config']['database']['connections']['sqlite']['database'];

        // setup connection
        $db->addConnection([
            'driver' => 'sqlite',
            'database' => $database,
        ]);

        $db->setAsGlobal();

        // setup species table
        $this->db->connection()->getSchemaBuilder()->create('species', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Species::insert([
            [ 'id' => 1, 'name' => 'Cat', ],
            [ 'id' => 2, 'name' => 'Dog', ],
            [ 'id' => 3, 'name' => 'Horse', ],
            [ 'id' => 4, 'name' => 'Bird', ],
        ]);

        // setup breeds table
        $this->db->connection()->getSchemaBuilder()->create('breeds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('species_id')->unsigned();
            $table->foreign('species_id')->references('id')->on('species');
        });

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

        // setup user table
        $this->db->connection()->getSchemaBuilder()->create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('age')->nullable();
            $table->date('last_visit')->nullable();
            $table->integer('species_id')->unsigned()->nullable();
            $table->integer('breed_id')->unsigned()->nullable();
            $table->foreign('species_id')->references('id')->on('species');
            $table->foreign('breed_id')->references('id')->on('breeds');
        });

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
            //LivewireServiceProvider::class,
            LaravelLivewireTablesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.debug', true);
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            //'database' => 'tests/tests.sqlite',
            'database' => tempnam(sys_get_temp_dir(), 'LaravelLivewireTables'),
            'prefix' => '',
        ]);
    }
}
