<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use RpWebDevelopment\LaravelUgcTranslate\Facades\UgcTranslate;
use RpWebDevelopment\LaravelUgcTranslate\Services\Translate\GoogleTranslate;

class TranslateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $provider = config('ugc-translate.provider', 'google');
        $providerService = config(
            "ugc-translate.providers.{$provider}.service",
            GoogleTranslate::class
        );

        $this->app->bind(UgcTranslate::class, fn () => new $providerService());
    }
}
