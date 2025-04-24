<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Exceptions;

use Exception;

class LanguageNotSupportedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Language selected is not supported.');
    }
}
