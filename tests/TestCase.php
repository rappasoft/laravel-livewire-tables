<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\DB;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{BreedsTable,PetsTable,PetsTableEvents,PetsTableUnpaginated,PetsTableWithOwner,SpeciesTable};
use Rappasoft\LaravelLivewireTables\Tests\Http\TestComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\Breed;
use Rappasoft\LaravelLivewireTables\Tests\Models\Owner;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\Models\Species;
use Rappasoft\LaravelLivewireTables\Tests\Models\Veterinary;

class TestCase extends Orchestra
{
    public PetsTable $basicTable;

    public SpeciesTable $speciesTable;

    public PetsTableUnpaginated $unpaginatedTable;

    public BreedsTable $breedsTable;

    public PetsTableWithOwner $petOwnerTable;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        if (! Breed::where('id', 1)->get()) {
            include_once __DIR__.'/../database/migrations/create_test_tables.php.stub';
            (new \CreateTestTables)->down();
            (new \CreateTestTables)->up();

            Owner::insert([
                ['id' => 1, 'name' => 'Ben', 'date_of_birth' => '1982-04-07'],
                ['id' => 2, 'name' => 'Tom', 'date_of_birth' => '1985-08-22'],
                ['id' => 3, 'name' => 'Mark', 'date_of_birth' => '1991-03-26'],
                ['id' => 4, 'name' => 'Jake', 'date_of_birth' => '1985-11-12'],
            ]);

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
                ['id' => 1, 'name' => 'Cartman', 'age' => 22, 'species_id' => 1, 'breed_id' => 4, 'last_visit' => '2023-01-04', 'favorite_color' => '#000000', 'owner_id' => 1],
                ['id' => 2, 'name' => 'Tux', 'age' => 8, 'species_id' => 1, 'breed_id' => 4, 'last_visit' => '2023-02-04', 'favorite_color' => '#FF0000', 'owner_id' => 3],
                ['id' => 3, 'name' => 'May', 'age' => 2, 'species_id' => 2, 'breed_id' => 102, 'last_visit' => null, 'favorite_color' => '#00FF00', 'owner_id' => 4],
                ['id' => 4, 'name' => 'Ben', 'age' => 5, 'species_id' => 3, 'breed_id' => 200, 'last_visit' => '2023-04-04', 'favorite_color' => '#0000FF', 'owner_id' => 1],
                ['id' => 5, 'name' => 'Chico', 'age' => 7, 'species_id' => 3, 'breed_id' => 202, 'last_visit' => '2023-05-04', 'favorite_color' => '#FFFFFF', 'owner_id' => 2],
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
    }

    protected function setupBasicTable()
    {
        $view = view('livewire-tables::datatable');
        $this->basicTable = new PetsTable;
        $this->basicTable->mountManagesFilters();
        $this->basicTable->boot();
        $this->basicTable->bootedManagesFilters();
        $this->basicTable->bootedComponentUtilities();
        $this->basicTable->bootedWithColumns();
        $this->basicTable->bootedWithColumnSelect();
        $this->basicTable->bootedWithSecondaryHeader();
        $this->basicTable->booted();
        $this->basicTable->renderingWithColumns($view, $view->getData());
        $this->basicTable->renderingWithColumnSelect($view, $view->getData());
        $this->basicTable->renderingWithCustomisations($view, $view->getData());
        $this->basicTable->renderingWithData($view, $view->getData());
        $this->basicTable->renderingWithFooter($view, $view->getData());
        $this->basicTable->renderingWithReordering($view, $view->getData());
        $this->basicTable->renderingWithPagination($view, $view->getData());
        $this->basicTable->render();
    }

    protected function setupEventsTable()
    {
        $view = view('livewire-tables::datatable');
        $this->eventsTable = new PetsTableEvents;
        $this->eventsTable->mountManagesFilters();
        $this->eventsTable->boot();
        $this->eventsTable->bootedComponentUtilities();
        $this->eventsTable->bootedManagesFilters();
        $this->eventsTable->bootedWithColumns();
        $this->eventsTable->bootedWithColumnSelect();
        $this->eventsTable->bootedWithSecondaryHeader();
        $this->eventsTable->booted();
        $this->eventsTable->renderingWithColumns($view, $view->getData());
        $this->eventsTable->renderingWithColumnSelect($view, $view->getData());
        $this->eventsTable->renderingWithCustomisations($view, $view->getData());
        $this->eventsTable->renderingWithData($view, $view->getData());
        $this->eventsTable->renderingWithFooter($view, $view->getData());
        $this->eventsTable->renderingWithReordering($view, $view->getData());
        $this->eventsTable->renderingWithPagination($view, $view->getData());

        $this->eventsTable->render();
    }

