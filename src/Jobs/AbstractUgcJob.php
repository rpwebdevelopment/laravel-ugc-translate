<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use RpWebDevelopment\LaravelUgcTranslate\Models\AbstractUgcModel;

abstract class AbstractUgcJob
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(protected AbstractUgcModel $model)
    {
        //
    }
}
