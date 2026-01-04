<?php

namespace Lodeb\SEO;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SEOServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-seo')
            ->hasConfigFile();
            // ->hasViews()
            // ->hasMigration('create_laravel_seo_table');
            // ->hasCommand(SEOCommand::class);
    }

    public function boot(): void
    {
        parent::boot();
        
        $this->app->singleton(SEO::class, function ($app) {
            return new SEO();
        });
    }
}