    protected function setupBreedsTable()
    {
        $view = view('livewire-tables::datatable');
        $this->breedsTable = new BreedsTable;
        $this->breedsTable->mountManagesFilters();
        $this->breedsTable->boot();
        $this->breedsTable->bootedComponentUtilities();
        $this->breedsTable->bootedManagesFilters();
        $this->breedsTable->bootedWithColumns();
        $this->breedsTable->bootedWithColumnSelect();
        $this->breedsTable->bootedWithSecondaryHeader();
        $this->breedsTable->booted();
        $this->breedsTable->renderingWithColumns($view, $view->getData());
        $this->breedsTable->renderingWithColumnSelect($view, $view->getData());
        $this->breedsTable->renderingWithCustomisations($view, $view->getData());
        $this->breedsTable->renderingWithData($view, $view->getData());
        $this->breedsTable->renderingWithFooter($view, $view->getData());
        $this->breedsTable->renderingWithReordering($view, $view->getData());
        $this->breedsTable->renderingWithPagination($view, $view->getData());
        $this->breedsTable->render();
    }

    protected function setupPetOwnerTable()
    {
        $view = view('livewire-tables::datatable');
        $this->petOwnerTable = new PetsTableWithOwner;
        $this->petOwnerTable->mountManagesFilters();
        $this->petOwnerTable->boot();
        $this->petOwnerTable->bootedComponentUtilities();
        $this->petOwnerTable->bootedManagesFilters();
        $this->petOwnerTable->bootedWithColumns();
        $this->petOwnerTable->bootedWithColumnSelect();
        $this->petOwnerTable->bootedWithSecondaryHeader();
        $this->petOwnerTable->booted();
        $this->petOwnerTable->renderingWithColumns($view, $view->getData());
        $this->petOwnerTable->renderingWithColumnSelect($view, $view->getData());
        $this->petOwnerTable->renderingWithCustomisations($view, $view->getData());
        $this->petOwnerTable->renderingWithData($view, $view->getData());
        $this->petOwnerTable->renderingWithFooter($view, $view->getData());
        $this->petOwnerTable->renderingWithReordering($view, $view->getData());
        $this->petOwnerTable->renderingWithPagination($view, $view->getData());
        $this->petOwnerTable->render();
    }

    protected function setupSpeciesTable()
    {
        $view = view('livewire-tables::datatable');
        $this->speciesTable = new SpeciesTable;
        $this->speciesTable->mountManagesFilters();
        $this->speciesTable->boot();
        $this->speciesTable->bootedComponentUtilities();
        $this->speciesTable->bootedManagesFilters();
        $this->speciesTable->bootedWithColumns();
        $this->speciesTable->bootedWithColumnSelect();
        $this->speciesTable->bootedWithSecondaryHeader();
        $this->speciesTable->booted();
        $this->speciesTable->renderingWithColumns($view, $view->getData());
        $this->speciesTable->renderingWithColumnSelect($view, $view->getData());
        $this->speciesTable->renderingWithCustomisations($view, $view->getData());
        $this->speciesTable->renderingWithData($view, $view->getData());
        $this->speciesTable->renderingWithFooter($view, $view->getData());
        $this->speciesTable->renderingWithReordering($view, $view->getData());
        $this->speciesTable->renderingWithPagination($view, $view->getData());
        $this->speciesTable->render();
    }

    protected function setupUnpaginatedTable()
    {

        $view = view('livewire-tables::datatable');
        $this->unpaginatedTable = new PetsTableUnpaginated;
        $this->unpaginatedTable->mountManagesFilters();
        $this->unpaginatedTable->boot();
        $this->unpaginatedTable->bootedComponentUtilities();
        $this->unpaginatedTable->bootedManagesFilters();
        $this->unpaginatedTable->bootedWithColumns();
        $this->unpaginatedTable->bootedWithColumnSelect();
        $this->unpaginatedTable->bootedWithSecondaryHeader();
        $this->unpaginatedTable->booted();
        $this->unpaginatedTable->renderingWithColumns($view, $view->getData());
        $this->unpaginatedTable->renderingWithColumnSelect($view, $view->getData());
        $this->unpaginatedTable->renderingWithCustomisations($view, $view->getData());
        $this->unpaginatedTable->renderingWithData($view, $view->getData());
        $this->unpaginatedTable->renderingWithFooter($view, $view->getData());
        $this->unpaginatedTable->renderingWithReordering($view, $view->getData());
        $this->unpaginatedTable->renderingWithPagination($view, $view->getData());
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
        //      config()->set('livewire-tables.use_json_translations', true);
        $app['config']->set('view.paths', [
            __DIR__.'/views',
            resource_path('views'),
        ]);

        $app['config']->set('app.env', 'testing');
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('cache.default', 'array');
        $app['config']->set('view.cache', false);
        $app['config']->set('view.compiled', realpath(storage_path('framework/views')).'/'.rand(0, 100));
        //        $app['config']->set('livewire-tables.use_json_translations', true);

        if (file_exists(__DIR__.'/../database/database.sqlite')) {
            $app['config']->set('database.connections.sqlite', [
                'driver' => 'sqlite',
                'database' => __DIR__.'/../database/database.sqlite',
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
