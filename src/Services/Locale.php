<?php

namespace RpWebDevelopment\LaravelUgcTranslate\Services;

class Locale
{
    protected static array $locales = [
        'bg' => 'bg',
        'cs' => 'cs',
        'da' => 'da',
        'de' => 'de',
        'el' => 'el',
        'en' => 'en',
        'en_GB' => 'en-GB',
        'en_US' => 'en-US',
        'es' => 'es',
        'et' => 'et',
        'fi' => 'fi',
        'fr' => 'fr',
        'hu' => 'hu',
        'id' => 'id',
        'it' => 'it',
        'ja' => 'ja',
        'lt' => 'lt',
        'lv' => 'lv',
        'nl' => 'nl',
        'nl_BE' => 'nl',
        'pl' => 'pl',
        'pt' => 'pt',
        'pt_BR' => 'pt-BR',
        'pt_PT' => 'pt-PT',
        'ro' => 'ro',
        'ru' => 'ru',
        'sk' => 'sk',
        'sl' => 'sl',
        'sv' => 'sv',
        'tr' => 'tr',
        'uk' => 'uk',
        'zh' => 'zh',
    ];

    public const LOCALE_LANGUAGES = [
        'bg' => 'Bulgarian',
        'cs' => 'Czech',
        'da' => 'Danish',
        'de' => 'German',
        'el' => 'Greek',
        'en' => 'English',
        'en-GB' => 'English (UK)',
        'en-US' => 'English (US)',
        'es' => 'Spanish',
        'et' => 'Estonian',
        'fi' => 'Finnish',
        'fr' => 'French',
        'hu' => 'Hungarian',
        'id' => 'Indonesian',
        'it' => 'Italian',
        'ja' => 'Japanese',
        'lt' => 'Lithuanian',
        'lv' => 'Latvian',
        'nl' => 'Dutch',
        'nl_BE' => 'Flemish',
        'pl' => 'Polish',
        'pt' => 'Portuguese',
        'pt-BR' => 'Portuguese (Brazil)',
        'pt-PT' => 'Portuguese (Portugal)',
        'ro' => 'Romanian',
        'ru' => 'Russian',
        'sk' => 'Slovak',
        'sl' => 'Slovenian',
        'sv' => 'Swedish',
        'tr' => 'Turkish',
        'uk' => 'Ukrainian',
        'zh' => 'Chinese',
    ];

    public static function getLocaleString(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return self::$locales[$locale] ?? config('ugc-translate.default-lang');
    }
}
