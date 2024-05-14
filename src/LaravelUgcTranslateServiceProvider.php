<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate;

use RpWebDevelopment\LaravelUgcTranslate\Components\Modal;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RpWebDevelopment\LaravelUgcTranslate\Commands\LaravelUgcTranslateCommand;

class LaravelUgcTranslateServiceProvider extends PackageServiceProvider
{
    public function boot(): self
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/ugc'),
            __DIR__ . '/Components' => app_path('Http/Livewire/Ugc'),
        ], 'ugc-translate-livewire');

        return parent::boot();
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('ugc-translate')
            ->hasConfigFile()
            ->hasMigration('create_ugc_translate_table')
            ->hasCommand(LaravelUgcTranslateCommand::class);
    }
}
