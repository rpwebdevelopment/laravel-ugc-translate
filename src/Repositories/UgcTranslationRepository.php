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

        $record = new UgcTranslation(
            [
                'linkable_type' => $model->getMorphClass(),
                'linkable_id' => $model->getKey(),
                'content' => json_encode($content),
                'field' => $field,
            ]
        );

        $record->save();
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
            ->whereMorphedTo('linkable', $model)
            ->delete();
    }

    private static function removeFieldTranslations(Model $model, string $field): void
    {
        UgcTranslation::query()
            ->whereMorphedTo('linkable', $model)
            ->where('field', $field)
            ->delete();
    }
}
