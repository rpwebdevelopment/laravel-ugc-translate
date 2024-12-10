<?php

use RpWebDevelopment\LaravelUgcTranslate\Services\Translate\DeepLTranslate;
use RpWebDevelopment\LaravelUgcTranslate\Services\Translate\GoogleTranslate;

return [
    /*
    |--------------------------------------------------------------------------
    | UGC Auto Translate Disabled
    |--------------------------------------------------------------------------
    |
    | Boolean flag to optionally disable auto translations on translatable models.
    |
    */
    'auto-translate-disabled' => env('UGC_AUTO_TRANSLATE_DISABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Default Language Source
    |--------------------------------------------------------------------------
    |
    | This option indicates the source directory/file translations will
    | be derived from, this can be overridden with the --source option of
    | the translation command.
    |
    */
    'default-lang' => 'en_GB',

    /*
    |--------------------------------------------------------------------------
    | Language Targets
    |--------------------------------------------------------------------------
    |
    | This option sets an array of target locales for bulk updating into
    | multiple languages through a single request.
    |
    | Example: ['de-DE', 'fr']
    |
    */
    'translation-languages' => [],

    /*
    |--------------------------------------------------------------------------
    | Translation Provider
    |--------------------------------------------------------------------------
    |
    | This option indicates Translation service to be used for generating
    | translated strings.
    |
    | Supported: "google", "deepl"
    |
    */
    'provider' => 'google',

    /*
    |--------------------------------------------------------------------------
    | Translation Providers
    |--------------------------------------------------------------------------
    |
    | Definitions and required configurations for available translation
    | providers.
    |
    */
    'providers' => [
        'google' => [
            'service' => GoogleTranslate::class
        ],
        'deepl' => [
            'service' => DeepLTranslate::class,
            'auth-token' => env('DEEPL_AUTH_TOKEN', ''),
        ]
    ],
];
