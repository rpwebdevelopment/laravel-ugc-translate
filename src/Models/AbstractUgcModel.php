<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use RpWebDevelopment\LaravelUgcTranslate\Observers\UgcModelObserver;

abstract class AbstractUgcModel extends Model
{
    public array $ugcTranslatable;

    public array $ugcLanguages;

    public static function boot()
    {
        if (! config('ugc-translate.auto-translate-disabled')) {
            self::observe(UgcModelObserver::class);
        }
        parent::boot();
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
        if (!in_array($field, $this->ugcTranslatable)) {
            return parent::getAttribute($field);
        }

        return $this->ugcField($field);
    }
}
