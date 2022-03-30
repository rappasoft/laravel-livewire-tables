<?php

namespace Rappasoft\LaravelLivewireTables;

use Rappasoft\LaravelLivewireTables\Commands\MakeCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelLivewireTablesServiceProvider extends PackageServiceProvider
{
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
