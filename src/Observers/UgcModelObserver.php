<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Observers;

use Illuminate\Database\Eloquent\Model;
use RpWebDevelopment\LaravelUgcTranslate\Jobs\Delete;
use RpWebDevelopment\LaravelUgcTranslate\Jobs\Create;
use RpWebDevelopment\LaravelUgcTranslate\Jobs\Update;

class UgcModelObserver
{
    /**
     * Handle the AbstractUgcModel "created" event.
     *
     * @param Model $model
     * @return void
     */
    public function created(Model $model)
    {
        if ($model->hasTranslations) {
            Create::dispatch($model);
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param Model $model
     * @return void
     */
    public function updated(Model $model)
    {
        if ($model->hasTranslations) {
            Update::dispatch($model);
        }
    }

    /**
     * Handle the User "saved" event.
     *
     * @param Model $model
     * @return void
     */
    public function saved(Model $model)
    {
        if ($model->hasTranslations) {
            Update::dispatch($model);
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param Model $model
     * @return void
     */
    public function deleted(Model $model)
    {
        Delete::dispatch($model);
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param Model $model
     * @return void
     */
    public function forceDeleted(Model $model)
    {
        Delete::dispatch($model);
    }
}
