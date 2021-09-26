<?php

namespace Rappasoft\LaravelLivewireTables;

use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\Commands\MakeCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * Class LaravelLivewireTablesServiceProvider.
 */
class LaravelLivewireTablesServiceProvider extends PackageServiceProvider
{
    public function bootingPackage(): void
    {
        Blade::component('livewire-tables::tailwind.components.table.table', 'livewire-tables::table');
        Blade::component('livewire-tables::tailwind.components.table.heading', 'livewire-tables::table.heading');
        Blade::component('livewire-tables::tailwind.components.table.footer', 'livewire-tables::table.footer');
        Blade::component('livewire-tables::tailwind.components.table.row', 'livewire-tables::table.row');
        Blade::component('livewire-tables::tailwind.components.table.cell', 'livewire-tables::table.cell');

        Blade::component('livewire-tables::tailwind.components.table.table', 'livewire-tables::tw.table');
        Blade::component('livewire-tables::tailwind.components.table.heading', 'livewire-tables::tw.table.heading');
        Blade::component('livewire-tables::tailwind.components.table.footer', 'livewire-tables::tw.table.footer');
        Blade::component('livewire-tables::tailwind.components.table.row', 'livewire-tables::tw.table.row');
        Blade::component('livewire-tables::tailwind.components.table.cell', 'livewire-tables::tw.table.cell');

        Blade::component('livewire-tables::bootstrap-4.components.table.table', 'livewire-tables::bs4.table');
        Blade::component('livewire-tables::bootstrap-4.components.table.heading', 'livewire-tables::bs4.table.heading');
        Blade::component('livewire-tables::bootstrap-4.components.table.footer', 'livewire-tables::bs4.table.footer');
        Blade::component('livewire-tables::bootstrap-4.components.table.row', 'livewire-tables::bs4.table.row');
        Blade::component('livewire-tables::bootstrap-4.components.table.cell', 'livewire-tables::bs4.table.cell');

        Blade::component('livewire-tables::bootstrap-5.components.table.table', 'livewire-tables::bs5.table');
        Blade::component('livewire-tables::bootstrap-5.components.table.heading', 'livewire-tables::bs5.table.heading');
        Blade::component('livewire-tables::bootstrap-5.components.table.footer', 'livewire-tables::bs5.table.footer');
        Blade::component('livewire-tables::bootstrap-5.components.table.row', 'livewire-tables::bs5.table.row');
        Blade::component('livewire-tables::bootstrap-5.components.table.cell', 'livewire-tables::bs5.table.cell');
    }

    /**
     * @param Package $package
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-livewire-tables')
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations()
            ->hasCommand(MakeCommand::class);
    }
}
