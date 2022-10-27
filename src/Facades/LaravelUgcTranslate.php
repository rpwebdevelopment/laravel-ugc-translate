<?php

namespace RpWebDevelopment\LaravelUgcTranslate\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RpWebDevelopment\LaravelUgcTranslate\LaravelUgcTranslate
 */
class LaravelUgcTranslate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RpWebDevelopment\LaravelUgcTranslate\LaravelUgcTranslate::class;
    }
}
