<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RpWebDevelopment\LaravelUgcTranslate\Commands\LaravelUgcTranslateCommand;

class LaravelUgcTranslateServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('ugc-translate')
            ->hasConfigFile()
            ->hasMigration('create_ugc_translate_table')
            ->hasCommand(LaravelUgcTranslateCommand::class);
    }
}
