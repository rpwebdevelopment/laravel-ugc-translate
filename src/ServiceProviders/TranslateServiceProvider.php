<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use RpWebDevelopment\LaravelUgcTranslate\Services\Translate;

class TranslateServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            Translate::class,
            static function (): Translate {
                return new Translate(
                    config('ugc-translate.auth-token')
                );
            }
        );
    }
}
