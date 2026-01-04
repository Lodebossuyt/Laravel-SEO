<?php

// config for Lodeb/SEO
return [
    /*
    |--------------------------------------------------------------------------
    | Default SEO Settings
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default SEO settings for your application.
    | These settings will be used unless overridden on a per-page basis.
    |
    */

    'default_title' => 'My Awesome Website',
    'default_description' => 'This is the best website ever built with Laravel SEO package.',
    'default_keywords' => ['laravel', 'seo', 'package', 'awesome'],
    'default_author' => 'Your Name',
    'default_robots' => 'index, follow',

    'set_canonical_url' => true,
    'set_og_tags' => true,
    'set_twitter_cards' => true,
];
