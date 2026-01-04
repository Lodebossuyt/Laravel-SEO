# SEO package for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lodeb/laravel-seo.svg?style=flat-square)](https://packagist.org/packages/lodeb/laravel-seo)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/lodeb/laravel-seo/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/lodeb/laravel-seo/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/lodeb/laravel-seo/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/lodeb/laravel-seo/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/lodeb/laravel-seo.svg?style=flat-square)](https://packagist.org/packages/lodeb/laravel-seo)

## Installation

You can install the package via composer:

```bash
composer require lodeb/laravel-seo
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="seo-config"
```

This is the contents of the published config file:

```php
return [
    'default_title' => 'My Awesome Website',
    'default_description' => 'This is the best website ever built with Laravel SEO package.',
    'default_keywords' => ['laravel', 'seo', 'package', 'awesome'],
    'default_author' => 'Your Name',
    'default_robots' => 'index, follow',

    'set_canonical_url' => true,
    'set_og_tags' => true,
    'set_twitter_cards' => true,
];
```

## Usage

There is a singelton SEO Class. Set the SEO tags you want to generate.

```php
\Lodeb\SEO\Facades\SEO::setTitle($this->meta_title);
\Lodeb\SEO\Facades\SEO::setDescription($this->meta_description);
\Lodeb\SEO\Facades\SEO::setKeywords(explode(',', $this->meta_keywords));
\Lodeb\SEO\Facades\SEO::setAuthor($this->meta_author);
\Lodeb\SEO\Facades\SEO::setRobots($this->meta_robots);
```
// App.blade

```php
{!! \Lodeb\SEO\Facades\SEO::generate() !!}
```

## Credits

- [Lode Bossuyt](https://github.com/lodeb)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
