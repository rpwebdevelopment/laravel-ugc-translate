<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Services\Translate;

use RpWebDevelopment\LaravelUgcTranslate\Abstracts\Translate;
use RpWebDevelopment\LaravelUgcTranslate\Exceptions\LanguageNotSupportedException;
use RpWebDevelopment\LaravelUgcTranslate\Traits\GoogleLanguageCodes;
use Stichoza\GoogleTranslate\Exceptions\LargeTextException;
use Stichoza\GoogleTranslate\Exceptions\RateLimitException;
use Stichoza\GoogleTranslate\Exceptions\TranslationRequestException;
use Stichoza\GoogleTranslate\GoogleTranslate as GoogleTranslateService;

class GoogleTranslate extends Translate
{
    use GoogleLanguageCodes;

    protected GoogleTranslateService $translator;

    public function __construct()
    {
        $this->translator = new GoogleTranslateService();
    }

    /**
     * @throws LanguageNotSupportedException
     * @throws LargeTextException
     * @throws RateLimitException
     * @throws TranslationRequestException
     */
    public function translateText(
        string $text = '',
        ?string $sourceLang = 'en_GB',
        ?string $targetLang = null
    ): string {
        return $this->translator
            ->setSource($this->formatCode($sourceLang, $this->sourceLanguageCodes))
            ->setTarget($this->formatCode($targetLang, $this->targetLanguageCodes))
            ->translate($text) ?? '';
    }
}
