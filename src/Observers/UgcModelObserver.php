<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Observers;

use RpWebDevelopment\LaravelUgcTranslate\Jobs\Delete;
use RpWebDevelopment\LaravelUgcTranslate\Models\AbstractUgcModel;
use RpWebDevelopment\LaravelUgcTranslate\Jobs\Create;
use RpWebDevelopment\LaravelUgcTranslate\Jobs\Update;

class UgcModelObserver
{
    /**
     * Handle the AbstractUgcModel "created" event.
     *
     * @param AbstractUgcModel $model
     * @return void
     */
    public function created(AbstractUgcModel $model)
    {
        Create::dispatch($model);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param AbstractUgcModel $model
     * @return void
     */
    public function updated(AbstractUgcModel $model)
    {
        Update::dispatch($model);
    }

    /**
     * Handle the User "saved" event.
     *
     * @param AbstractUgcModel $model
     * @return void
     */
    public function saved(AbstractUgcModel $model)
    {
        Update::dispatch($model);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param AbstractUgcModel $model
     * @return void
     */
    public function deleted(AbstractUgcModel $model)
    {
        Delete::dispatch($model);
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param AbstractUgcModel $model
     * @return void
     */
    public function forceDeleted(AbstractUgcModel $model)
    {
        Delete::dispatch($model);
    }
}
