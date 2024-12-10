<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Services\Translate;

use DeepL\DeepLException;
use DeepL\Translator;

class DeepLTranslate
{
    protected Translator $translator;

    /**
     * @throws DeepLException
     */
    public function __construct()
    {
        $this->translator = new Translator(
            config('ugc-translate.providers.deepl.auth-token')
        );
    }

    /**
     * @throws DeepLException
     */
    public function translateText(
        string $text,
        ?string $sourceLang = null,
        string $targetLang
    ): string {
        return $this->translator
            ->translateText($text, $sourceLang, $targetLang)
            ->text;
    }
}
