<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use RpWebDevelopment\LaravelUgcTranslate\Models\UgcTranslation;
use RpWebDevelopment\LaravelUgcTranslate\Observers\UgcModelObserver;

/**
 * @property-read array $ugcTranslatable
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

    public function ugcField(string $field): string
    {
        $content = $this
            ->ugc()
            ->where('field', $field)
            ->pluck('content')
            ->first();

        return $content ?? $this->attributes[$field];
    }

    public function getAttribute($field): mixed
    {
        if (!in_array($field, $this->ugcTranslatable ?? [])) {
            return parent::getAttribute($field);
        }

        return $this->ugcField($field);
    }
}
