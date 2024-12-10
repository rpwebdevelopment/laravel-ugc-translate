<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string translateText(string $texts, ?string $sourceLang, string $targetLang)
 */
class UgcTranslate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ugc-translate';
    }
}
