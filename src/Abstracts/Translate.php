<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Abstracts;

use RpWebDevelopment\LaravelUgcTranslate\Exceptions\LanguageNotSupportedException;

abstract class Translate
{
    public abstract function translateText(
        string $text = '',
        ?string $sourceLang = null,
        ?string $targetLang = null
    ): string;

    /**
     * @throws LanguageNotSupportedException
     */
    protected function formatCode(string $code = 'en_GB', array $codes = []): string
    {
        $code = str_replace('-', '_', $code);

        if (isset($codes[$code])) {
            return $codes[$code];
        }

        if (in_array($code, $codes, true)) {
            return $code;
        }

        throw new LanguageNotSupportedException();
    }
}
