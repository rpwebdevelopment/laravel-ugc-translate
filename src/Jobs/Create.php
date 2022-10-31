<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Jobs;

use RpWebDevelopment\LaravelUgcTranslate\Repositories\UgcTranslationRepository;

class Create extends AbstractUgcJob
{
    public function handle(): void
    {
        foreach ($this->model->ugcTranslatable as $field) {
            UgcTranslationRepository::processFieldUpdate($this->model, $field);
        }
    }
}
