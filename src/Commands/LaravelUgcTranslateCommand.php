<?php

namespace RpWebDevelopment\LaravelUgcTranslate\Commands;

use Illuminate\Console\Command;

class LaravelUgcTranslateCommand extends Command
{
    public $signature = 'laravel-ugc-translate';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
