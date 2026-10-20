<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Commands;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;

class MakeCommandTest extends TestCase
{
    protected string $temporaryPath;

    protected string $originalAppPath;

    protected function getPackageProviders($app): array
    {
        return [LivewireServiceProvider::class, LaravelLivewireTablesServiceProvider::class];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->getNamespace();
        $this->originalAppPath = app_path();
        $this->temporaryPath = sys_get_temp_dir().'/livewire-tables-generator-'.Str::random(12);
        File::makeDirectory($this->temporaryPath.'/Models', 0755, true);
        File::copy(__DIR__.'/Fixtures/GeneratorPet.php', $this->temporaryPath.'/Models/GeneratorPet.php');
        require_once __DIR__.'/Fixtures/GeneratorPet.php';
        $this->app->useAppPath($this->temporaryPath);
        config(['livewire.class_namespace' => 'App\\Livewire', 'livewire.class_path' => null]);
    }

    protected function tearDown(): void
    {
        $this->app->useAppPath($this->originalAppPath);
        File::deleteDirectory($this->temporaryPath);

        parent::tearDown();
    }

    public function test_generates_simple_and_nested_component_names(): void
    {
        foreach ([
            'UsersTable' => 'UsersTable',
            'admin.user-table' => 'Admin/UserTable',
            'reports/users_table' => 'Reports/UsersTable',
            'staff\\active-users' => 'Staff/ActiveUsers',
        ] as $name => $relativePath) {
            $this->assertSame(0, Artisan::call('make:datatable', ['name' => $name, 'model' => 'generator-pet', '--no-interaction' => true]));
            $contents = File::get(app_path('Livewire/'.$relativePath.'.php'));
            $namespace = str_contains($relativePath, '/') ? '\\'.str_replace('/', '\\', dirname($relativePath)) : '';

            $this->assertStringContainsString('namespace App\\Livewire'.$namespace.';', $contents);
            $this->assertStringContainsString('class '.basename($relativePath).' extends DataTableComponent', $contents);
            $this->assertStringContainsString('use App\\Models\\GeneratorPet;', $contents);
            $this->assertStringContainsString('protected $model = GeneratorPet::class;', $contents);
            $this->assertStringContainsString('Column::make("Name", "name")', $contents);
            $this->assertStringNotContainsString('Column::make("Secret", "secret")', $contents);
            $this->assertStringNotContainsString('[columns]', $contents);
        }
    }

    public function test_uses_custom_livewire_namespace_for_the_class_path(): void
    {
        config(['livewire.class_namespace' => 'App\\Http\\Livewire']);
        Artisan::call('make:datatable', ['name' => 'admin.users-table', 'model' => 'GeneratorPet', '--no-interaction' => true]);

        $this->assertStringContainsString('namespace App\\Http\\Livewire\\Admin;', File::get(app_path('Http/Livewire/Admin/UsersTable.php')));
    }

    public function test_honors_an_explicit_livewire_class_path(): void
    {
        config([
            'livewire.class_namespace' => 'Domain\\Tables',
            'livewire.class_path' => $this->temporaryPath.'/components',
        ]);
        Artisan::call('make:datatable', ['name' => 'admin.users-table', 'model' => 'GeneratorPet', '--no-interaction' => true]);

        $this->assertStringContainsString('namespace Domain\\Tables\\Admin;', File::get($this->temporaryPath.'/components/Admin/UsersTable.php'));
        $this->assertFileDoesNotExist(app_path('Domain/Tables/Admin/UsersTable.php'));
    }

    public function test_rejects_reserved_class_names_without_writing_a_file(): void
    {
        foreach (['class', 'admin.match', 'Component', 'SELF', 'admin/readonly'] as $name) {
            Artisan::call('make:datatable', ['name' => $name, 'model' => 'GeneratorPet', '--no-interaction' => true]);

            $this->assertStringContainsString('Class is reserved:', Artisan::output());
            $this->assertDirectoryDoesNotExist(app_path('Livewire'));
        }
    }

    public function test_refuses_to_overwrite_a_component_unless_forced(): void
    {
        File::makeDirectory(app_path('Livewire'));
        $path = app_path('Livewire/UsersTable.php');
        File::put($path, 'existing user code');
        $arguments = ['name' => 'UsersTable', 'model' => 'GeneratorPet', '--no-interaction' => true];
        Artisan::call('make:datatable', $arguments);

        $this->assertStringContainsString('already exists', Artisan::output());
        $this->assertStringNotContainsString('created successfully', Artisan::output());
        $this->assertSame('existing user code', File::get($path));

        $this->assertSame(0, Artisan::call('make:datatable', [...$arguments, '--force' => true]));
        $this->assertStringContainsString('class UsersTable extends DataTableComponent', File::get($path));
    }

    public function test_imports_a_model_from_the_application_root(): void
    {
        File::copy(__DIR__.'/Fixtures/LegacyGeneratorPet.php', app_path('LegacyGeneratorPet.php'));
        require_once __DIR__.'/Fixtures/LegacyGeneratorPet.php';
        Artisan::call('make:datatable', ['name' => 'LegacyTable', 'model' => 'LegacyGeneratorPet', '--no-interaction' => true]);

        $this->assertStringContainsString('use App\\LegacyGeneratorPet;', File::get(app_path('Livewire/LegacyTable.php')));
    }

    public function test_imports_a_model_from_a_custom_model_path(): void
    {
        require_once __DIR__.'/Fixtures/GeneratorWidget.php';
        Artisan::call('make:datatable', [
            'name' => 'WidgetTable',
            'model' => 'GeneratorWidget',
            'modelpath' => __DIR__.'/Fixtures',
            '--no-interaction' => true,
        ]);

        $this->assertStringContainsString('use Domain\\Models\\GeneratorWidget;', File::get(app_path('Livewire/WidgetTable.php')));
    }
}
