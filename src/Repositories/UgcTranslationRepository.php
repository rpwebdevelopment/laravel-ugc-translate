<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Repositories;

use RpWebDevelopment\LaravelUgcTranslate\Models\AbstractUgcModel;
use RpWebDevelopment\LaravelUgcTranslate\Models\UgcTranslation;
use RpWebDevelopment\LaravelUgcTranslate\Services\Translate;

class UgcTranslationRepository
{
    public static function processFieldUpdate(AbstractUgcModel $model, string $field): void
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

    private static function getTranslations(AbstractUgcModel $model, string $field): array
    {
        $content = [];
        foreach ($model->ugcLanguages as $lang) {
            $content[$lang] = Translate::api()->translateText(
                $model->getAttributeValue($field),
                null,
                $lang
            )->text;
        }

        return $content;
    }

    public static function removeTranslations(AbstractUgcModel $model): void
    {
        UgcTranslation::query()
            ->whereMorphedTo('linkable', $model)
            ->delete();
    }

    private static function removeFieldTranslations(AbstractUgcModel $model, string $field): void
    {
        UgcTranslation::query()
            ->whereMorphedTo('linkable', $model)
            ->where('field', $field)
            ->delete();
    }
}
