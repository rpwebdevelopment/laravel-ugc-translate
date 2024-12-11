<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use RpWebDevelopment\LaravelUgcTranslate\Models\UgcTranslation;
use RpWebDevelopment\LaravelUgcTranslate\Observers\UgcModelObserver;
use RpWebDevelopment\LaravelUgcTranslate\Services\Locale;

/**
 * @property-read array $ugcTranslatable
 * @property bool $hasTranslations
 * @property array $ugcLanguages
 */
trait HasTranslatable
{
    public static function bootHasTranslatable()
    {
        if (!config('ugc-translate.auto-translate-disabled')) {
            static::observe(UgcModelObserver::class);
        }
    }

    public function ugc(): HasMany
    {
        return $this->hasMany(UgcTranslation::class, 'linkable_id')
            ->where('linkable_type', self::class);
    }

    public function ugcAll(string $field)
    {
        return $this
            ->ugc()
            ->where('field', $field)
            ->first();
    }

    public function localeField(string $field, string $locale = 'en-GB'): string
    {
        $content = $this
            ->ugc()
            ->where('field', $field)
            ->first()
            ->forLocale($locale)
            ?->langContent;

        return $content ?? $this->attributes[$field];
    }

    public function ugcField(string $field): string
    {
        $content = $this
            ->ugc()
            ->where('field', $field)
            ->first()
            ?->langContent;

        return $content ?? $this->attributes[$field];
    }

    public function getHasTranslationsAttribute(): bool
    {
        return true;
    }

    public function getUgcLanguagesAttribute(): array
    {
        $locales = config('ugc-translate.translation-languages', []);
        array_walk($locales, fn (&$item) => $item = Locale::getLocaleString($item));

        return $locales;
    }

    public function getAttribute($field): mixed
    {
        if (!in_array($field, $this->ugcTranslatable ?? [])) {
            return parent::getAttribute($field);
        }

        return $this->ugcField($field);
    }
}
