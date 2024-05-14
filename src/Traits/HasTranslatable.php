<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use RpWebDevelopment\LaravelUgcTranslate\Models\UgcTranslation;
use RpWebDevelopment\LaravelUgcTranslate\Observers\UgcModelObserver;

/**
 * @property-read array $ugcTranslatable
 * @property bool $hasTranslations
 * @property array $ugcLanguages
 */
trait HasTranslatable
{
    public static function bootHasTranslatable()
    {
        if (! config('ugc-translate.auto-translate-disabled')) {
            static::observe(UgcModelObserver::class);
        }
    }

    public function ugc(): MorphMany
    {
        return $this->morphMany(UgcTranslation::class, 'linkable');
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
        return config('ugc-translate.translation-languages');
    }

    public function getAttribute($field): mixed
    {
        if (!in_array($field, $this->ugcTranslatable ?? [])) {
            return parent::getAttribute($field);
        }

        return $this->ugcField($field);
    }
}
