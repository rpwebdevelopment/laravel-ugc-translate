<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Jobs;

use RpWebDevelopment\LaravelUgcTranslate\Repositories\UgcTranslationRepository;

class Delete extends AbstractUgcJob
{
    public function handle(): void
    {
        UgcTranslationRepository::removeTranslations($this->model);
    }
}
