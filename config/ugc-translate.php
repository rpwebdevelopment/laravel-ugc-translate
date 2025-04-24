<?php

use RpWebDevelopment\LaravelUgcTranslate\Services\Translate\AwsTranslate;
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
    | Supported: "google", "deepl", "aws"
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
            'settings' => [
                /*
                |--------------------------------------------------------------------------
                | DeepL Model Type
                |--------------------------------------------------------------------------
                |
                | @see https://developers.deepl.com/docs/api-reference/translate
                |
                | Supported: "quality_optimized", "prefer_quality_optimized",
                | "latency_optimized"
                */
                'model_type' => 'prefer_quality_optimized',

                /*
                |--------------------------------------------------------------------------
                | DeepL Formality
                |--------------------------------------------------------------------------
                |
                | @see https://developers.deepl.com/docs/api-reference/translate
                |
                | Supported: "less", "more", "default", "prefer_less", "prefer_more"
                */
                'formality' => 'default',
            ]
        ],
        'aws' => [
            'service' => AwsTranslate::class,
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
            'settings' => [
                /*
                |--------------------------------------------------------------------------
                | AWS Formality
                |--------------------------------------------------------------------------
                |
                | @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-translate-2017-07-01.html#shape-translationsettings
                |
                | Supported: "FORMAL", "INFORMAL"
                */
                "Formality" => "FORMAL"
            ],
            "region" => env('AWS_DEFAULT_REGION', "us-east-1"),
            "version" => "latest",
        ],
    ],
];
