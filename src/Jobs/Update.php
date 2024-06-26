<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Jobs;

use RpWebDevelopment\LaravelUgcTranslate\Repositories\UgcTranslationRepository;

class Update extends AbstractUgcJob
{
    public function handle(): void
    {
        foreach ($this->model->ugcTranslatable as $field) {
            if ($this->model->isDirty($field) && !$this->model->ugcAll($field)?->locked) {
                UgcTranslationRepository::processFieldUpdate($this->model, $field);
            }
        }
    }
}
