<?php

namespace ImoTikuwa\LaravelMakeWithFormat;

use ImoTikuwa\LaravelMakeWithFormat\Commands\LaravelMakeWithFormatCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelMakeWithFormatServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-make-with-format')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_make_with_format_table')
            ->hasCommand(LaravelMakeWithFormatCommand::class);
    }
}
