<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{PetsTable,PetsTableUnpaginated,SpeciesTable};
use Rappasoft\LaravelLivewireTables\Tests\Http\TestComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\Breed;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\Models\Species;
use Rappasoft\LaravelLivewireTables\Tests\Models\Veterinary;

class TestCase extends Orchestra
{
    public PetsTable $basicTable;

    public SpeciesTable $speciesTable;

    public PetsTableUnpaginated $unpaginatedTable;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        Blade::component('test-component', TestComponent::class);

        if (! Breed::where('id', 1)->get()) {
            include_once __DIR__.'/../database/migrations/create_test_tables.php.stub';
            (new \CreateTestTables())->down();
            (new \CreateTestTables())->up();

            Species::insert([
                ['id' => 1, 'name' => 'Cat'],
                ['id' => 2, 'name' => 'Dog'],
                ['id' => 3, 'name' => 'Horse'],
                ['id' => 4, 'name' => 'Bird'],
            ]);

            Breed::insert([
                ['id' => 1, 'name' => 'American Shorthair', 'species_id' => 1],
                ['id' => 2, 'name' => 'Maine Coon', 'species_id' => 1],
                ['id' => 3, 'name' => 'Persian', 'species_id' => 1],
                ['id' => 4, 'name' => 'Norwegian Forest', 'species_id' => 1],
                ['id' => 100, 'name' => 'Beagle', 'species_id' => 2],
                ['id' => 101, 'name' => 'Corgi', 'species_id' => 2],
                ['id' => 102, 'name' => 'Red Setter', 'species_id' => 2],
                ['id' => 200, 'name' => 'Arabian', 'species_id' => 3],
                ['id' => 201, 'name' => 'Clydesdale', 'species_id' => 3],
                ['id' => 202, 'name' => 'Mustang', 'species_id' => 3],
            ]);

            Pet::insert([
                ['id' => 1, 'name' => 'Cartman', 'age' => 22, 'species_id' => 1, 'breed_id' => 4, 'last_visit' => '2023-01-04', 'favorite_color' => '#000000'],
                ['id' => 2, 'name' => 'Tux', 'age' => 8, 'species_id' => 1, 'breed_id' => 4, 'last_visit' => '2023-02-04', 'favorite_color' => '#FF0000'],
                ['id' => 3, 'name' => 'May', 'age' => 2, 'species_id' => 2, 'breed_id' => 102, 'last_visit' => null, 'favorite_color' => '#00FF00'],
                ['id' => 4, 'name' => 'Ben', 'age' => 5, 'species_id' => 3, 'breed_id' => 200, 'last_visit' => '2023-04-04', 'favorite_color' => '#0000FF'],
                ['id' => 5, 'name' => 'Chico', 'age' => 7, 'species_id' => 3, 'breed_id' => 202, 'last_visit' => '2023-05-04', 'favorite_color' => '#FFFFFF'],
            ]);

            Veterinary::insert([
                ['id' => 1, 'name' => 'Dr John Smith', 'phone' => '123456798'],
                ['id' => 2, 'name' => 'Dr Fabio Ivona', 'phone' => '789456123'],
                ['id' => 3, 'name' => 'Dr Anthony Rappa', 'phone' => '987654321'],
            ]);

            DB::table('pet_veterinary')->insert([
                ['id' => 1, 'pet_id' => 1, 'veterinary_id' => 1],
                ['id' => 2, 'pet_id' => 1, 'veterinary_id' => 2],
                ['id' => 3, 'pet_id' => 2, 'veterinary_id' => 1],
                ['id' => 4, 'pet_id' => 2, 'veterinary_id' => 3],
            ]);
        }
        $this->setupBasicTable();
        $this->setupUnpaginatedTable();
        $this->setupSpeciesTable();
    }

    protected function setupBasicTable()
    {
        $view = view('livewire-tables::datatable');
        $this->basicTable = new PetsTable();
        $this->basicTable->boot();
        $this->basicTable->bootedComponentUtilities();
        $this->basicTable->bootedWithData();
        $this->basicTable->bootedWithColumns();
        $this->basicTable->bootedWithColumnSelect();
        $this->basicTable->bootedWithSecondaryHeader();
        $this->basicTable->booted();
        $this->basicTable->renderingWithData($view, []);
        $this->basicTable->renderingWithPagination($view, []);
        $this->basicTable->render();
    }

    protected function setupSpeciesTable()
    {
        $view = view('livewire-tables::datatable');
        $this->speciesTable = new SpeciesTable();
        $this->speciesTable->boot();
        $this->speciesTable->bootedComponentUtilities();
        $this->speciesTable->bootedWithData();
        $this->speciesTable->bootedWithColumns();
        $this->speciesTable->bootedWithColumnSelect();
        $this->speciesTable->bootedWithSecondaryHeader();
        $this->speciesTable->booted();
        $this->speciesTable->renderingWithData($view, []);
        $this->speciesTable->renderingWithPagination($view, []);
        $this->speciesTable->render();
    }

    protected function setupUnpaginatedTable()
    {

        $view = view('livewire-tables::datatable');
        $this->unpaginatedTable = new PetsTableUnpaginated();
        $this->unpaginatedTable->boot();
        $this->unpaginatedTable->bootedComponentUtilities();
        $this->unpaginatedTable->bootedWithData();
        $this->unpaginatedTable->bootedWithColumns();
        $this->unpaginatedTable->bootedWithColumnSelect();
        $this->unpaginatedTable->bootedWithSecondaryHeader();
        $this->unpaginatedTable->booted();
        $this->unpaginatedTable->renderingWithData($view, []);
        $this->unpaginatedTable->renderingWithPagination($view, []);
        $this->unpaginatedTable->render();

    }

    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            LaravelLivewireTablesServiceProvider::class,
            BladeIconsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('app.key', Encrypter::generateKey(config('app.cipher')));
        config()->set('app.env', 'testing');
        config()->set('cache.default', 'array');
        config()->set('view.cache', false);
        config()->set('view.compiled', realpath(storage_path('framework/views')).'/'.rand(0, 100));

        $app['config']->set('app.env', 'testing');
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('cache.default', 'array');
        $app['config']->set('view.cache', false);
        $app['config']->set('view.compiled', realpath(storage_path('framework/views')).'/'.rand(0, 100));

        if (file_exists(__DIR__.'/../database/sqlite.database')) {
            $app['config']->set('database.connections.sqlite', [
                'driver' => 'sqlite',
                'database' => __DIR__.'/../database/sqlite.database',
                'prefix' => '',
            ]);
        } else {
            $app['config']->set('database.connections.sqlite', [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]);
        }
    }

    protected function defaultFingerPrintingAlgo($className)
    {
        $className = str_split($className);
        $crc32 = sprintf('%u', crc32(serialize($className)));

        return base_convert($crc32, 10, 36);
    }
}
