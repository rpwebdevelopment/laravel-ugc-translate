<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use RpWebDevelopment\LaravelUgcTranslate\Services\Locale;
use stdClass;

/**
 * RpWebDevelopment\LaravelUgcTranslate\Models\UgcTranslation
 *
 * @property int $id
 * @property string $linkable_type
 * @property int $linkable_id
 * @property string $content
 * @property string $field
 */
class UgcTranslation extends Model
{
    public $guarded = [];

    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getContentAttribute(): mixed
    {
        $locale = Locale::getLocaleString();
        return $this->getContentClass()->{$locale};
    }

    private function getContentClass(): stdClass
    {
        return json_decode($this->attributes['content']);
    }
}
