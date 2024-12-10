<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Services\Translate;

use Stichoza\GoogleTranslate\GoogleTranslate as GoogleTranslateService;

class GoogleTranslate
{
    protected GoogleTranslateService $translator;

    public function __construct()
    {
        $this->translator = new GoogleTranslateService();
    }

    public function translateText(
        string $string,
        ?string $sourceLang = 'en_GB',
        string $targetLang
    ): string {
        return $this->translator
            ->setSource($sourceLang)
            ->setTarget($targetLang)
            ->translate($string) ?? '';
    }
}
