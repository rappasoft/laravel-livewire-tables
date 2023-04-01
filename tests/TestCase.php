<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\DB;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\Models\Breed;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\Models\Species;
use Rappasoft\LaravelLivewireTables\Tests\Models\Veterinary;

class TestCase extends Orchestra
{
    public PetsTable $basicTable;
    static bool $initialized = false;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        if (! self::$initialized) {
            parent::setUp();

            // We utilize the filesystem as shared mutable state to coordinate between processes
            touch('/tmp/test-initialization-lock-file');
            $lockFile = fopen('/tmp/test-initialization-lock-file', 'r');
    
            // Attempt to get an exclusive lock - first process wins
            if (flock($lockFile, LOCK_EX | LOCK_NB)) {
                // Since we are the single process that has an exclusive lock, we run the initialization
        
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
                    ['id' => 1, 'name' => 'Cartman', 'age' => 22, 'species_id' => 1, 'breed_id' => 4],
                    ['id' => 2, 'name' => 'Tux', 'age' => 8, 'species_id' => 1, 'breed_id' => 4],
                    ['id' => 3, 'name' => 'May', 'age' => 2, 'species_id' => 2, 'breed_id' => 102],
                    ['id' => 4, 'name' => 'Ben', 'age' => 5, 'species_id' => 3, 'breed_id' => 200],
                    ['id' => 5, 'name' => 'Chico', 'age' => 7, 'species_id' => 3, 'breed_id' => 202],
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
        
            } else {
                // If no exclusive lock is available, block until the first process is done with initialization
                flock($lockFile, LOCK_SH);
            }
            $this->basicTable = new PetsTable();

            self::$initialized = true;
        }
        else
        {
            $this->basicTable->boot();
            $this->basicTable->booted();
            $this->basicTable->render();

        }

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
            'database' => ':memory:',
            'prefix' => '',
        ]);

        include_once __DIR__.'/../database/migrations/create_test_tables.php.stub';
        (new \CreateTestTables())->up();

        config()->set('app.key', Encrypter::generateKey(config('app.cipher')));
    }

    protected function defaultFingerPrintingAlgo($className)
    {
        $className = str_split($className);
        $crc32 = sprintf('%u', crc32(serialize($className)));

        return base_convert($crc32, 10, 36);
    }
}
