<?php

namespace RpWebDevelopment\LaravelUgcTranslate;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RpWebDevelopment\LaravelUgcTranslate\Commands\LaravelUgcTranslateCommand;

class LaravelUgcTranslateServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-ugc-translate')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-ugc-translate_table')
            ->hasCommand(LaravelUgcTranslateCommand::class);
    }
}
