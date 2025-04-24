<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Services\Translate;

use DeepL\DeepLException;
use DeepL\Translator;
use RpWebDevelopment\LaravelUgcTranslate\Abstracts\Translate;
use RpWebDevelopment\LaravelUgcTranslate\Exceptions\LanguageNotSupportedException;
use RpWebDevelopment\LaravelUgcTranslate\Traits\DeepLLanguageCodes;

class DeepLTranslate extends Translate
{
    use DeepLLanguageCodes;

    protected Translator $translator;
    protected array $settings = [
        'model_type' => 'prefer_quality_optimized',
        'formality' => 'default',
    ];

    /**
     * @throws DeepLException
     */
    public function __construct()
    {
        $this->translator = new Translator(
            config('ugc-translate.providers.deepl.auth-token')
        );

        $this->settings = config('ugc-translate.providers.deepl.settings', $this->settings);
    }

    /**
     * @throws DeepLException
     * @throws LanguageNotSupportedException
     */
    public function translateText(
        string $text = '',
        ?string $sourceLang = null,
        ?string $targetLang = null
    ): string {
        return $this->translator
            ->translateText(
                $text,
                $this->formatCode($sourceLang, $this->sourceLanguageCodes),
                $this->formatCode($targetLang, $this->targetLanguageCodes),
                $this->settings
            )
            ->text;
    }
}
