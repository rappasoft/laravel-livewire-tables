<?php

namespace Rappasoft\LaravelLivewireTables;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;
use Livewire\ComponentHookRegistry;
use Rappasoft\LaravelLivewireTables\Commands\MakeCommand;
use Rappasoft\LaravelLivewireTables\Features\AutoInjectRappasoftAssets;
use Rappasoft\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets;

class LaravelLivewireTablesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        AboutCommand::add('Rappasoft Laravel Livewire Tables', fn () => ['Version' => '3.2.5']);

        $this->mergeConfigFrom(
            __DIR__.'/../config/livewire-tables.php', 'livewire-tables'
        );

        // Load Default Translations
        $this->loadJsonTranslationsFrom(
            __DIR__.'/../resources/lang'
        );

        // Override if Published
        $this->loadJsonTranslationsFrom(
            $this->app->langPath('vendor/livewire-tables')
        );

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-tables');

        $this->consoleCommands();

        if (config('livewire-tables.inject_core_assets_enabled') || config('livewire-tables.inject_third_party_assets_enabled') || config('livewire-tables.enable_blade_directives')) {
            (new RappasoftFrontendAssets)->boot();
        }

    }

    public function consoleCommands()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../resources/lang' => $this->app->langPath('vendor/livewire-tables'),
            ], 'livewire-tables-translations');

            $this->publishes([
                __DIR__.'/../config/livewire-tables.php' => config_path('livewire-tables.php'),
            ], 'livewire-tables-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-tables'),
            ], 'livewire-tables-views');

            $this->publishes([
                __DIR__.'/../resources/js' => public_path('vendor/rappasoft/livewire-tables/js'),
                __DIR__.'/../resources/css' => public_path('vendor/rappasoft/livewire-tables/css'),
            ], 'livewire-tables-public');

            $this->commands([
                MakeCommand::class,
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/livewire-tables.php', 'livewire-tables'
        );
        if (config('livewire-tables.inject_core_assets_enabled') || config('livewire-tables.inject_third_party_assets_enabled') || config('livewire-tables.enable_blade_directives')) {
            (new RappasoftFrontendAssets)->register();
            ComponentHookRegistry::register(AutoInjectRappasoftAssets::class);
        }
    }
}
