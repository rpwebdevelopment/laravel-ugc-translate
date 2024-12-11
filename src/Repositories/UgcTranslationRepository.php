<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Repositories;

use Illuminate\Database\Eloquent\Model;
use RpWebDevelopment\LaravelUgcTranslate\Facades\UgcTranslate;
use RpWebDevelopment\LaravelUgcTranslate\Models\UgcTranslation;

class UgcTranslationRepository
{
    public static function processFieldUpdate(Model $model, string $field): void
    {
        $content = self::getTranslations($model, $field);
        self::removeFieldTranslations($model, $field);

        UgcTranslation::query()->create([
            'linkable_type' => $model::class,
            'linkable_id' => $model->getKey(),
            'content' => json_encode($content),
            'field' => $field,
        ]);
    }

    private static function getTranslations(Model $model, string $field): array
    {
        $content = [];
        foreach ($model->ugcLanguages as $lang) {
            $content[$lang] = UgcTranslate::translateText(
                text: $model->getAttributeValue($field),
                sourceLang: null,
                targetLang: $lang
            );
        }

        return $content;
    }

    public static function removeTranslations(Model $model): void
    {
        UgcTranslation::query()
            ->where('linkable_type', $model::class)
            ->where('linkable_id', $model->getKey())
            ->delete();
    }

    private static function removeFieldTranslations(Model $model, string $field): void
    {
        UgcTranslation::query()
            ->where('linkable_type', $model::class)
            ->where('linkable_id', $model->getKey())
            ->where('field', $field)
            ->delete();
    }
}
