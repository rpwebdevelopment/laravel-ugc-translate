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
 * @property string $locale
 * @property string $linkable_type
 * @property int $linkable_id
 * @property string $content
 * @property string $field
 */
class UgcTranslation extends Model
{
    public string $locale;
    public $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->locale = Locale::getLocaleString();
    }

    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }

    public function forLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getContentAttribute(): mixed
    {
        return $this->getContentClass()->{$this->locale};
    }

    private function getContentClass(): stdClass
    {
        return json_decode($this->attributes['content']);
    }
}
