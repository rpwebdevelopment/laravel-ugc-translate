# User generated content translation package 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rpwebdevelopment/laravel-ugc-translate.svg?style=flat-square)](https://packagist.org/packages/rpwebdevelopment/laravel-ugc-translate)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/rpwebdevelopment/laravel-ugc-translate/run-tests?label=tests)](https://github.com/rpwebdevelopment/laravel-ugc-translate/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/rpwebdevelopment/laravel-ugc-translate/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/rpwebdevelopment/laravel-ugc-translate/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rpwebdevelopment/laravel-ugc-translate.svg?style=flat-square)](https://packagist.org/packages/rpwebdevelopment/laravel-ugc-translate)

This is a Laravel specific package designed to automate the translation of user generated content in a database driven fashion.

## Installation

You can install the package via composer:

```bash
composer require rpwebdevelopment/laravel-ugc-translate

php artisan vendor:publish --tag="ugc-translate-migrations"
php artisan migrate

php artisan vendor:publish --tag="ugc-translate-config"
```

This package implements the DeepL API for machine translation, as such you will need to provide an appropriate API key in your `.env` file:
```php
DEEPL_AUTH_TOKEN=YOUR_VALID_DEEPL_API_KEY
```

If you do not wish every record update/creation to trigger automatic translation, you can disable the observer by adding the following to your `.env` file:
```php
DEEPL_AUTO_DISABLED=true
```

## Usage

The package provides a new abstract model that can be extended in order to apply automatic translations:

```php
<?php

namespace App\Models;

use RpWebDevelopment\LaravelUgcTranslate\Models\AbstractUgcModel;

class Posts extends AbstractUgcModel
{
    //
}
```

In order to define translatable fields, and languages required for translation our models will now require two new properties defining the DB fields to be translated and the languages required; `$ugcTranslatable` & `$ugcLanguages`:

```php
<?php

namespace App\Models;

use RpWebDevelopment\LaravelUgcTranslate\Models\AbstractUgcModel;

class Posts extends AbstractUgcModel
{
    public array $ugcTranslatable = [
        'title',
        'body',
    ];

    public array $ugcLanguages = [
        'en-GB',
        'fr',
        'it',
    ];

    protected $guarded = [];
}
```

Unless you have disabled auto-translate, creating or updating a record within your model will cause translations to be generated and stored. The package leverages Laravel's `locale` in order to assert which language is to be returned. If we take our posts model above with the following record:

```
| id  | title           | body                    |
| --- | --------------- | ----------------------- |
| 1   | This is a title | This is the main text   |
```

You can achieve the following:
```php
$post = App\Models\Post::find(1);

app()->setLocale('en_GB');
echo $post->title;
// ouputs "This is a title"

app()->setLocale('it');
echo $post->title;
// outputs "Questo è un titolo"

app()->setLocale('fr');
echo $post->title;
// outputs "Il s'agit d'un titre"
```

### Note
If your model leverages the Laravel `boot` method, and you require auto updating, you will need to ensure that you either, call `parent::boot()` or `self::observe(UgcModelObserver::class)`.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Rich Porter](https://github.com/rpwebdevelopment)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
