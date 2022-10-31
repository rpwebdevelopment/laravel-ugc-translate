<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Services;

use DeepL\Translator;

class Translate
{
    protected Translator $translator;

    public function __construct(string $authToken)
    {
         $this->translator = new Translator($authToken);
    }

    public static function api(): Translator
    {
        $api = app()->make(Translate::class);
        return $api->translator;
    }
}
